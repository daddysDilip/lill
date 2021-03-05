<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Auth;
use DB;
use App\UserLinks;
use App\VerifyUser;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function adminLogin(Request $request) {

        $Validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        if($Validator->fails()) {
            return redirect()->back()->with('error','Please enter your valid email address and password.')->withInput();
        } else {
            $accountStatus = $this->checkRestrictAdminUser($request->input('email'));
            
            if($accountStatus == false) {
                return redirect()->back()->with('error','Invalid email address or password. Please try again.');    
            }

            if(Auth::guard('admin')->attempt(['email' => $request->input('email') ,'password' => $request->input('password')], $request->get('remember'))) {
                return redirect()->intended('/admin-dashboard');
            } else {
                return redirect()->route('show.admin.login')->with('error','Incorrect email or password entered.');
            }
        }
    }

    public function checkRestrictAdminUser($email) {
        $admin = Admin::where('email',$email)->where('status',1)->first();
        if(!empty($admin)) {
            return true;
        }
        return false;
    }

    public function userLogin(Request $request) {
        
        $Validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        if($Validator->fails()) {
            return redirect()->back()->with('error','Please enter your valid email address or password.')->withInput();
        } else {

            $accountStatus = $this->checkRestrictUser($request->input('email'));
            
            if($accountStatus == false) {                
                return redirect()->back()->with('error','Account not found. Kindly verify your account first and then try to login.');    
            }

            if(Auth::guard('user')->attempt(['email' => $request->input('email') ,'password' => $request->input('password')], $request->get('remember'))) {
                return redirect()->intended('/user-dashboard');
            } else {
                return redirect()->route('user.signin')->with('error','Incorrect email or password entered.');
            }
        }
    }

    public function showClientDashboard() {
        if(Auth::guard('user')->check()) {
            $userid = Auth::guard('user')->user()->id;
            $TotalLinks = UserLinks::where('userid',$userid)->count();
            // pr($TotalLinks);

            $LatestHitLinks = DB::table('user_links as ul')->leftJoin('links_reports','ul.id','=','links_reports.link_id')->where('userid',$userid)->select('ul.id','ul.website_url','ul.generated_link','ul.link_title','ul.link_code',DB::raw('count(links_reports.id) as click_count'))->groupBy('ul.id')->take(5)->orderBy('links_reports.id', 'DESC')->get();
            // pr($LatestHitLinks);

            $trendingLinks = DB::table('user_links as ul')->leftJoin('links_reports','ul.id','=','links_reports.link_id')->where('userid',$userid)->select('ul.id','ul.website_url','ul.generated_link','ul.link_title','ul.link_code', DB::raw('count(links_reports.id) as click_count'))->groupBy('ul.id')->take(5)->orderBy('click_count', 'DESC')->get();
            // pr($trendingLinks);

            $maxClickLocation = DB::table('links_reports')->leftJoin('user_links as ul','ul.id','=','links_reports.link_id')->where('links_reports.countryCode','<>',"")->where('ul.userid',$userid)->select(DB::raw('count(links_reports.id) as click_count'), 'countryName', 'countryCode')->groupBy('countryCode')->orderBy('click_count', 'DESC')->first();
            // pr($maxClickLocation); die;

            return view('client_home',compact('LatestHitLinks','TotalLinks','trendingLinks','maxClickLocation'));
        }
        return redirect()->route('user.signin');
    }

    /*public function showClientDashboard_old() {
        if(Auth::guard('user')->check()) {
            $userid = Auth::guard('user')->user()->id;
            $LinksData = UserLinks::where('userid',$userid)->select('id','website_url','generated_link','link_title','link_code','qr_code')->get();
            $LinkCountrys = DB::table('links_reports')->leftJoin('user_links as ul','ul.id','=','links_reports.link_id')->where('ul.userid',$userid)->select('countryName', 'countryCode')->groupBy('countryCode')->get();

            $TotalLinks = count($LinksData);
            return view('client_dashboard',compact('LinksData','TotalLinks','LinkCountrys'));
        }
        return redirect()->route('user.signin');
    }*/

    public function checkRestrictUser($email) {
        $user = User::where('email',$email)->where('status',1)->first();
        if(!empty($user)) {
            return true;
        }
        return false;
    }
    
    public function adminLogout() {
        Session::flush();
        Auth::logout();
        return redirect('/shortly-admin');
    }

    public function userLogout() {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
