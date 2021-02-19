<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkGroups extends Model
{
    protected $table = "link_groups";
    public $timestamps = false;

    public function group_links() {
        return $this->hasMany('App\GroupLinksMapping','group_id','id');
    }

    public static function fetchUserGroup($user_id) {
        return LinkGroups::where('user_id',$user_id)->get();
    }
}
