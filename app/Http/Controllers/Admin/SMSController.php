<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SmsTemplates as SMS;
use Auth;

class SMSController extends Controller
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
        $activeMenu = "settings";
        $subMenu = "manage_sms_templates";
        $TemplateData = SMS::all();

        //Adding Log Data.
        $moduleId = get_module("manage_sms_template");
        $log = add_log('info','Viewing sms template details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('sms_templates.index',compact('activeMenu','subMenu','TemplateData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSMSTemplate()
    {
        $activeMenu = "settings";
        $subMenu = "manage_sms_templates";

        //Adding Log Data.
        $moduleId = get_module("create_sms_template");
        $log = add_log('info','Viewing sms template details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('sms_templates.create',compact('activeMenu','subMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSMSTemplate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required','string'],
            'label' => ['required','string'],
            'content' => ['required','string']
        ]);

        $moduleId = get_module("store_sms_template");

        try {

            if(SMS::where(['title'=>$request->input('title'),'label'=>$request->input('label')])->first()) {
                return redirect()->route('sms.templates')->with('error','SMS template already exists.');
            } else {
                $template = new SMS();
                $template->title = $request->input('title');
                $template->label = $request->input('label');
                $template->content = $request->input('content');
                $template->status = empty($request->input('status')) ? 0 : $request->input('status');
                $template->created_at = getDateTime();

                if($template->save()) {
                    //Adding Log Data.
                    $log = add_log('info','Viewing sms template details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                    return redirect()->route('sms.templates')->with('success','SMS template added successfully.');
                } else {
                    return redirect()->route('sms.templates')->with('error','Failed to add SMS template.');
                }
            }
        } catch (Exception $e) {
            //Adding Log Data.
            $log = add_log('info','Failed to store sms template ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('sms.templates')->with('error','Failed to add SMS template.');
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
    public function editSMSTemplate($id)
    {
        $activeMenu = "settings";
        $subMenu = "manage_sms_templates";
        $Template = SMS::find($id);

        //Adding Log Data.
        $moduleId = get_module("edit_sms_template");
        $log = add_log('info','Viewing edit sms template details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('sms_templates.create',compact('activeMenu','subMenu','Template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSMSTemplate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => ['required','string'],
            'label' => ['required','string'],
            'content' => ['required','string']
        ]);

        $moduleId = get_module("update_sms_template");

        try {
            $template = SMS::find($id);
            $template->title = $request->input('title');
            $template->label = $request->input('label');
            $template->content = $request->input('content');
            $template->status = empty($request->input('status')) ? 0 : $request->input('status');
            $template->updated_at = getDateTime();

            if($template->save()) {
                //Adding Log Data.
                $log = add_log('info','SMS template update successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                return redirect()->route('sms.templates')->with('success','SMS template updated successfully.');
            } else {
                return redirect()->route('sms.templates')->with('error','Failed to update SMS template.');
            }
        } catch (Exception $e) {
            //Adding Log Data.
            $log = add_log('error','Failed to update sms template ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('sms.templates')->with('error','Failed to update SMS template.');
        }
    }

    public function changeTemplateStatus(Request $request) {
        $templateid = $request->templateid;
        $status = ($request->status == 1 ? 0 : 1);
        if(!empty($templateid)) {
            $sms = SMS::where('id',$templateid)
                                ->update(['status' => $status]);

            if($sms) {
                echo "success";
            } else {
                echo "fail";
            }

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
