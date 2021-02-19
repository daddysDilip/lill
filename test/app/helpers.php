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

?>