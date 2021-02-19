<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use DB;
use App\EmailTemplates;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Mail;

class ResetPasswordController extends Controller
{
    public function showForgotPassword() {
        return view('auth.passwords.forgot_password');
    }

    public function sendVerificationLink(Request $request) {
        
            $user = DB::table('users')->where('email','=',$request->input('email'))->where('status','=',1)->first();

            if(empty($user)) {
                return redirect()->back()->with('error','Email address not found.');
            }
            
            $email = $user->email;
            
            $link_token = Str::random(60);
            $link = url('/')."/verify-password-link/".$link_token."/".$email;
            
            $emailtemplate =  EmailTemplates::where('Label','reset-password-link')->first();
            $find =  array('#link');
            $replace = array($link);
            
            $subject = $emailtemplate->subject;
            $content = str_replace($find,$replace,$emailtemplate->content);
        
            $to = $email;

            Mail::send('email',compact('content'), function ($message) use ($emailtemplate,$to){
                $message->from($emailtemplate->fromEmail, $emailtemplate->from);
                $message->to($to);
                $message->subject($emailtemplate->subject);
            });

            $store_token = DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $link_token,
                'created_at' => date('Y-m-d h:i:s')
            ]);

            if (Mail::failures()) 
            {
                //$failures[] = Mail::failures()[0];     
                return redirect()->back()->with('success','A reset password link has been sent on your email.');
            }
            return redirect()->back()->with('success','A reset password link has been sent on your email.');
    }

    public function verifyResetLink($token,$email) {
        if(!empty($token) && !empty($email)) {
            $check_token = DB::table('password_resets')->where('email','=',$email)->where('token','=',$token)->first();
            if(!empty($check_token)) {
                return view('auth.passwords.reset')->with('email',$email)->with('link_token',$token);
            } else {
                return redirect(403);
            }
        } else {
            return redirect(403);
        }
    }

    public function changePassword(Request $request) {
        if(!empty($request->input('email')) && !empty($request->input('link_token'))) {
            $query = DB::table('users')->where('email',$request->input('email'))->update(['password' => Hash::make($request->input('confirm_password'))]);
            $user = DB::table('users')->where('email',$request->input('email'))->first();
            DB::table('password_resets')->where('email','=',$request->input('email'))->where('token','=',$request->input('link_token'))->delete();

            $email = $user->email;
            
            $emailtemplate =  EmailTemplates::where('Label','reset-password-success')->first();
            
            // $find =  array('#Link#');
            // $replace = array($link);
            
            $subject = $emailtemplate->subject;
            $content = $emailtemplate->content;
        
            $to = $email;

            Mail::send('email',compact('content'), function ($message) use ($emailtemplate,$to){
                $message->from($emailtemplate->fromEmail, $emailtemplate->from);
                $message->to($to);
                $message->subject($emailtemplate->subject);
            });

            if (Mail::failures()) 
            {
                //$failures[] = Mail::failures()[0];     
            }

            if($query) {
                return redirect('/signin')->with('success','Password has been reset successfully.');
            } else {
                return redirect('/signin')->with('error','Failed to change password. Please try again later or contact support for the same.');
            }
        } else {
            return redirect(403);
        }
    }
}   
