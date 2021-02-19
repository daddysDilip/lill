<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Mail;
use App\EmailTemplates;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\VerifyUser;
use App\UserMembership as Membership;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    //use RegistersUsers;

    public function checkUserEmailExist(Request $request) {
        $email = $request->input('email');
        if(!empty($email)) {
            $email_exists = (count(User::where('email', '=', $email)->get()) > 0) ? false : true;
            return response()->json($email_exists);
        }
    }

    public function createUser(Request $request) {
        $validatedData = $request->validate([
            'account_type' => 'required',
            'company_name' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:8|max:12'
        ]);

        $email = $request->input('email');
        $account_type = $request->input('account_type');

        $user = new User();
        $user->account_type = $account_type;
        $user->email = $email;
        $user->company_name = $request->input('company_name');
        $user->password = Hash::make($request->input('password'));
        $user->roleid = 4;
        $user->status = 0;
        try {

            if(!$user->save()) {
                return redirect()->back()->with('error','Failed to register your account. Please try later or contact support for the same.');
            }

            $link_token = sha1(time());
            $link = url('/')."/verify-account/".$user->id."/".$link_token;

            $emailtemplate =  EmailTemplates::where('label','welcome-mail')->first();

            $find =  array('#email','#link');
            $replace = array($email,$link);
            
            $subject = $emailtemplate->subject;
            $content = str_replace($find,$replace,$emailtemplate->content);
        
            $to = $email;

            $verify_user = new VerifyUser();
            $verify_user->user_id = $user->id;
            $verify_user->token = $link_token;
            $verify_user->created_at = getDateTime();
            $verify_user->save();

            $membership = new Membership();
            $membership->userid = $user->id;
            $membership->plan_id = $request->plan_id ?? 1;
            $membership->plan_type_id = $request->plan_id ?? 1;
            $membership->start_date = getDateTime();
            $membership->price = 0;
            $membership->status = 1;
            $membership->created_at = getDateTime();
            $membership->save();
            
            Mail::send('email',compact('content'), function ($message) use ($emailtemplate,$to){
                $message->from($emailtemplate->fromEmail, $emailtemplate->from);
                $message->to($to);
                $message->subject($emailtemplate->subject);
            }); 

            if (Mail::failures()) 
            {
                Log::info('Failed to send email -> '.$failures[] = Mail::failures()[0]);
                return redirect('signup')->with('success',"You've registered successfully. Please check your email to verify your account.");
            }

            return redirect('signup')->with('success',"You've registered successfully. Please check your email to verify your account.");

        } catch (Exception $e) {
            Log:info("Error during user registration : ".$e);
            return redirect('signup')->with('success',"You've registered successfully. Please check your email to verify your account.");
        }
    }    

    public function verifyUserAccount($userid,$token) {
        if(!empty($token) && !empty($userid)) {
            $check_token = VerifyUser::where('user_id','=',$userid)->where('token','=',$token)->first();
            if(!empty($check_token)) {
                $account_type = User::where('id',$userid)->select('id','account_type')->first();
                return view('auth.verify_account',compact('account_type','token'));
            } else {
                return redirect(403);
            }
        } else {
            return redirect(403);
        }
    }

    public function confirmUserAccount(Request $request, $id) {
        $account_type = $request->account_type;
        $user = User::find($id);
        if($account_type == "business") {

            $validatedData = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'contactno' => 'required|min:10|numeric',
                'job_title' => 'required',
                'website' => 'required',
                'company_size' => 'required|numeric'
            ]);
            
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->contactno = $request->input('contactno');
            $user->job_title = $request->job_title;
            $user->company_website = $request->input('website');
            $user->company_size = $request->input('company_size');
            $user->account_type = $account_type ?? '';

        } else {

            $validatedData = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required'
            ]);
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
        }

        $delete_token = VerifyUser::where('user_id','=',$user->id)->where('token','=',$request->verify_token)->delete();
        $user_status = User::where('id',$user->id)->update(['status' => 1]);

        if($user->save()) {
            return view('auth.account_confirmation');
        } else {
            return redirect()->route('signup')->with('error','Failed to verify your account. Please try again later or contact support for the same.');
        }
    }
}
