<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\UserLinks;
use App\LinksReport as Report;
use Jenssegers\Agent\Agent;
use Location;
use Carbon\Carbon;
use SafeBrowsing;
use App\LinksReport;
use Illuminate\Support\Facades\URL;
use DB;


class URLReadController extends Controller
{

    public function fetchLinkSchema($code) {

        
        $link = DB::table('user_links')->where('link_code',$code)->select('id','generated_link','website_url')->first();
        
        if(!empty($link)) {

            //Contains the address of the previous web page from which a link to the currently requested page was followed.
            //$reference = Request::server('HTTP_REFERER');

            $device_type = "";

            $agent = new Agent();

            $device_lang = $agent->languages();
            $lang = $device_lang[0];

            //Getting Location Data.
            $location = Location::get(get_ip());

            if($agent->isDesktop()) {
                $device_type = "desktop";
            } else if($agent->isMobile()) {
                $device_type = "mobile";
            } else if($agent->isTablet()) {
                $device_type = "desktop";
            } else {
                $device_type = null;
            }

            $link_report = new Report();
            $link_report->link_id = $link->id;
            $link_report->ip_address = get_ip();
            $link_report->latitude = $location->latitude ?? null;
            $link_report->longitude = $location->longitude ?? null;
            $link_report->countryName = $location->countryName ?? null;
            $link_report->countryCode = $location->countryCode ?? null;
            $link_report->regionCode = $location->regionCode ?? null;
            $link_report->regionName = $location->regionName ?? null;
            $link_report->cityName = $location->cityName ?? null;
            $link_report->zipCode = $location->zipCode ?? null;
            $link_report->click_source_url = $reference ?? null;
            $link_report->click_browser = $agent->browser();
            $link_report->device_type = $device_type;
            $link_report->click_platform_os = $agent->platform();
            $link_report->browser_language = $lang;
            $link_report->created_at = getDateTime();

            //Checks if current date = click_date
            $check_unique_click = Report::where('ip_address',get_ip())->where('link_id',$link->id)->whereDate('created_at',date('Y-m-d'))->select('id','ip_address','created_at')->first();
            if(!empty($check_unique_click)) {
                
                $to = Carbon::createFromFormat('Y-m-d H:i:s', $check_unique_click->created_at);
                $from = Carbon::createFromFormat('h:i:s', date('h:i:s'));
                
                //Calculates difference between click date and current date (in minutes).
                $diff_in_minutes = $to->diffInMinutes($from);

                if($diff_in_minutes <= 30) {
                    return redirect()->away((is_null(parse_url($link->website_url, PHP_URL_HOST)) ? '//' : '').$link->website_url);
                } else if($agent->isRobot()) {
                    return redirect()->route('link.show.bot');
                } else {
                    return redirect()->away((is_null(parse_url($link->website_url, PHP_URL_HOST)) ? '//' : '').$link->website_url);
                }
            } else {
                if($agent->isRobot()) {
                    return redirect()->route('link.show.bot');
                } else { 
                    if($link_report->save()) {
                        return redirect()->away((is_null(parse_url($link->website_url, PHP_URL_HOST)) ? '//' : '').$link->website_url);
                    } else {
                        return redirect()->away((is_null(parse_url($link->website_url, PHP_URL_HOST)) ? '//' : '').$link->website_url);
                    }
                }
            }
        } else {
            echo "Link Not Found";
        }
        
    }

    public function showBotPage() {
        return view('tools.bot_detect');
    }

    public function searchURL(Request $request) {
        if($request->ajax()) {
            $response = array();
            $userid = Auth::guard('user')->user()->id;
            $str = $request->input('search_link');
            $link_query = UserLinks::where('userid',$userid)
                                ->where('website_url','like','%'.$str.'%')
                                //->orWhere('generated_link','like','%'.$str.'%')
                                ->where('status',1)
                                ->get();
                                
            if(!empty($link_query)) {
                //echo json_encode($link_query);
                foreach($link_query as $link){
                    $response[] = array("value"=>$link->link_code,"label"=>$link->generated_link);
                }
                echo json_encode($response);
                exit;
            }
        }
    }

