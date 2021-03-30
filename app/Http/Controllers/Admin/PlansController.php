<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plans;
use App\PlansFeatureMapping;
use DB;
use Auth;

class PlansController extends Controller
{
    public function __construct()
    {
        if(Auth::guard('admin')->user() == null) {
            return Redirect::to('shortly-admin')->send();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeMenu = "plans";
        $subMenu = "manage_plans";
        $PlansData = Plans::leftJoin('plans_types','plans.plan_type_id','=','plans_types.id')
                            ->select('plans.*','plans_types.id as plan_type_id','plans_types.plan_type as plan_type')
                            ->get();

        //Adding Log Data.
        $moduleId = get_module("manage_plans");
        $log = add_log('info','Viewing plans details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('plans.index',compact('activeMenu','subMenu','PlansData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPlan()
    {
        $activeMenu = "plans";
        $subMenu = "manage_plans";
        $PlanType = DB::table('plans_types')->where('status',1)->get();

        //Adding Log Data.
        $moduleId = get_module("create_plan");
        $log = add_log('info','Viewing create plan form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('plans.create',compact('activeMenu','subMenu','PlanType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePlan(Request $request)
    {
        $plan = new Plans();
        $plan->plan_type_id = $request->input('plan_type');
        $plan->name = $request->input('plan_name');
        $plan->isFree = (!empty($request->input('isFree') || $request->input('isFree') == 1) ? 1 : 0);
        $plan->annual_price = $request->input('annual_price');
        $plan->monthly_price = $request->input('monthly_price');
        $plan->tax = $request->input('tax');
        $plan->discount = $request->input('discount');
        $plan->total_links = $request->input('total_links');
        $plan->total_branded_links = $request->input('total_branded_links');
        $plan->total_users = $request->input('total_users');
        $plan->total_custom_domains = $request->input('total_custom_domains');
        $plan->total_link_click = $request->input('total_link_click');
        $plan->link_track = (!empty($request->input('link_track') || $request->input('link_track') == 1) ? 1 : 0);
        $plan->link_filtering = (!empty($request->input('link_filtering') || $request->input('link_filtering') == 1) ? 1 : 0);
        $plan->custom_back_half = (!empty($request->input('custom_back_half') || $request->input('custom_back_half') == 1) ? 1 : 0);
        $plan->link_analytics = (!empty($request->input('link_analytics') || $request->input('link_analytics') == 1) ? 1 : 0);
        $plan->link_history = (!empty($request->input('link_history') || $request->input('link_history') == 1) ? 1 : 0);
        $plan->social_media_shering = (!empty($request->input('social_media_shering') || $request->input('social_media_shering') == 1) ? 1 : 0);
        $plan->is_qrcode = (!empty($request->input('is_qrcode') || $request->input('is_qrcode') == 1) ? 1 : 0);
        $plan->status = (!empty($request->input('status') || $request->input('status') == 1) ? 1 : 0);
        $plan->created_at = getDateTime();

        $moduleId = get_module("store_plan");

        try {
            if($plan->save()) {
                $plan_id = $plan->id;
                // if(!empty($request->input('features_list'))) {
                //     foreach(explode(',',$request->input('features_list')) as $value) {
                //         $features_list[] = [
                //             'plan_id' => $plan_id,
                //             'feature_id' => $value,
                //             'status' => 1,
                //             'created_at' => getDateTime()
                //         ];
                //     }
                // }
                // if(!PlansFeatureMapping::insert($features_list)) {
                //     //Adding Log Data.
                //     $log = add_log('error','Failed to add features.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());    
                // }

                //Adding Log Data.
                $log = add_log('info','Plan added successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

                return redirect()->route('plans')->with('success','Plan added successfully.');
                
            } else {
                return redirect()->route('plans')->with('error','Failed to add plan. Please check log for the same.');
            }
        } catch (Exception $e) {
            return redirect()->route('plans')->with('error','Failed to add plan. Please check log for the same.');
                
            //Adding Log Data.
            $log = add_log('info','Failed to store plan -> '.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPlan($id)
    {
        $activeMenu = "plans";
        $subMenu = "manage_plans";
        $PlanType = DB::table('plans_types')->where('status',1)->get();
        $Plan = Plans::find($id);
        // $PlanFeature = DB::table('plans_feature_mappings as map')
        //                 ->leftJoin('plans','map.plan_id','=','plans.id')
        //                 ->leftJoin('plans_features','map.feature_id','=','plans_features.id')
        //                 ->select('map.*','plans.id as plan_id','plans.name as plan_name','plans_features.id as feature_id','plans_features.title as feature_title')
        //                 ->where('map.plan_id',$id)->where('map.status',1)->get();
        // $AllFeatures = DB::table('plans_features')->where('status',1)->get();

        //Adding Log Data.
        $moduleId = get_module("edit_plan");
        $log = add_log('info','Viewing create plan form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('plans.create',compact('activeMenu','subMenu','PlanType','Plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePlan(Request $request, $id)
    {
        $plan = Plans::find($id);
        $features_list = $request->input('features_list');
        $plan->plan_type_id = $request->input('plan_type');
        $plan->name = $request->input('plan_name');
        $plan->isFree = (!empty($request->input('isFree') || $request->input('isFree') == 1) ? 1 : 0);
        $plan->annual_price = $request->input('annual_price');
        $plan->monthly_price = $request->input('monthly_price');
        $plan->tax = $request->input('tax');
        $plan->discount = $request->input('discount');
        $plan->total_links = $request->input('total_links');
        $plan->total_branded_links = $request->input('total_branded_links');
        $plan->total_users = $request->input('total_users');
        $plan->total_custom_domains = $request->input('total_custom_domains');
        $plan->total_link_click = $request->input('total_link_click');
        $plan->link_track = (!empty($request->input('link_track') || $request->input('link_track') == 1) ? 1 : 0);
        $plan->link_filtering = (!empty($request->input('link_filtering') || $request->input('link_filtering') == 1) ? 1 : 0);
        $plan->custom_back_half = (!empty($request->input('custom_back_half') || $request->input('custom_back_half') == 1) ? 1 : 0);
        $plan->link_analytics = (!empty($request->input('link_analytics') || $request->input('link_analytics') == 1) ? 1 : 0);
        $plan->link_history = (!empty($request->input('link_history') || $request->input('link_history') == 1) ? 1 : 0);
        $plan->social_media_shering = (!empty($request->input('social_media_shering') || $request->input('social_media_shering') == 1) ? 1 : 0);
        $plan->status = (!empty($request->input('status') || $request->input('status') == 1) ? 1 : 0);
        $plan->is_qrcode = (!empty($request->input('is_qrcode') || $request->input('is_qrcode') == 1) ? 1 : 0);
        $plan->created_at = getDateTime();

        $moduleId = get_module("update_plan");

        try {
            
            if($plan->save()) {
                // if(!empty($request->input('features_list'))) {
                //     if(is_array($request->features_list)) {
                //         foreach(explode(',',$request->input('features_list')) as $value) {
                //             $features_list[] = [
                //                 'plan_id' => $id,
                //                 'feature_id' => $value,
                //                 'status' => 1,
                //                 'created_at' => getDateTime()
                //             ];
                //         }
                //     } else {
                //         foreach($request->input('feature_id') as $value) {
                //             $feature_list[] = array(
                //                 'plan_id' => $id,
                //                 'feature_id' => $value,
                //                 'status' => 1,
                //                 'created_at' => getDateTime()
                //             );
                //         }
                //     }
                // }

                // if(!PlansFeatureMapping::insert($feature_list)) {
                //     //Adding Log Data.
                //     $log = add_log('error','Failed to add features.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());    
                // }
                //Adding Log Data.
                $log = add_log('info','Plan updated successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

                return redirect()->route('plans')->with('success','Plan updated successfully.');
                
            } else {
                echo "fail";
                
                //Adding Log Data.
                return redirect()->route('plans')->with('error','Failed to update plan. Please check log for the same.');
            }
        } catch (Exception $e) {
            return redirect()->route('plans')->with('error','Failed to update plan. Please check log for the same.');
                
            //Adding Log Data.
            $log = add_log('info','Failed to update plan -> '.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function destroyPlanFeature(Request $request) {
        $map_id = $request->input('map_id');
        $feature_id = $request->input('feature_id');

        try {
            if($request->ajax() && !empty($map_id) && !empty($feature_id)) {
                $query = DB::table('plans_feature_mappings')->where('id',$map_id)->where('feature_id',$feature_id)->delete();

                if($query) {
                    echo "success";
                } else {
                    echo "fail";
                }
            }
        } catch (Exception $e) {
            //Adding Log Data.
            $moduleId = get_module("delete_plan_feature");
            $log = add_log('info','Failed to delete plan feature ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
        }
    }

    public function changePlanStatus(Request $request) {
        $planid = $request->planid;
        $status = ($request->status == 1 ? 0 : 1);
        if(!empty($planid)) {
            $plan = Plans::where('id',$planid)
                                ->update(['status' => $status]);

            if($plan) {
                echo "success";
            } else {
                echo "fail";
            }

        }
    }

    public function fetchPlansFeature(Request $request) {
        $type_id = $request->input('plan_type');
        if(!empty($type_id) && $request->ajax()) {
            $data = DB::table('plans_features')->select('plans_features.*',DB::raw('group_concat(plans_features.title) as feature_title'))->where('plan_type_id',$type_id)->groupBy('id')->get();
        } else {
            $data = [];
        }
        echo json_encode($data);
    }
}
