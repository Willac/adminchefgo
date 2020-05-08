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

/**
 * @property  rating
 * @property  review
 * @property  delivery_profile__id
 * @property  user_id
 */

#delivery_ratings
class DeliveryRating extends Model
{
    use Sortable;

    protected $table = 'delivery_ratings';

    protected $fillable = ['rating', 'review', 'delivery_profile_id', 'user_id', 'order_id'];

    protected $hidden = ['user_id'];

    protected $with = array('user', 'delivery_profile');
    
    

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User\User', 'user_id');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\DeliveryProfile', 'delivery_profile_id');
    }
}
