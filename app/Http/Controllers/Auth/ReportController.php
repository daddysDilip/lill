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

class ReportController extends Controller
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

    public function showChartReprot() {
        if(Auth::guard('user')->check()) {
            $userid = Auth::guard('user')->user()->id;
            $LinksData = UserLinks::where('userid',$userid)->select('id','website_url','generated_link','link_title','link_code','qr_code')->get();
            $LinkCountrys = DB::table('links_reports')->leftJoin('user_links as ul','ul.id','=','links_reports.link_id')->where('ul.userid',$userid)->select('countryName', 'countryCode')->groupBy('countryCode')->get();

            $TotalLinks = count($LinksData);
            return view('client_dashboard',compact('LinksData','TotalLinks','LinkCountrys'));
        }
        return redirect()->route('user.signin');
    }

    public function showLinksReprot(Request $request)
    {
        $userid = Auth::guard('user')->user()->id;
        $daterange = $request->daterange;
        
        if($daterange != "")
        {
            $dates = explode(" - ", $daterange);
            $start_date = date("Y-m-d", strtotime(trim($dates[0])));
            $end_date = date("Y-m-d", strtotime(trim($dates[1])));
            $LinksData = UserLinks::leftJoin('user_link_favorites as favorite','user_links.id','=','favorite.link_id')->where('user_links.userid',$userid)->where('user_links.status',1)->where('showOnDashboard',1)->whereBetween('user_links.created_at', [$start_date, $end_date])->select('user_links.*','favorite.id as favorite_id','favorite.userid as favorite_userid','favorite.link_id as link_id')->get();
        } else {
            $LinksData = UserLinks::leftJoin('user_link_favorites as favorite','user_links.id','=','favorite.link_id')->where('user_links.userid',$userid)->where('user_links.status',1)->where('showOnDashboard',1)->select('user_links.*','favorite.id as favorite_id','favorite.userid as favorite_userid','favorite.link_id as link_id')->get();
        }
        $TotalLinks = count($LinksData);
        return View('users/view-links-list', compact('LinksData','TotalLinks','TotalLinks','daterange'));
    }
}
