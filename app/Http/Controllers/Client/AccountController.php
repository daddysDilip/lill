<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User as Client;
use App\UserMembership;
use App\UserLinks;
use App\UserMailMap;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\EmailTemplates;
use App\Favorite;
use App\SiteNotifications as Notification;

class AccountController extends Controller
{
    public function __construct()
    {
        // var_dump(Auth::guard('user')->user()); die;
        //$this->guard('user')->except('logout');
        /*if(Auth::guard('user')->user() == null)
        {
            // die('aaaaaaaaaaaaa');
            return redirect('/login');
        }*/
        // die('bbbbbbbbbbbb');
    }
    public function showAccountSettings($tab) {
        $userid = Auth::guard('user')->user()->id;
        if($tab == 'account-details') {
            $MembershipData = UserMembership::getUserMembership($userid);
            $TotalLinks = UserLinks::getTotalLinks($userid);
            return view('users.client_account_settings',compact('MembershipData','TotalLinks','tab'));
        } else if($tab == 'email-settings' || $tab == 'change-password') {
            return view('users.client_account_settings',compact('tab'));
        } else if($tab == 'hidden-links') {
            $HiddenLinks = UserLinks::where('userid',$userid)->where('showOnDashboard',0)->get();
            return view('users.client_account_settings',compact('tab','HiddenLinks'));
        } else if($tab == 'favorite-links') {
            $FavoriteLinks = Favorite::getFavoriteLinkByUserId(Auth::guard('user')->user()->id);
            return view('users.client_account_settings',compact('tab','FavoriteLinks'));
        }
    }

    public function changeAccountName(Request $request) {
        if($request->ajax()) {
            $client = Client::find(Auth::guard('user')->user()->id);
            $client->firstname = $request->firstname;
            $client->lastname = $request->lastname;

            if($client->save()) {
                return response()->json(['status' => '200', 'msg' => 'Account name changed successfully.']);
            } else {
                return response()->json(['status' => '204', 'msg' => 'Failed to change account name. Please try again later.']);
            }
        }
    }

    public function changePassword(Request $request) {
        $userid = Auth::guard('user')->user()->id;
        $client = Client::find($userid);
        try {
            if(Hash::check($request->old_password, $client->password)) {
                $client->password = Hash::make($request->input('new_password'));
                if($client->save()) {
                    return redirect()->back()->with('success','Your password has been changed successfully.');
                } else {
                    return redirect()->back()->with('error','Failed to change your password. Please try at some other time.');    
                }
            } else {
                return redirect()->back()->with('error','Invalid old password. Please try again.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error','Failed to change your password. Please try at some other time.');    
        }
    }

    public function checkNewEmailExist(Request $request) {
        if($request->ajax() && $request->input('email') != "") {
            if(Auth::guard('user')->user()->email == $request->email) {
                return response()->json(['status' => 'primary-email','msg' => "You've already account with entered email as your primary email address. Please enter different email address."]);
            } else {
                $check_email = count(DB::table('user_email_map')->where('userid',Auth::guard('user')->user()->id)->where('email',$request->input('email'))->get()) > 0 ? true : false;
                if($check_email) {
                    return response()->json(['status' => 'exist','msg' => "Email address already exist."]);
                } else {
                    return response()->json(['status' => 'available','msg' => "Email address available."]);
                }
            }
        }
    }

    public function addClientEmail(Request $request) {
        if($request->ajax()) {

            

        }
    }
}
