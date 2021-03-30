<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LinkType;
use Auth;

class LinkTypeController extends Controller
{
    public function __construct()
    {
        if(Auth::guard('admin')->user() == null) {
            return Redirect::to('shortly-admin')->send();
        }
    }
    public function index() {
        $activeMenu = "settings";
        $subMenu = "manage_link_types";
        $LinkTypes = LinkType::all();

        //Adding Log Data.
        $moduleId = get_module("manage_link_types");
        $log = !empty($moduleId) ? add_log('info','View link types detail.',$moduleId,Auth::guard('admin')->user()->id,getDateTime()) : '';

        return view('link_types.index',compact('activeMenu','subMenu','LinkTypes'));
    }

    public function createLinkType() {
        $activeMenu = "settings";
        $subMenu = "manage_link_types";

        //Adding Log Data.
        $moduleId = get_module("manage_link_types");
        $log = !empty($moduleId) ? add_log('info','Create link types detail.',$moduleId,Auth::guard('admin')->user()->id,getDateTime()) : '';

        return view('link_types.create',compact('activeMenu','subMenu'));
    }
}
