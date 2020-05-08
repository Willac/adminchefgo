<?php

namespace App\Models;

use App\Http\Requests\Customer\ApiStoreListRequest;
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
use Illuminate\Support\Facades\DB;

class Store extends Model
{
    use Sortable;

    protected $table = 'stores';

    protected $fillable = ['name', 'tagline', 'image_url', 'delivery_time', 'minimum_order',
        'delivery_fee', 'details', 'delivery_limit', 'area', 'address', 'longitude', 'latitude', 'preorder',
        'serves_non_veg', 'cost_for_two', 'status', 'owner_id', 'opens_at', 'closes_at'];

    protected $with = array('categories');

    // protected $hidden = array('ratings');

    protected $appends = array('ratings');

    public static function search($user, ApiStoreListRequest $request)
    {
        $distanceDelta = 3500;

        $countsQuery = [
            'favourites as favourite' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }
        ];

        // show stores listed with in particular distance
        $subqueryDistance = "ST_Distance_Sphere(Point(stores.longitude,"
            . " stores.latitude),"
            . " Point($request->long, $request->lat ))"
            . " as distance";

        $subqueryDistanceWhere = "ST_Distance_Sphere(Point(stores.longitude,"
            . " stores.latitude),"
            . " Point($request->long, $request->lat ))"
            . " < stores.delivery_limit";

        $stores = Store::select('*', DB::raw($subqueryDistance))->whereRaw($subqueryDistanceWhere);

        // search for store's name, tagline etc
        if ($request->input('search')) {
            $search = $request->input('search');
            $stores = $stores->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('tagline', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('area', 'like', '%' . $search . '%');
            });
        }

        // filter non veg stores
        if ($request->input('veg_only')) {
            $stores = $stores->where('serves_non_veg', false);
        }

        // filter stores for price
        if ($request->input('cost_for_two_min') && $request->input('cost_for_two_max')) {
            $stores = $stores->where('cost_for_two', '>=', $request->input('cost_for_two_min'))
                ->where('cost_for_two', '<=', $request->input('cost_for_two_max'));
        }

        // filter for category
        if($request->input('category_id')) {
            $categoryId = $request->input('category_id');
            $stores = $stores->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }


        $stores = $stores->withCount($countsQuery);

        // filter out store that do not have approved menu items
        $stores = $stores->whereHas('menuitems', function ($query) {
            $query->where('status', 'approved');
        });

        // sort
        if ($request->input('cost_for_two_sort')) {
            if ($request->input('cost_for_two_sort') == 'asc') {
                $stores = $stores->orderBy('cost_for_two', 'asc');
            } else if ($request->input('cost_for_two_sort') == 'desc') {
                $stores = $stores->orderBy('cost_for_two', 'desc');
            }
        }

        return $stores;
    }

    /**
     * Calculate rating of a store
     * @return integer
     */
    public function getRatingsAttribute()
    {
        return Rating::where('store_id', $this->attributes['id'])->get()->avg->rating;
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'stores_categories');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function favourites()
    {
        return $this->hasMany('App\Models\Favourite');
    }

    public function menuitems()
    {
        return $this->hasMany('App\Models\MenuItem');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User\User', 'owner_id');
    }
}
