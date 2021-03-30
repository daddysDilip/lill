<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings;
use App\FAQ;
use DB;

class SettingsController extends Controller
{
    public function __construct()
    {
        if(Auth::guard('admin')->user() == null) {
            return Redirect::to('shortly-admin')->send();
        }
    }
    public function index() {
        $activeMenu = "settings";
        $subMenu = "manage_site_settings";
        $Settings = Settings::all();

        if (!get_user_permission("manage_site_settings","view")) {
            return redirect(403);
        }

        return view('settings.site_settings',compact('activeMenu','subMenu','Settings'));
    }

    public function showAllFAQ() {
        $activeMenu = "settings";
        $subMenu = "manage_faq";
        $FAQ = FAQ::all();

        if (!get_user_permission("manage_faq","view")) {
            return redirect(403);
        }

        return view('settings.site_faq',compact('activeMenu','subMenu','FAQ'));
    }

    public function updateSettings(Request $request) {
        $data = array(
            'company_name' => $request->input('company_name'),
            'contact_number' => $request->input('contact_number'),
            'email' => $request->input('email'),
            'guest_user_link_limit' => $request->input('guest_user_link_limit'),
            'address' => $request->input('address'),
            'facebook_link' => $request->input('facebook_link'),
            'twitter_link' => $request->input('twitter_link'),
            'instagram_link' => $request->input('instagram_link'),
            'pinterest_link' => $request->input('pinterest_link'),
        );

        if($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $default_image = time().rand(100,999)."-".$file->getClientOriginalName();
            $file->move(public_path().'/client/images/', $default_image);

            $old_default_img = $request->input("site_logo_path");
            DB::table('settings')->where('key','site_logo')->update(['value'=>$default_image]);
            if(file_exists(public_path().'\client\images\\'.$old_default_img) && $old_default_img != "") {
                unlink('client\images\\'.$old_default_img);
            }
        }



        foreach($data as $key => $value) {
            Settings::where('key',$key)->update(['value'=>$value]);
        }

        return redirect()->route('settings')->with('success','Settings updated');
    }

    public function changeSettingStatus(Request $request) {
        $id = $request->id;
        $status = $request->status;

        if($id != "" && $status != "" && $request->ajax()) {
            $query = Settings::find($id);
            $query->status = $status ?? '';

            if($query->save()) {
                return response()->json(['status' => 'success','msg' => 'Setting status changed successfully.']);
            } else {
                return response()->json(['status' => 'fail','msg' => 'Failed to change setting status.']);
            }
        } else {
            return response()->json(['status' => 'fail','msg' => 'Failed to change setting status.']);
        }
    }

    public function changeFAQStatus(Request $request) {
        $id = $request->id;
        $status = $request->status;

        if($id != "" && $status != "" && $request->ajax()) {
            $query = FAQ::find($id);
            $query->status = $status ?? '';

            if($query->save()) {
                return response()->json(['status' => 'success','msg' => 'FAQ status changed successfully.']);
            } else {
                return response()->json(['status' => 'fail','msg' => 'Failed to change FAQ status.']);
            }
        } else {
            return response()->json(['status' => 'fail','msg' => 'Failed to change FAQ status.']);
        }
    }

    public function createFAQ () {
        $activeMenu = "settings";
        $subMenu = "manage_faq";
        
        if (!get_user_permission("create_faq","view")) {
            return redirect(403);
        }

        return view('settings.create_faq',compact('activeMenu','subMenu'));
    }

    public function insertFAQ(Request $request) {
        $data = array(
            'question' => trim($request->question ?? ''),
            'answer' => trim($request->answer ?? ''),
            'status' => $request->status == 1 ? 1 : 0
        );

        if(FAQ::addFAQ($data)) {
            return redirect()->route('manage.faq')->with('success','FAQ Inserted successfully.');
        } else {
            return redirect()->route('manage.faq')->with('fail','Failed to insert FAQ.');
        }
    }

    public function editFAQ($id) {
        $FAQ = FAQ::find($id);

        if(!empty($FAQ)) {
            return view('settings.create_faq',compact('FAQ'));
        } else {
            return redirect()->route()->with('error','No results found.');
        }
    }

    public function updateFAQ(Request $request, $id) {
        $FAQ = FAQ::find($id);
        $FAQ->question = $request->question ?? '';
        $FAQ->answer = $request->answer ?? '';
        $FAQ->status = $request->status == 1 ? 1 : 0;

        if($FAQ->save()) {
            return redirect()->route('manage.faq')->with('success','FAQ Updated successfully.');
        } else {
            return redirect()->route('manage.faq')->with('error','Failed to update FAQ.');
        }
    }
}
