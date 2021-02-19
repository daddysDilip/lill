<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmailTemplates as Email;
use Auth;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeMenu = "settings";
        $subMenu = "manage_email_templates";
        $TemplateData = Email::all();

        //Adding Log Data.
        $moduleId = get_module("manage_email_template");
        $log = add_log('info','Viewing edit sms template details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('email_templates.index',compact('activeMenu','subMenu','TemplateData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEmailTemplate()
    {
        $activeMenu = "settings";
        $subMenu = "manage_email_templates";

        //Adding Log Data.
        $moduleId = get_module("create_email_template");
        $log = add_log('info','Viewing create email template form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('email_templates.create',compact('activeMenu','subMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEmailTemplate(Request $request)
    {
        $validatedData = $request->validate([
            'type' => ['required','string'],
            'title' => ['required','string'],
            'from' => ['required','string'],
            'fromEmail' => ['required','string'],
            'subject' => ['required','string'],
            'label' => ['required','string'],
            'content' => ['required','string']
        ]);

        $moduleId = get_module("store_email_template");

        try {
            if(Email::where(['type'=>$request->input('type'),'label'=>$request->input('label')])->first()) {
                return redirect()->route('email.templates')->with('error','Email template already exists.');
            } else {
                $template = new Email();
                $template->type = $request->input('type');
                $template->title = $request->input('title');
                $template->from = $request->input('from');
                $template->fromEmail = $request->input('fromEmail');
                $template->subject = $request->input('subject');
                $template->label = $request->input('label');
                $template->content = $request->input('content');
                $template->status = empty($request->input('status')) ? 0 : $request->input('status');
                $template->created_at = getDateTime();

                if($template->save()) {
                    //Adding Log Data.
                    $log = add_log('info','Email template stored successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                    return redirect()->route('email.templates')->with('success','Email template added successfully.');
                } else {
                    return redirect()->route('email.templates')->with('error','Failed to add email template.');
                }
            }
        } catch (Exception $e) {
            //Adding Log Data.
            $log = add_log('error','Failed to store email template ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('email.templates')->with('error','Failed to add email template.');
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
    public function editEmailTemplate($id)
    {
        $activeMenu = "settings";
        $subMenu = "manage_email_templates";
        $Template = Email::find($id);

        //Adding Log Data.
        $moduleId = get_module("edit_email_template");
        $log = add_log('info','Viewing edit email template form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('email_templates.create',compact('activeMenu','subMenu','Template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEmailTemplate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => ['required','string'],
            'title' => ['required','string'],
            'from' => ['required','string'],
            'fromEmail' => ['required','string'],
            'subject' => ['required','string'],
            'label' => ['required','string'],
            'content' => ['required','string']
        ]);

        $moduleId = get_module("create_email_template");

        try {
            $template = Email::find($id);
            $template->type = $request->input('type');
            $template->title = $request->input('title');
            $template->from = $request->input('from');
            $template->fromEmail = $request->input('fromEmail');
            $template->subject = $request->input('subject');
            $template->label = $request->input('label');
            $template->content = $request->input('content');
            $template->status = empty($request->input('status')) ? 0 : $request->input('status');
            $template->created_at = getDateTime();

            if($template->save()) {
                //Adding Log Data.
                $log = add_log('info','Email template updated successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

                return redirect()->route('email.templates')->with('success','Email template updated successfully.');
            } else {
                return redirect()->route('email.templates')->with('error','Failed to update email template.');
            }
        } catch (Exception $e) {
            //Adding Log Data.
            $log = add_log('error','Email template updated successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('email.templates')->with('error','Failed to update email template.');
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
