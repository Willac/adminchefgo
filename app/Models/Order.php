<?php

namespace App\Models;

use App\Models\Auth\User\Traits\Ables\Protectable;
use App\Models\Auth\User\Traits\Attributes\UserAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Auth\User\Traits\Ables\Rolable;
use App\Models\Auth\User\Traits\Scopes\UserScopes;
use App\Models\Auth\User\Traits\Relations\UserRelations;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Passport\HasApiTokens;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Helpers\PushNotificationHelper;


class Order extends Model
{

    protected $table = 'orders';

    protected $fillable = ['subtotal', 'taxes', 'delivery_fee', 'total', 'discount', 'status', 'delivery_status',
        'payment_status', 'special_instructions', 'address_id', 'store_id', 'user_id', 'delivery_profile_id',
        'payment_method_id', 'type', 'scheduled_on', 'assigned_at', 'is_accepted'];

    protected $with = ['orderitems', 'user', 'store', 'address', 'deliveryProfile'];

    public function orderitems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User\User', 'user_id');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }

    public function deliveryProfile()
    {
        return $this->belongsTo('App\Models\DeliveryProfile', 'delivery_profile_id');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address', 'address_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod', 'payment_method_id');
    }

    public function allotDeliveryPerson()
    {
        $deliveryProfiles = DeliveryProfile::search($this->store_id);
        // $deliveryProfiles = DeliveryProfile::where('assigned', 0)->get();
        if (count($deliveryProfiles) > 0) {
            $deliveryProfile = $deliveryProfiles[0];
            $this->delivery_profile_id = $deliveryProfile->id;
            $this->delivery_status = 'allotted';
            $this->assigned_at =  DB::raw('CURRENT_TIMESTAMP');
            $this->save();

            // set the assigned field of delivery boy to true implying delivery boy is not available for pickup
            $deliveryProfile->assigned = true;
            $deliveryProfile->save();

            // send notification to delivery person
            PushNotificationHelper::send($deliveryProfile->user->fcm_registration_id,
                'Nueva orden', 'Tienes una nueva orden de entrega', ["order_id" => $this->id]);

            return true;
        }

        return false;
    }

    public function ReAllotDeliveryPerson()
    {
        $old_delivery_profile = DeliveryProfile::find($this->delivery_profile_id);
        if ($old_delivery_profile != null){
            $old_delivery_profile->assigned = null;
            $old_delivery_profile->save();        
        }

        $deliveryProfiles = DeliveryProfile::search($this->store_id)->where('id', '!=', $this->delivery_profile_id );
        $this->delivery_status = "pending";
        $this->delivery_profile_id = null;
        $this->save();

        if (count($deliveryProfiles) > 0) {
            

            $deliveryProfile = $deliveryProfiles[0];
            $this->delivery_profile_id = $deliveryProfile->id;
            $this->delivery_status = 'allotted';
            $this->assigned_at =  DB::raw('CURRENT_TIMESTAMP');
            $this->save();

            PushNotificationHelper::send($this->store->user->fcm_registration_id,
                'Repartidor cambio', 'Recogerá la orden.' , ["order_id" => $this->id]);
            // set the assigned field of delivery boy to true implying delivery boy is not available for pickup
            $deliveryProfile->assigned = true;
            $deliveryProfile->save();

            // send notification to delivery person
            PushNotificationHelper::send($deliveryProfile->user->fcm_registration_id,
                'Nueva orden', 'Tienes una nueva orden de entrega', ["order_id" => $this->id]);

            return true;
        }else{
            PushNotificationHelper::send($this->store->user->fcm_registration_id,
                'Repartidor no acepto la orden', 'No hay repartidores disponibles espere un momento e intente de nuevo.' , ["order_id" => $this->id]);
                return false;
        }
        //return false;
        return false;
    }

}
