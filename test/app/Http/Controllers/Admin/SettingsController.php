<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings;

class SettingsController extends Controller
{
    public function index() {
        $activeMenu = "settings";
        $subMenu = "manage_site_settings";
        $Settings = Settings::all();
        return view('settings.site_settings',compact('activeMenu','subMenu','Settings'));
    }

    public function updateSettings(Request $request) {
        $data = array(
            'company_name' => $request->input('company_name')
        );

        foreach($data as $key => $value) {
            Settings::where('key',$key)->update(['value'=>$value]);
        }

        return redirect()->route('settings')->with('success','Settings updated');
    }
}
