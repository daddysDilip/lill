<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class UserLinks extends Model
{
    protected $table = "user_links";
    protected $fillable = ['userid','website_url','generated_link','link_title','link_type','link_code','ip_address','domain','tags','qr_code','isGuestLink','status','showOnDashboard','created_at','updated_at'];

    public function links_type() {
        return $this->hasOne('App\LinkType','id','link_type');
    }

    public static function getTotalLinks($user_id) {
        return UserLinks::where('userid',$user_id)->where('status',1)->get()->count();
    }

    public static function getUserLinks($user_id) {
        return UserLinks::where('userid',$user_id)->get();
    }

    public static function get_link_by_id($linkid) {
        return UserLinks::where('id',$linkid)->first();
    }
}
