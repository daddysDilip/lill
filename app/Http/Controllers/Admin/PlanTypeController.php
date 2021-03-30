<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PlansType;
use Auth;

class PlanTypeController extends Controller
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
        $subMenu = "manage_plan_types";
        $TypeData = PlansType::all();

        //Adding Log Data.
        $moduleId = get_module("manage_plan_type");
        $log = add_log('info','Viewing plan type details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('plan_type.index',compact('activeMenu','subMenu','TypeData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPlanType()
    {
        $activeMenu = "plans";
        $subMenu = "manage_plan_types";

        //Adding Log Data.
        $moduleId = get_module("create_plan_type");
        $log = add_log('info','Viewing plan type form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('plan_type.create',compact('activeMenu','subMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePlanType(Request $request)
    {
        $validatedData = $request->validate([
            'plan_type' => ['required','string']
        ]);

        $moduleId = get_module("create_plan_type");
            
        try {
            if(PlansType::where(['plan_type'=>$request->input('plan_type')])->first()) {
                return redirect()->route('plans.types')->with('error','Plan type already exists.');
            } else {
                $type = new PlansType();
                $type->plan_type = $request->input('plan_type');
                $type->status = empty($request->input('status')) ? 0 : $request->input('status');
                $type->created_at = getDateTime();

                if($type->save()) {
                    //Adding Log Data.
                    $log = add_log('info','Plan type stored successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                    return redirect()->route('plans.types')->with('success','Plan type added successfully.');
                } else {
                    return redirect()->route('plans.types')->with('error','Failed to add plan type.');
                }
            }
        } catch (Exception $e) {
            //Adding Log Data.
            $log = add_log('error','Failed to store plan type ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('plans.types')->with('error','Failed to add plan type.');
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
    public function editPlanType($id)
    {
        $activeMenu = "plans";
        $subMenu = "manage_plan_types";
        $PlanType = PlansType::find($id);

        //Adding Log Data.
        $moduleId = get_module("edit_plan_type");
        $log = add_log('info','Viewing edit plan type form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('plan_type.create',compact('activeMenu','subMenu','PlanType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePlanType(Request $request, $id)
    {
        $validatedData = $request->validate([
            'plan_type' => ['required','string']
        ]);

        $moduleId = get_module("update_plan_type");

        try {
            $type = PlansType::find($id);
            $type->plan_type = $request->input('plan_type');
            $type->status = empty($request->input('status')) ? 0 : $request->input('status');
            $type->created_at = getDateTime();

            if($type->save()) {
                $log = add_log('info','Plan type udpated successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                return redirect()->route('plans.types')->with('success','Plan type updated successfully.');
            } else {
                return redirect()->route('plans.types')->with('error','Failed to update plan type.');
            }
        } catch (Exception $e) {
            $log = add_log('error','Failed to add plan type ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('plans.types')->with('error','Failed to update plan type.');
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
}
