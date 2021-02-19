<?php

namespace App\Http\Controllers\Auth;

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

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/signup';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:user');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegisterForm($plan = 'standard') {
        $plan_type = 0;
        if($plan == 'standard')
        {
            $plan_type = 1;
        } else if($plan == 'premium')
        {
            $plan_type = 2;
        } else if($plan == 'enterprise')
        {
            $plan_type = 3;
        } else {
            $plan_type = 1;
        }
        
        // $plan = ($plan == 'standard') ? $plan = 1 : ($plan == 'premium' ? $plan = 2 : ($plan == 'enterprise') ? $plan = 3 : 1);
        return view('auth.register',compact('plan'));
    }

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
            $failures[] = Mail::failures()[0];
            //Session::flash('error', 'Please Try Again...');
        }
        else
        {
        	//Session::flash('success', 'Thank You For Your Message. It has been Sent...');
        }

        return redirect()->route('register')->with('success',"You've registered successfully. Please check your email to verify your account.");
    }    

    public function verifyUserAccount($userid,$token) {
        if(!empty($token) && !empty($userid)) {
            $check_token = VerifyUser::where('user_id','=',$userid)->where('token','=',$token)->first();
            if(!empty($check_token)) {
                $account_type = User::where('id',$userid)->select('id','account_type')->first();
                $delete_token = VerifyUser::where('user_id','=',$userid)->where('token','=',$token)->delete();
                $user_status = User::where('id',$userid)->update(['status' => 1]);
                return view('auth.verify_account',compact('account_type'));
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

        } else {
            $validatedData = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required'
            ]);
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
        }

        if($user->save()) {
            return view('auth.account_confirmation');
        } else {
            return redirect()->route('signup')->with('error','Failed to verify your account. Please try again later or contact support for the same.');
        }
    }
}
