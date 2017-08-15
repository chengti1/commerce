<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = ['provider_user_id', 'provider', 'email'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id', 'user_id');
    }
}
