<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    protected $table = "user_memberships";

    public static function getUserMembership($user_id) {
        return UserMembership::leftJoin('plans','user_memberships.plan_id','=','plans.id')
                ->where('user_memberships.userid',$user_id)
                ->select('user_memberships.*','plans.id as plan_id','plans.plan_type_id as plan_type_id','plans.name as plan_name','plans.total_links as total_links')
                ->first();
    }
}
