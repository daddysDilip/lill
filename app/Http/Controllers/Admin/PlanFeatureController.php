<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PlansFeatures as Features;
use Auth;
use DB;

class PlanFeatureController extends Controller
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
        $subMenu = "manage_plan_features";
        $FeatureData = Features::all();

        //Adding Log Data.
        $moduleId = get_module("manage_plan_features");
        $log = add_log('info','Viewing plan feature details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('plan_features.index',compact('activeMenu','subMenu','FeatureData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPlanFeature()
    {
        $activeMenu = "plans";
        $subMenu = "manage_plan_features";
        $PlanType = DB::table('plans_types')->where('status',1)->get();

        //Adding Log Data.
        $moduleId = get_module("create_plan_feature");
        $log = add_log('info','Viewing plan feature form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('plan_features.create',compact('activeMenu','subMenu','PlanType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePlanFeature(Request $request)
    {
        
        $features_list = array();
        $moduleId = get_module("store_plan_feature");

        if(!empty($request->input('title'))) {
            
            try {
                for($i=0;$i<count($request->input('title'));$i++) {
                
                    $features_list[] = [
                        'plan_type_id' => $request->input('plan_type'),
                        'title' => $request['title'][$i],
                        'short_description' => $request['description'][$i],
                        'feature_type' => $request['feature_type'][$i],
                        'feature_text' => ($request['feature_type'][$i] == "check" ? 'check' : ($request['feature_type'][$i] == "text" ? $request['feature_text'][$i] : "-")),
                        'status' => empty($request['status'][$i]) ? 0 : $request['status'][$i] ,
                        'created_at' => getDateTime()
                    ];
                }

                if(Features::insert($features_list)) {
                    //Adding Log Data.
                    $log = add_log('info','Storing plan feature.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                    return redirect()->route('plan.feature')->with('success','Plans features added successfully.');
                } else {
                    return redirect()->route('plan.feature')->with('error','Failed to add plan features.');
                }
            } catch (Exception $e) {
                //Adding Log Data.
                $log = add_log('error','Failed to store plan feature ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                return redirect()->route('plan.feature')->with('error','Failed to add plan features.');
            }

        } else {
            return redirect()->back()->with('error','Please enter plan feature details.');
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
    public function editPlanFeature($id)
    {
        $activeMenu = "plans";
        $subMenu = "manage_plan_features";
        $PlanType = DB::table('plans_types')->where('status',1)->get();
        $Feature = Features::find($id);
        

        //Adding Log Data.
        $moduleId = get_module("edit_plan_feature");
        $log = add_log('info','Viewing edit plan feature form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('plan_features.create',compact('activeMenu','subMenu','PlanType','Feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePlanFeature(Request $request, $id)
    {
        $validatedData = $request->validate([
            'plan_type' => ['required','string'],
            'title' => ['required','string'],
            'feature_type' => ['required'],
            'feature_text' => ['string']
        ]);

        //Adding Log Data.
        $moduleId = get_module("update_plan_feature");

        try {
            $features = Features::find($id);
            $features->plan_type_id = $request->input('plan_type');
            $features->title = $request->input('title');
            $features->short_description = $request->input('description');
            $features->feature_type = $request->input('feature_type');
            if($request->input('feature_type') == "text")
            {
                $features->feature_text = $request->input('feature_text');
            } else {
                if($request->input('feature_type') == "check")
                {
                    $features->feature_text = "check";
                } else {
                    $features->feature_text = "-";
                }
            }
            // $features->feature_text = ($request->input('feature_type') == "text" ? $request->input('feature_text') : ($request->input('feature_type') == "check") ? "check" : "-");
            $features->status = empty($request->input('status')) ? 0 : $request->input('status');
            $features->updated_at = getDateTime();

            if($features->save()) {
                $log = add_log('info','Plan feature updated successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                return redirect()->route('plan.feature')->with('success','Plans features updated successfully.');
            } else {
                return redirect()->route('plan.feature')->with('error','Failed to update plan features.');
            }
        } catch (Exception $e) {
            $log = add_log('error','Failed to update plan feature ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('plan.feature')->with('error','Failed to update plan features.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePlanFeature($id)
    {
        try {
            //Adding Log Data.
            $moduleId = get_module("delete_plan_feature");

            $feature = Features::find($id)->delete();
            if($feature) {
                $log = add_log('info','Plan feature deleted successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                return redirect()->route('plan.feature')->with('success','Feature item deleted successfully.');
            } else {
                return redirect()->route('plan.feature')->with('error','Failed to feature item.');
            }
        } catch (Excpetion $e) {
            $log = add_log('error','Failed to delete plan feature ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('plan.feature')->with('error','Failed to feature item.');
        }
    }
}
