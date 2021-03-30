<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use DB;
use URL;
use App\UserLinks;
use App\Favorite;
use QrCode;
use Jenssegers\Agent\Agent;
use Location;
use Share;
use App\Notifications\NewLinkNotification as LinkNotification;
use App\GroupLinksMapping as LinkMapping;

class URLGenerateController extends Controller
{

    public function showCreateLink() {
        $LinkType = DB::table('link_types')->where('status',1)->get();
        return view('client_links.create_link');
    }

    // function get_favicon($url) {
    //     // $doc = new \DOMDocument();
    //     // $doc->strictErrorChecking = FALSE;
    //     // @$doc->loadHTML(file_get_contents($url));
    //     // $xml = simplexml_import_dom($doc);
    //     // $arr = $xml->xpath('//link[@rel="shortcut icon"]');
    //     // if (!empty($arr[0]['href'])) {
    //     //     return $arr[0]['href'];
    //     // } else {
    //     //     return null;
    //     // }
    //     $html=file_get_contents($url);
    //         $dom=new \DOMDocument();
    //         @$dom->loadHTML($html);
    //         $links=$dom->getElementsByTagName('link');
    //         $favicon='';

    //         for($i=0;$i < $links->length;$i++ )
    //         {
    //             $link=$links->item($i);
    //             if($link->getAttribute('rel')=='icon'||$link->getAttribute('rel')=="Shortcut Icon"||$link->getAttribute('rel')=="shortcut icon")
    //             {
    //                 $favicon=$link->getAttribute('href');
    //             }
    //         }

    //         if(!empty($favicon) && $favicon == "img/favicon.png" || $favicon == "img/favicon.ico") {
    //             return $url.$favicon;
    //         } else {
    //             return null;
    //         }
    // }

    function fetchWebsiteSchema(Request $request) {
        if($request->ajax()) {
            $link_type = $request->link_type;
            $url = $request->website_url;

            // if((!(substr($request->website_url, 0, 7) == 'http://')) && (!(substr($request->website_url, 0, 8) == 'https://')) && (!(substr($request->website_url, 0, 111) == 'http://www.'))) {
            //     $url = "http://www.".$request->website_url;
            // } else if((!(substr($request->website_url, 0, 11) == 'https://www.')) || (!(substr($request->website_url, 0, 10) == 'http://www.'))) {
            //     //echo basename($request->website_url);
            //     echo substr($request->website_url, 0, 8);
            // } else {
            //     $url = $request->website_url;
            // }
            
            $meta_title = get_url_data($url,$link_type);
            $favicon = get_favicon($url);    
            if(!empty($meta_title)) {
                $meta_title['link'] = remove_http($meta_title['link']);
                echo json_encode(['status' => '200','meta_title' => $meta_title,'favicon' => $favicon]);
            } else {
                echo json_encode(['status' => '404','msg' => 'Unable to generate link. Please check if URL is valid or try again later.']);
            }

        }
    }

    public function createGuestLink($url) {
        
        if($url != "") {
                
            $link_data = get_guest_url_data($url);

            if(!empty($link_data)) {
                $user_link = new UserLinks();
                $user_link->website_url = $link_data['final_url'];
                $user_link->generated_link = $link_data['generated_link'];
                $user_link->link_type = 1;
                $user_link->link_code = $link_data['code'];
                $user_link->ip_address = get_ip();
                $user_link->isGuestLink = 1;
                $user_link->status = 1;
                $user_link->created_at = getDateTime();

                if(!check_guest_link_exist($url,get_ip(),1)) {
                    if($user_link->save()) {
                        return ['result' => 'success','msg' => 'Link generated successfully.','link' => $link_data['generated_link']];
                    } else {
                        return ['result' => 'link-fail','msg' => 'Failed to generate link at this momment. Please try again later.'];
                    }
                } else {    
                    $user_link = get_user_link($url,get_ip()); 
                    if(!empty($user_link)) {
                        return ['result' => 'success','msg' => 'Link generated successfully.','link' => $user_link->generated_link];
                    } else {
                        return ['result' => 'link-fail','msg' => 'Failed to generate link at this momment. Please try again later.']; 
                    }
                }
            } else {
                return ['result' => 'link-fail','msg' => 'Failed to generate link at this momment. Please try again later.'];
            }
        }

    }
    