    public function fetchLinks(Request $request) {
        if($request->ajax() || !empty($request->search_link)) {
            $userid = Auth::guard('user')->user()->id;
            if($request->link_code == "all") {
                $LinksData = UserLinks::leftJoin('user_link_favorites as favorite','user_links.id','=','favorite.link_id')->where('user_links.userid',$userid)->where('user_links.status',1)->where('showOnDashboard',1)->select('user_links.*','favorite.id as favorite_id','favorite.userid as favorite_userid','favorite.link_id as link_id')->get();
                if(!empty($LinksData) && count($LinksData) > 0) {
                    $TotalLinks = count($LinksData);
                    $view = view("partials.dashboard.links_sidebar",compact('LinksData','TotalLinks'))->render();
                    return response()->json(['status' => '200','data' => $view]);
                } else {    
                    $msg = "No details to display.";
                    $view = view("partials.dashboard.empty_link",compact('msg'))->render();
                    return response()->json(['status' => '204','data' => $view]);
                }
            } else if(!empty($request->search_link)) {
                $userid = Auth::guard('user')->user()->id;
                $str = $request->input('search_link');
                $LinksData = UserLinks::where('userid',$userid)
                                ->where('generated_link','like','%'.$str.'%')
                                ->orWhere('website_url','like','%'.$str.'%')
                                ->where('status',1)
                                ->get();
                // dd($LinksData);
                if(!empty($LinksData) && count($LinksData) > 0) {
                    $TotalLinks = count($LinksData);
                    $view = view("partials.dashboard.links_sidebar",compact('LinksData','TotalLinks'))->render();
                    return response()->json(['status' => '200','data' => $view]);
                } else {    
                    $msg = "No details to display.";
                    $view = view("partials.dashboard.empty_link",compact('msg'))->render();
                    return response()->json(['status' => '204','data' => $view]);
                }
            } else {
                
                $LinksData = UserLinks::where('userid',$userid)->where('link_code',$request->link_code)->where('status',1)->get();
                if(!empty($LinksData) && count($LinksData) > 0) {
                    $TotalLinks = count($LinksData);
                    $view = view("partials.dashboard.links_sidebar",compact('LinksData','TotalLinks'))->render();
                    return response()->json(['status' => '200','data' => $view]);
                } else {    
                    $msg = "No details to display.";
                    $view = view("partials.dashboard.empty_link",compact('msg'))->render();
                    return response()->json(['status' => '204','data' => $view]);
                }
            }
        }
    }

    public function fetchLinkData(Request $request) {
        if($request->ajax()) {
            $userid = Auth::guard('user')->user()->id;
            $Link = UserLinks::where('id',$request->link_id)->where('userid',$userid)->first();
            if(!empty($Link)) {
                $view = view("partials.dashboard.link_details",compact('Link'))->render();
                return response()->json(['status' => '200','data' => $view]);
            } else {
                $msg = "No details to display.";
                $view = view("partials.dashboard.empty_link",compact('msg'))->render();
                return response()->json(['status' => '204','data' => $view]);
            }
        } else {
            return response()->json(['status' => '404']);
        }
    }

