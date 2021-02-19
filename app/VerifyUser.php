<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $table = "verified_users";
    protected $guarded = [];
 
    public function user()
    {
        return $this->belongsTo('App\User', 'email');
    }
}
