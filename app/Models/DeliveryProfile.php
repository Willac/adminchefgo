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

class DeliveryProfile extends Model
{
    use Sortable;

    protected $table = 'delivery_profiles';

    protected $fillable = ['is_online', 'longitude', 'latitude', 'assigned', 'user_id'];

    protected $with = ['user'];

    //protected $appends = array('delivery_ratings');


    public static function search($storeId)
    {
        $store = Store::find($storeId);
        $distanceDelta = 3500;

        $deliveryProfiles = DeliveryProfile::where('is_online', true)->where('assigned', false);

        $subqueryDistance = "*, ST_Distance_Sphere(Point(delivery_profiles.longitude,"
            . " delivery_profiles.latitude),"
            . " Point($store->longitude, $store->latitude ))"
            . " as distance";

        $deliveryProfiles = $deliveryProfiles->selectRaw($subqueryDistance)->havingRaw('distance < ' . $distanceDelta)->get();

        return $deliveryProfiles;
    }

    public static function searchActivesProfiles($storeId)
    {
        $store = Store::find($storeId);
        $distanceDelta = 3500;

        $deliveryProfiles = DeliveryProfile::where('is_online', true);

        $subqueryDistance = "*, ST_Distance_Sphere(Point(delivery_profiles.longitude,"
            . " delivery_profiles.latitude),"
            . " Point($store->longitude, $store->latitude ))"
            . " as distance";

        $deliveryProfiles = $deliveryProfiles->selectRaw($subqueryDistance)->havingRaw('distance < ' . $distanceDelta)->get();

        return $deliveryProfiles;
    }



    public function delivery_ratings()
    {
        return $this->hasMany('App\Models\DeliveryRating');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User\User', 'user_id');
    }

}
