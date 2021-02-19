<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\SiteLogs as Log;

class LogController extends Controller
{
    public function index() {
        $activeMenu = "settings";
        $subMenu = "site_logs";
        
        //Adding Log Data.
        $moduleId = get_module("manage_site_logs");
        $log = add_log('info','Viewing site log details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        $LogData = Log::leftJoin('users','site_logs.userid','=','users.id')
                        ->leftJoin('site_modules','site_logs.moduleid','=','site_modules.id')
                        ->orderBy('site_logs.id','DESC')
                        ->select('site_logs.*','users.id as userid','users.firstname as firstname','users.lastname as lastname','site_modules.id as moduleid','site_modules.name as module_name')
                        ->get();

        return view('settings.site_logs',compact('activeMenu','subMenu','LogData'));
    }

    public function flushLogs() {
        if(Log::truncate()) {
            echo "success";
        } else {
            echo "fail";
        }
    }
}