    // public function fetchLinkData(Request $request) {
    //     if($request->ajax() || !empty($request->search_link)) {
    //         $userid = Auth::guard('user')->user()->id;
    //         if($request->link_code == "all") {
    //             $months = array(
    //                 'January'.date('Y'),
    //                 'February'.date('Y'),
    //                 'March'.date('Y'),
    //                 'April'.date('Y'),
    //                 'May'.date('Y'),
    //                 'June'.date('Y'),
    //                 'July'.date('Y'),
    //                 'August'.date('Y'),
    //                 'September'.date('Y'),
    //                 'October'.date('Y'),
    //                 'November'.date('Y'),
    //                 'December'.date('Y'),
    //             );
    //             $LinksData = UserLinks::leftJoin('user_link_favorites as favorite','user_links.id','=','favorite.link_id')->where('user_links.userid',$userid)->where('user_links.status',1)->where('showOnDashboard',1)->select('user_links.*','favorite.id as favorite_id','favorite.userid as favorite_userid','favorite.link_id as link_id')->get();
    //             if(!empty($LinksData) && count($LinksData) > 0) {
    //                 $TotalLinks = count($LinksData);
    //                 $view = view("partials.dashboard.link_details",compact('LinksData','TotalLinks','months'))->render();
    //                 return response()->json(['status' => '200','data' => $view]);
    //             } else {    
    //                 $msg = "No details to display.";
    //                 $view = view("partials.dashboard.empty_link",compact('msg'))->render();
    //                 return response()->json(['status' => '204','data' => $view]);
    //             }
    //         } else {
    //             $LinksData = UserLinks::where('userid',$userid)->where('link_code','like','%'.$request->link_code.'%')->where('status',1)->get();
    //             if(!empty($LinksData) && count($LinksData) > 0) {
    //                 $TotalLinks = count($LinksData);
    //                 $view = view("partials.dashboard.link_details",compact('LinksData','TotalLinks'))->render();
    //                 return response()->json(['status' => '200','data' => $view]);
    //             } else {    
    //                 $msg = "No details to display.";
    //                 $view = view("partials.dashboard.empty_link",compact('msg'))->render();
    //                 return response()->json(['status' => '204','data' => $view]);
    //             }
    //         }
    //     } else {
    //         return response()->json(['status' => '404']);
    //     }
    // }

    public function getMonthlyReport(Request $request) {
        //$monthly_report = DB::table('links_repots')->select(DB::raw("COUNT(id) as total_clicks"), DB::raw("MONTH(created_at) as month"))->where('link_id',$request->link_id)->whereYear('created_at',date('Y'))->groupBy('month')->get();
        $monthly_report = LinksReport::select(DB::raw("count(id) as total_clicks,MONTHNAME(created_at) as month,YEAR(created_at) as year"))->where('link_id',$request->link_id)->whereYear('created_at',date('Y'))->groupBy('month')->get();
        if(!empty($monthly_report) || count($monthly_report) > 0) {
            $months = ['January '.date('Y'),'February '.date('Y'),'March '.date('Y'),'April '.date('Y'),'May '.date('Y'),'June '.date('Y'),'July '.date('Y'),'August '.date('Y'),'September '.date('Y'),'October '.date('Y'),'November '.date('Y'),'December    '.date('Y')];
            return response()->json(['monthly_report' => $monthly_report,'months'=>$months]);
        }
    }

    public function sortLink(Request $request) {
        if($request->ajax()) {
            return $request->all();
        }
    }
    public function fetchLinkMap(Request $request) {
        
        $map_report = LinksReport::select(DB::raw("count(id) as total_clicks, countryCode"))->where('link_id',$request->link_id)->groupBy('countryCode')->get();
        // pr(object_to_array($map_report));
        $filter = [];
        foreach (object_to_array($map_report) as $key => $val)
        {
            if($val['countryCode'] == NULL || $val['countryCode'] == "IN" )
            {
                if(array_key_exists('IN', $filter))
                {
                    $filter['IN'] = $filter['IN'] + $val['total_clicks'];
                } else {
                    $filter['IN'] = $val['total_clicks'];
                }
            } else {
                $filter[$val['countryCode']] = $val['total_clicks'];
            }
        }
        $last = get_map_country();
        foreach($last as $k => $v)
        {
            if(array_key_exists($v['code'], $filter))
            {
                $last[$k]['value'] = $filter[$v['code']];
            }
            if($last[$k]['value'] == 0)
            {
                unset($last[$k]);
            }
        }
        // echo sizeof($last);
        // pr($last); die;


        return response()->json(array_values($last));
    }
}
