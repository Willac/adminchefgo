<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property  string name 
 * @property  string account_number
 * @property  double expiration_date
 * @property  integer cvv
 * @property  integer user_id
 */


class Card extends Model
{
    protected $fillable = ['user_id','account_number','name','cvv','expiration_date'];

    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User\User');
    }
}
