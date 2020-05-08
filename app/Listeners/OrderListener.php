<?php

namespace App\Listeners;

use App\Events\Ordered;
use App\Events\PostOrder;
use App\Helpers\PushNotificationHelper;
use App\Mail\OrderPlaced;
use App\Models\Auth\User\User;
use App\Models\DeliveryProfile;
use App\Models\Earning;
use App\Models\Order;
use App\Models\OrderStatusLog;
use App\Models\PushNotification;
use App\Models\Setting;
use App\Notifications\Admin\NewOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use DateTime;
use Illuminate\Support\Facades\DB;

class OrderListener
{
    private $order;
    private $event;
    private $pushNotifications;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Ordered $event
     * @return void
     */
    public function handle(Ordered $event)
    {
        try {
            $this->event = $event;
            $this->order = $event->order;
            $this->pushNotifications = [];

            $this->_statusUpdate();

            $this->_deliveryStatusUpdate();

            event(new PostOrder($event->order, $this->pushNotifications));
        } catch (\Exception $ex) {
            Log::error('Exception occurred', [$ex->getMessage(), $ex->getTraceAsString()]);
        }
    }

    private function _statusUpdate()
    {
        if($this->event->statusUpdate) {
            OrderStatusLog::create(['order_id' => $this->order->id, 'status' => $this->order->status]);
        }

        if ($this->order->status == 'new' && $this->order->paymentMethod->slug == 'cod') {
            // send a notification to store
            $this->pushNotifications[] = new PushNotification($this->order->store->user->fcm_registration_id,
                'Nueva orden', 'Tienes un nuevo pedido.', ["order_id" => $this->order->id]);
        }

        // when store accepts the order, send notification to user and try to allocate delivery boy for the order
        if ($this->order->status == 'accepted') {

            // try to allot a delivery person
            if ($this->order->delivery_status == 'pending') {
                $this->_allotDeliveryPerson();
            }

            // send notification to user that his order accepted by user
            $this->pushNotifications[] = new PushNotification($this->order->user->fcm_registration_id,
                'Orden Aceptada', 'Tu orden a sido aceptada.', ["order_id" => $this->order->id]);
        }


        if ($this->order->status == 'preparing') {

            // try to allot a delivery person, if not yet done
            if ($this->order->delivery_status == 'pending') {
                $this->_allotDeliveryPerson();
            }

            $this->pushNotifications[] = new PushNotification($this->order->user->fcm_registration_id,
                'Preparando orden', 'Tu orden está siendo preparada.', ["order_id" => $this->order->id]);
        }

        if ($this->order->status == 'dispatched') {

            $this->pushNotifications[] = new PushNotification($this->order->user->fcm_registration_id,
                'Orden despachada', 'El Restaurant ha entregado tu orden.', ["order_id" => $this->order->id]);
        }

        if ($this->order->status == 'rejected') {
            $this->pushNotifications[] = new PushNotification($this->order->user->fcm_registration_id,
                'Orden Rechazada', 'Lo sentimos! La cocina a rechazado tu orden.', ["order_id" => $this->order->id]);
        }
    }

    private function _deliveryStatusUpdate()
    {
        if ($this->order->delivery_status == 'complete') {
            $this->_onComplete();
        }
    }

    private function _allotDeliveryPerson()
    {
        $deliveryProfiles = DeliveryProfile::search($this->order->store_id);
        // $deliveryProfiles = DeliveryProfile::where('assigned', 0)->get();
        if (count($deliveryProfiles) > 0) {
            $deliveryProfile = $deliveryProfiles[0];
            $this->order->delivery_profile_id = $deliveryProfile->id;
            $this->order->delivery_status = 'allotted';
            $this->order->assigned_at =  DB::raw('CURRENT_TIMESTAMP');
            $this->order->save();

            // set the assigned field of delivery boy to true implying delivery boy is not available for pickup
            $deliveryProfile->assigned = true;
            $deliveryProfile->save();
            info('This is some useful information.');
            // send notification to delivery person
            $this->pushNotifications[] = new PushNotification($deliveryProfile->user->fcm_registration_id,
                'Nueva orden', 'Tienes una nueva orden de entrega', ["order_id" => $this->order->id]);
        }
    }

    private function _onComplete()
    {
        // when delivery is complete, update the order's status to complete
        $this->order->status = 'complete';
        $this->order->save();
        OrderStatusLog::create(['order_id' => $this->order->id, 'status' => $this->order->status]);

        // when order is complete, set assigned field of delivery boy to false implying delivery boy is now available for pickup
        $deliveryProfile = $this->order->deliveryProfile;
        $deliveryProfile->assigned = false;
        $deliveryProfile->save();

        $deliveryFee = floatval(Setting::where('key', 'delivery_fee')->first()->value);

        $storeShareInOrder = floatval(Setting::where('key', 'store_fee_for_order_in_percent')->first()->value); 
        $storeShareDeliverInOrder = floatval(Setting::where('key', 'store_fee_deliver_in_percent')->first()->value); 
        $storeEarnings = new Earning();
        $storeEarnings->order_id = $this->order->id;
        $storeEarnings->amount = ($this->order->subtotal * $storeShareInOrder/100) + ($storeShareDeliverInOrder * ($deliveryFee/100));
        //$this->order->subtotal - ($this->order->subtotal * $adminShareInOrder) / 100;
        $storeEarnings->user_id = $this->order->store->user->id;
        $storeEarnings->save();

        $this->pushNotifications[] = new PushNotification($this->order->store->user->fcm_registration_id,
            'Orden completada', 'La orden ha sido completada. Ganancias registradas', ["order_id" => $this->order->id]);

        # delivery person earnings
        $deliveryOrderShare = floatval(Setting::where('key', 'delivery_fee_for_order_in_percent')->first()->value); 
        $deliveryShare = floatval(Setting::where('key', 'delivery_fee_deliver_order_in_percent')->first()->value); 
        
        $deliveryEarnings = new Earning();
        $deliveryEarnings->order_id = $this->order->id;
        $deliveryEarnings->amount = ($this->order->subtotal * $deliveryOrderShare/100) + ($deliveryShare * ($deliveryFee / 100));
        $deliveryEarnings->user_id = $this->order->deliveryProfile->user->id;
        $deliveryEarnings->save();



        $this->pushNotifications[] = new PushNotification($this->order->deliveryProfile->user->fcm_registration_id,
            'Orden completada', 'La orden ha sido completada. Ganancias registradas', ["order_id" => $this->order->id]);
    }
}
