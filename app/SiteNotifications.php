<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteNotifications extends Model
{
    protected $table = "site_notifications";
    public $fillable = ['id','userid','title','description','admin_status','user_status','created_at','updated_at'];

    public static function addNotification($data) {
        return SiteNotifications::insert($data);
    }
}
