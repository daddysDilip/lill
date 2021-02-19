<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Mail;
use App\EmailTemplates;
use Illuminate\Support\Str;
use App\VerifyUser;
use App\UserMembership as Membership;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $finduser = User::where('email', $user->email)->first();
    
        if($finduser) {
    
            if(Auth::guard('user')->loginUsingId($finduser->id)) {   
                return redirect()->intended('/user-dashboard');
            } else {
                return redirect()->route('user.signin')->with('error','Failed to login with google. Please contact support for the same.');
            }
    
        } else{

            if(User::where('email',$user->email)->first()) {
                return redirect()->back()->with('error',"Unable to login. Account already exist with this email address.");
            } else {
                
                $firstname = $user->user['given_name'] ?? '';
                $lastname = $user->user['family_name'] ?? '';
                
                $newUser = User::create([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make('123456dummy'),
                ]); 
                
                if($newUser) {
                    
                    $link_token = sha1(time());
                    $link = url('/')."/verify-account/".$newUser->id."/".$link_token;
            
                    $emailtemplate =  EmailTemplates::where('label','welcome-mail')->first();
            
                    $find =  array('#email','#link');
                    $replace = array($user->email,$link);
                    
                    $subject = $emailtemplate->subject;
                    $content = str_replace($find,$replace,$emailtemplate->content);
                   
                    $to = $user->email;
            
                    $verify_user = new VerifyUser();
                    $verify_user->user_id = $newUser->id;
                    $verify_user->token = $link_token;
                    $verify_user->created_at = getDateTime();
                    $verify_user->save();

                    $membership = new Membership();
                    $membership->userid = $newUser->id;
                    $membership->plan_id = 1;
                    $membership->plan_type_id = 1;
                    $membership->start_date = getDateTime();
                    $membership->price = 0;
                    $membership->status = 1;
                    $membership->created_at = getDateTime();
                    $membership->save();
                    
                    try {

                        Mail::send('email',compact('content'), function ($message) use ($emailtemplate,$to){
                            $message->from($emailtemplate->fromEmail, $emailtemplate->from);
                            $message->to($to);
                            $message->subject($emailtemplate->subject);
                        });

                        if(Auth::guard('user')->attempt(['email' => $user->email,'password' => '123456dummy'])) {
                            return redirect()->intended('/user-dashboard');
                        } else {
                            return redirect()->route('user.signin')->with('error','Failed to login with google. Please contact support for the same.');
                        }

                    } catch (Exception $e) {
                        if (Mail::failures()) 
                        {
                            //$failures[] = Mail::failures()[0];
                            //Session::flash('error', 'Please Try Again...');
                            return redirect()->route('user.signin')->with('error','Failed to login with google. Please contact support for the same.');
                        }   
                    }

                } else {
                      
                }
            }
        }
    }
}
