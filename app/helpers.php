<?php

function get_country() {
    $Country = DB::table('country')->where('status',1)->get();
    if(!empty($Country)) {
        return $Country;
    } else {
        return "";
    }
}

function get_state() {
    $State = DB::table('state')->where('status',1)->get();
    if(!empty($State)) {
        return $State;
    } else {
        return "";
    }
}

function get_city() {
    $City = DB::table('city')->where('status',1)->get();
    if(!empty($City)) {
        return $City;
    } else {
        return "";
    }
}

function get_roles() {
    $Roles = DB::table('site_roles')->where('status',1)->get();
    if(!empty($Roles)) {
        return $Roles;
    } else {
        return "";
    }
}

function generateCode($limit){
	$code = '';
	for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
	return $code;
}

function getDateTime() {
    return date('Y-m-d h:i:s');
}

function get_setting_option($key) {
    return DB::table('settings')->where('key',$key)->first();
}

function get_tax() {
    return array(
        ['id' => 1,'tax' => '4'],
        ['id' => 2,'tax' => '8'],
        ['id' => 3,'tax' => '16'],
        ['id' => 4,'tax' => '24']
    );
}

function get_module($module) {
    return $Module = DB::table('site_modules')->where('name',$module)->where('status',1)->value('id');
}

function add_log($log_type,$desc,$moduleId,$userId,$created_at) {
    return DB::table('site_logs')->insert(
        [
            'log_type' => $log_type,
            'description' => $desc,
            'moduleid' => $moduleId,
            'userid' => $userId,
            'created_at' => $created_at
        ]
    );
}

function get_user_permission($module,$type) {
    $Permission = DB::select(
        "
        SELECT 
            perm.*,
            module.id as moduleid,module.name as moduleName 
        FROM site_permissions as perm
            JOIN site_modules as module on perm.moduleid = module.id 
        WHERE perm.roleid = '".Auth::guard('admin')->user()->roleid."' and module.name = '".$module."' and perm." .$type. "=1"
    ); 
    //dd($Permission);
    return count($Permission) > 0 ? true : false;
}

function getEndDate() {
    return date('Y-m-d h:i:s',strtotime(date("Y-m-d h:i:s", time()) . " + 365 day"));
}

function get_guest_links_count($ip) {
    return DB::table('user_links')->where('ip_address',$ip)->count();
}

function get_user_links_count($userid) {
    return DB::table('user_links')->where('userid',$userid)->count();
}

function get_user_links_group($userid) {    
    return DB::table('link_groups')->where('user_id',$userid)->count();
}

function get_user_plan($userid) {
    return DB::table('user_memberships')
                ->leftJoin('plans','user_memberships.plan_id','=','plans.id')
                ->where('user_memberships.userid',$userid)
                ->where('user_memberships.status',1)
                ->select('user_memberships.id as membership_id','user_memberships.userid as member_userid','user_memberships.plan_id as plan_id','user_memberships.plan_type_id as plan_type_id','plans.*')
                ->first();
}

function check_user_verified($user_id) {
    return DB::table('verified_users')->where('user_id',$user_id)->first();
}

function check_admin_login() {
    if(Auth::guard('web')->check()) {
        return true;
    } else {
        return false;
    }
}

?>