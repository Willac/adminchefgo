<?php

namespace App\Http\Controllers\Api;

use App\Events\Ordered;
use App\Helpers\PushNotificationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiOrderUpdateRequest;
use App\Http\Requests\Customer\ApiOrderCreateRequest;
use App\Models\DeliveryProfile;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\StampOrderByMail;
use App\Mail\CanceledOrder;
use App\Mail\CanceledCustomer;
use App\Models\EMoney;

class OrderController extends Controller
{
    /**
     * Get orders by store_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        //ReAllotSeveralPersons();
        $orders_to_update = Order::where('store_id', Auth::user()->store->id)->whereIn('status', ['accepted', 'preparing'])->where('is_accepted', '=', false);
        $orders_to_update->each(function ($order, $key) { 
            $actual_time = now();
            if ((strtotime($actual_time)-strtotime($order->assigned_at)) > 63){
                $order->ReAllotDeliveryPerson($order);
            }   
        });
        
        $orders = Order::where('store_id', Auth::user()->store->id);
        
        
        if($request->status) {
            $orders = $orders->where('status', $request->status);
        }
        //ReAllotSeveralPersons();
        // filter for active orders
        if($request->active_orders) {
            $orders = $orders->whereIn('status', ['new', 'accepted', 'preparing', 'dispatched']);
        }

        // for delivery tab in store app
        if($request->deliveries) {
            $orders = $orders->whereIn('status', ['accepted', 'preparing', 'dispatched'])
                ->where('delivery_profile_id', '<>', null)
                ->whereIn('delivery_status', ['allotted', 'started', 'complete']);
        }

        return response()->json($orders->orderBy('created_at', 'desc')->paginate(config('constants.paginate_per_page')));
    }
    /**
     * Display the order
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApiOrderUpdateRequest $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(ApiOrderUpdateRequest $request, Order $order)
    {
        
        if($request->status == 'dispatched' && !$order->delivery_profile_id) {
            // if store is trying to update the status of order to `dispatched`, first check if delivery person is assigned
            // to the order, if yes, simply update the order status, if no, try to allot delivery person to the order
            // if success, return 422 status code implying we have allotted the delivery person but order is not yet dispatched,
            // if we don't find any delivery person yet return status code 404
            if($order->allotDeliveryPerson($order)) {
                return response()->json($order->refresh(), 422);
            };
            
            return response()->json($order, 404);
        }
        $order->fill($request->all());
        $order->save();

        event(new Ordered($order, true));

        return response()->json($order);
    }

    public function getDeliveryActives(Request $request){
        $saved = 0;
        $storeId = null;

        if ($request->id != 0){
            $storeId = $request->id;
        }else{
            $storeId = Auth::user()->store->id;
        }

        //DeliveryProfile::searchActivesProfiles($storeId);
        $saved = DeliveryProfile::searchActivesProfiles($storeId)->count();

        $response = [];

        if ($saved > 0){
            return response()->json([
                'success' => true,
                'payload' => $saved,
            ]);
        }else{
            return response()->json([
                'success' => false,
                'payload' => null,
                'error' => [
                    'message' => '¿No hay repartidores activos deseas continuar con tu pedido?'
                ]
            ]);
        }
    }
    
    public function cancelOrder(Request $request, Order $order){
        $saved = 0;

        $storeId = Auth::user()->store->id;
        $saved = DeliveryProfile::searchActivesProfiles($storeId)->count();

        $response = [];

        if ($saved > 0){
            return response()->json([
                'success' => false,
                'payload' => null,
                'error' => [
                    'message' => 'Orden no puede ser cancelada.'
                ]
            ]);
        }else{
            if (($order->is_accepted == 0) && ($order->status == "accepted" || $order->status == "dispatched")){

                $emoney = Emoney::where('user_id', $order->user_id)->first();
                $emoney->amount = $emoney->amount+(($order->total + $order->taxes + $order->delivery_fee)*100);
                $emoney->save();


                $order->status = "cancelled";
                $order->delivery_status = "cancelled";
                $order->save();

                $idOrder =  $order->id;
                Mail::to($order->user->email)->send(new CanceledOrder($order));
                PushNotificationHelper::send($order->user->fcm_registration_id,
                    'Tu orden ah sido cancelada.', 'Orden #'.$idOrder.'. Revisa tu correo para mas detalles.', ["order_id" => $order->id]);

                return response()->json([
                    'success' => true,
                    'payload' => $order                
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'payload' => null,
                    'error' => [
                        'message' => 'Orden no puede ser cancelada, ya esta asignada a un repartidor.'
                    ]
                ]);
            }            
        }
    }
    
    public function cancelOrderCustomer(Request $request, Order $order){
        $saved = 0;

        $storeId = $order->store_id;
        $saved = DeliveryProfile::searchActivesProfiles($storeId)->count();

        $response = [];

        if ($saved > 0){
            return response()->json([
                'success' => false,
                'payload' => null,
                'error' => [
                    'message' => 'Orden no puede ser cancelada.'
                ]
            ]);
        }else{
            if (($order->is_accepted == 0) && ($order->status == "new" || $order->status == "accepted")){

                $emoney = Emoney::where('user_id', $order->user_id)->first();
                $emoney->amount = $emoney->amount+(($order->total + $order->taxes + $order->delivery_fee)*100);
                $emoney->save();


                #$order->status = "cancelled";
                #$order->delivery_status = "cancelled";
                #$order->save();

                $idOrder =  $order->id;
                Mail::to($order->user->email)->send(new CanceledCustomer($order));
                PushNotificationHelper::send($order->user->fcm_registration_id,
                    'Tu orden ah sido cancelada.', 'Orden #'.$idOrder.'. Revisa tu correo para mas detalles.', ["order_id" => $order->id]);

                Mail::to($order->store->user->email)->send(new CanceledCustomer($order));
                PushNotificationHelper::send($order->store->user->fcm_registration_id,
                        'El cliente acaba de cancelar.', 'Orden #'.$idOrder.'. Revisa tu correo para mas detalles.', ["order_id" => $order->id]);

                return response()->json([
                    'success' => true,
                    'payload' => $order                
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'payload' => null,
                    'error' => [
                        'message' => 'Orden no puede ser cancelada, ya esta asignada a un repartidor.'
                    ]
                ]);
            }            
        }
    }


    public function stampMail( Order $order, Request $request){
        Mail::to("facturacion@chefgo.com.mx")->send(new StampOrderByMail($order, $request));
        return response()->json($order);
    }

    
}