    public function createGuestLinkWithType($url,$type) {
        if($url != "" && $type != "") {
            $link_data = get_guest_url__link_type_data($url,$type);

            $user_link = new UserLinks();
            $user_link->website_url = $link_data['final_url'];
            $user_link->generated_link = $link_data['generated_link'];
            $user_link->link_type = $type;
            $user_link->link_code = $link_data['code'];
            $user_link->ip_address = get_ip();
            $user_link->isGuestLink = 1;
            $user_link->status = 1;
            $user_link->created_at = getDateTime();

            if(!check_guest_link_exist($url,get_ip(),$type)) {
                if($user_link->save()) {
                    return ['result' => 'success','msg' => 'Link generated successfully.','link' => $link_data['generated_link']];
                } else {
                    return ['result' => 'link-fail','msg' => 'Failed to generate link at this momment. Please try again later.'];
                }
            } else {    
                $user_link = get_user_link($url,get_ip()); 
                if(!empty($user_link)) {
                    return ['result' => 'success','msg' => 'Link generated successfully.','link' => $user_link->generated_link];
                } else {
                    return ['result' => 'link-fail','msg' => 'Failed to generate link at this momment. Please try again later.']; 
                }
            }
        } else {
            return ['result' => 'link-fail','msg' => 'Failed to generate link at this momment. Please try again later.']; 
        }
    }

    function checkGuestUser(Request $request) {
        $website_url = $request->guest_client_website_url ?? $request->client_website_url ?? $request->client_website_url_two;
        $link_type = $request->link_type ?? '';
        $check_user = DB::table('guest_users')->where('ip_address',get_ip())->get();
        $guest_link_limit = get_setting_option('guest_user_link_limit')->value;
        
        if(count($check_user) > 0) {
            $count_guest_links = get_guest_links_count(get_ip());
            if($count_guest_links < $guest_link_limit) {
                if($website_url != "" && $link_type == "") {
                    $create_link_query = $this->createGuestLink($website_url);
                    if($create_link_query['result'] == "success") {
                        $links_left = $guest_link_limit - get_guest_links_count(get_ip());
                        $generated_link = $create_link_query['link'];
                        $share_links = Share::page($generated_link, 'Lill.pw')
                                ->facebook()
                                ->twitter()
                                ->linkedin('Sharing link');
                        $view = view('partials.client.ui.share_links',compact('share_links'))->render();
                        return response()->json([
                                'status' => 'success',
                                'msg' => 'Link generated successfully.',
                                'link' => $generated_link,
                                'user_status'=>'registered',
                                'links_left' => $links_left,
                                'share_links' => $view
                            ]);
                    } else {
                        return response()->json([
                            'status' => 'link-fail',
                            'msg' => 'Failed to generate link at this momment. Please try again later.',
                        ]);
                    }
                } else if($website_url != "" && $link_type != "") {
                    $create_link_query = $this->createGuestLinkWithType($website_url,$link_type);
                    if($create_link_query['result'] == "success") {
                        $links_left = $guest_link_limit - get_guest_links_count(get_ip());
                        $generated_link = $create_link_query['link'];
                        $share_links = Share::page($generated_link, 'Lill.pw')
                                ->facebook()
                                ->twitter()
                                ->linkedin('Sharing link');
                        $view = view('partials.client.ui.share_links',compact('share_links'))->render();
                        return response()->json([
                                'status' => 'success',
                                'msg' => 'Link generated successfully.',
                                'link' => $generated_link,
                                'user_status'=>'registered',
                                'links_left' => $links_left,
                                'share_links' => $view
                            ]);
                    } else {
                        return response()->json([
                            'status' => 'link-fail',
                            'msg' => 'Failed to generate link at this momment. Please try again later.',
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 'link-fail',
                        'msg' => 'Failed to generate link at this momment. Please try again later.',
                    ]);
                }
            } else {
                return response()->json(['status' => 'limit-exhausted','msg' => "You've exhausted your limit as a guest user to generate links. Do you want to upgrade the plan?"]);
            }
        } else { 
            return response()->json(['status' => 'success','user_status'=>'guest']);
        }  
    }

    public function storeGuestUserData(Request $request) {
        if($request->ajax()) {

            
            $website_url = $request->guest_website_url;
            $link_type = $request->guest_link_type ?? '';
            $guest_firstname = $request->guest_firstname;
            $guest_lastname = $request->guest_lastname;
            $guest_email = $request->guest_email;
            $guest_phone_number = $request->guest_phone_number;

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

            $guestUser = array(
                'firstname' => $guest_firstname,
                'lastname' => $guest_lastname,
                'email' => $guest_email,
                'phone_number' => $guest_phone_number,
                'ip_address' => get_ip(),
                'latitude' => $location->latitude ?? null,
                'longitude' => $location->longitude ?? null,
                'countryName' => $location->countryName ?? null,
                'countryCode' => $location->countryCode ?? null,
                'regionCode' => $location->regionCode ?? null,
                'regionName' => $location->regionName ?? null,
                'cityName' => $location->cityName ?? null,
                'zipCode' => $location->zipCode ?? null,
                'browser' => $agent->browser(),
                'device_type' => $device_type,
                'platform_os' => $agent->platform(),
                'browser_language' => $lang,
                'created_at' => getDateTime(),
            );

            $guest_link_limit = get_setting_option('guest_user_link_limit')->value;
            $count_guest_links = get_guest_links_count(get_ip());
            if($count_guest_links < $guest_link_limit) {
                $create_link_query = (empty($link_type) || $link_type == "" ? $this->createGuestLink($website_url) : $this->createGuestLinkWithType($website_url,$link_type));
                if($create_link_query['result'] == "success") {
                    $guest_user_query = DB::table('guest_users')->insert($guestUser);
                    if($guest_user_query) {
                        $links_left = $guest_link_limit - get_guest_links_count(get_ip());
                        $generated_link = $create_link_query['link'];
                        $share_links = Share::page($generated_link, 'Lill.pw')
                                ->facebook()
                                ->twitter()
                                ->linkedin('Sharing link');
                        $view = view('partials.client.ui.share_links',compact('share_links'))->render();
                        return response()->json([
                                'result' => 'success',
                                'msg' => 'Link generated successfully.',
                                'link' => $create_link_query['link'],
                                'links_left' => $links_left,
                                'share_links' => $view
                            ]);
                    } else {
                        return response()->json([
                            'result' => 'link-fail',
                            'msg' => 'Failed to generate link at this momment. Please try again later.'
                        ]);
                    }
                } else if($create_link_query['result'] == "link-fail") {
                    return response()->json([
                        'result' => 'link-fail',
                        'msg' => 'Failed to generate link at this momment. Please try again later.'
                    ]);
                }
            } else {
                return response()->json(['status' => 'limit-exhausted','msg' => "You've exhausted your limit as a guest user to generate links. Do you want to upgrade the plan?"]);
            }

        }
    }

    public function storeLink(Request $request) {
        if($request->ajax()) {
            $website_url = $request->website_url;
            $slash_tag = $request->slash_tag;
            $sortLink = URL::to('/')."/".$slash_tag;
            $user = Auth::guard('user')->user();
            $link_exist = UserLinks::where('website_url',$website_url)->where('userid',Auth::guard('user')->user()->id)->get();
            $generated_link_exist = UserLinks::where('generated_link',$sortLink)->get();
            if(count($link_exist) > 0) {
                return json_encode(['status' => 'link-exist','msg' =>'Website URL already exist.']);
            } else if(count($generated_link_exist) > 0) {
                return json_encode(['status' => 'bake-half-exist','msg' =>'URL back-half already exist.']);
            } else {
                /*$chunks = explode('/',$slash_tag);
                unset($chunks[0]);
                unset($chunks[1]);
                unset($chunks[2]);*/
                // $code = implode('/',$chunks);

                $userid = Auth::guard('user')->user()->id;
                $user_link = new UserLinks();
                $user_link->userid = $userid;
                $user_link->website_url = $request->website_url ?? "";
                $user_link->generated_link = $sortLink ?? "";
                $user_link->link_title = $request->link_title ?? "";
                $user_link->link_type = $request->link_type ?? "";
                $user_link->link_code = $slash_tag;
                $user_link->link_tags = $request->link_tags ?? "";
                $user_link->ip_address = get_ip();
                $user_link->domain = $request->domain ?? "";
                $user_link->tags = $request->tags ?? "";
                $user_link->qr_code = generate_qr($sortLink);
                $user_link->isGuestLink = 0;
                $user_link->status = 1;
                $user_link->created_at = getDateTime();

                $user_link_limit = get_user_plan($userid)->total_links ?? 0;
                $count_user_links = get_user_links_count($userid);   
                
                if($user_link_limit == 0 || $count_user_links < $user_link_limit) {
                    if($user_link->save()) {
                        if($request->group_id)
                        {
                            $link_maping = new LinkMapping();
                            $link_maping->link_id = $user_link->id;
                            $link_maping->group_id = $request->group_id;
                            $link_maping->created_at = getDateTime();
                            $link_maping->save();
                        }
                        
                        \Notification::send($user, new LinkNotification(UserLinks::findOrFail($user_link->id)));
                        return json_encode(['status' => 'success','msg' =>'URL generated successfully.','link' => $slash_tag]);
                    } else {
                        return json_encode(['status' => 'fail','msg' =>'Failed to generate short URL. Please try again later.']);
                    }
                } else {
                    return json_encode(['status' => 'fail','msg' =>"Failed to generate short URL. You've exhausted your link generate limit."]);
                }
            }
        }
    }

    public function addToFavorite(Request $request) {
        if($request->ajax()) {
            $favorite = new Favorite();
            $favorite->userid = Auth::guard('user')->user()->id;
            $favorite->link_id = $request->link_id;
            $favorite->created_at = getDateTime();

            if(Favorite::where('link_id',$request->link_id)->first()) {
                return response()->json(['status' => 'fail','msg' => 'Link already exist.']);
            } else {
                if(!$favorite->save()) {
                    return response()->json(['status' => 'fail','msg' => 'Failed to add to favorites.']);
                }
            }
            
        }
    }

    public function deleteFavorite(Request $request) {
        if($request->ajax()) {
            $link_id = $request->link_id;
            $favorite_id = $request->favorite_id;
            if(!Favorite::where('id',$favorite_id)->where('link_id',$link_id)->delete()) {
                return response()->json(['status' => 'fail','msg' => 'Failed to remove from favorites. Please try again later.']);
            }
        }
    }

    public function dashboard_link_change_status(Request $request) {
        if($request->ajax()) {
            $user_link = UserLinks::find($request->link_id);
            if($request->action == "hide") {
                $user_link->showOnDashboard = 0;
                if($user_link->save()) {
                    return response()->json(['status' => 'success']);
                } else {
                    return response()->json(['status' => 'fail','msg' => 'Failed to hide your link. Please try again later.']);
                }
            } else if($request->action == "unhide") {
                $user_link->showOnDashboard = 1;
                if($user_link->save()) {
                    return response()->json(['status' => 'success','msg' => 'You can see your link on dashboard.']);
                } else {
                    return response()->json(['status' => 'fail','msg' => 'Failed to un-hide your link. Please try again later.']);
                }
            }
        }
    }

    public function deleteLink(Request $request) {
        if($request->ajax()) {
            if(UserLinks::where('id',$request->link_id)->delete()) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'fail','msg' => 'Failed to delete link. Please try again later.']);
            }
        }
    }

    public function editLink($id) {
        $Link = UserLinks::where('id',$id)->first();
        $LinkType = DB::table('link_types')->where('status',1)->get();
        return view('client_links.edit_link',compact('Link','LinkType'));
    }

    public function updateLink(Request $request) {
        
        if($request->ajax()) {
            $website_url = $request->website_url;
            $slash_tag = $request->slash_tag;
            $link_id = $request->link_id;
            $sortLink = URL::to('/')."/".$slash_tag;
            /*$chunks = explode('/',$slash_tag);
            unset($chunks[0]);
            unset($chunks[1]);
            unset($chunks[2]);*/
            // $code = implode('-',$chunks);

            $user_link = UserLinks::where('userid',Auth::guard('user')->user()->id)->where('id',$link_id)->first();
            $generated_link_exist = UserLinks::where('generated_link',$sortLink)->where('id', '!=', $link_id)->get();
            if(count($generated_link_exist) > 0) {
                return json_encode(['status' => 'bake-half-exist','msg' =>'URL back-half already exist.']);
            }
            $user_link->generated_link = $sortLink ?? "";
            $user_link->link_type = $request->link_type ?? "";
            $user_link->link_tags = $request->link_tags ?? "";
            $user_link->link_code = $slash_tag;
            $user_link->ip_address = get_ip();
            $user_link->qr_code = generate_qr($sortLink);
            $user_link->updated_at = getDateTime();

            if($user_link->save()) {
                return json_encode(['status' => 'success','msg' =>'Link updated successfully.','link' => $slash_tag]);
            } else {
                return json_encode(['status' => 'fail','msg' =>'Failed to update link. Please try again later.']);
            }
        }
    }

    public function sortLink(Request $request) {
        if($request->ajax() && !empty($request->sort_by)) {

            $sort_by = $request->sort_by;
            $userid = Auth::guard('user')->user()->id;
            $result = array();
            $LinksData = UserLinks::leftJoin('user_link_favorites as favourite','user_links.id','=','favourite.link_id')->where('user_links.userid',$userid)->where('user_links.status',1)->where('showOnDashboard',1)->select('user_links.*','favourite.id as favourite_id','favourite.userid as favourite_userid','favourite.link_id as link_id');
            $sort_date = $request->sort_date;

            if(!empty($sort_date)) {
                $dates = explode("-", $sort_date);
                $start_date = str_replace('/','-',date('Y-m-d', strtotime($dates[0])));
                $end_date = str_replace('/','-',date('Y-m-d', strtotime($dates[1])));
                $LinksData->whereBetween('user_links.created_at',[$start_date,$end_date]);
            }

            if($sort_by == "latest") {
                $LinksData->orderBy('user_links.created_at',"desc");
            } else if($sort_by == "asc") {
                $LinksData->orderBy('user_links.link_code',"asc");
            } else if($sort_by == "desc") {
                $LinksData->orderBy('user_links.link_code',"desc");
            } else if($sort_by == "favourite") {
                $LinksData->orderBy('favourite.id',"asc");
            } 

            if(!empty($LinksData->get()) && count($LinksData->get()) > 0) {
                $LinksData = $LinksData->get();
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

    public function shareLink($id) {
        if($id > 0) {
            $Link = UserLinks::where('id',$id)->where('status',1)->first();
            if(!empty($Link)) {
                return view('partials.client.ui.share_popup', compact('Link'));
            } else {
                echo "fail";
            }
        }
    }

    public function downloadQRCode($id) {
        if($id > 0) {
            
            $link = UserLinks::get_link_by_id($id);
            $filename = $link->link_code.".png";
            $qrcode = QrCode::format('png')->size(300)->errorCorrection('H')->generate($link->generated_link, public_path('uploads/qr_codes/'.$filename));
            $filepath = public_path('uploads/qr_codes/').$filename;
            return response()->download($filepath);

        } else {
            return redirect()->back();
        }
    }
}
