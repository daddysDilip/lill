<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserEnquiry;
use Auth;
use App\EmailTemplates;
use Mail;

class ReportsController extends Controller
{
    public function __construct()
    {
        if(Auth::guard('admin')->user() == null) {
            return Redirect::to('shortly-admin')->send();
        }
    }
    public function showCustomerEnquiry() {
        $activeMenu = "reports";
        $subMenu = "manage_customer_enquiry";
        $UserEnquiry = UserEnquiry::leftJoin('users','user_enquiry.repliedBy','=','users.id')
                        ->orderBy('user_enquiry.created_at','DESC')
                        ->select('users.id as repliedBy','users.firstname as firstname','users.lastname as lastname','user_enquiry.*')
                        ->get();

        //Adding Log Data.
        $moduleId = get_module("manage_customer_enquiry");
        $log = !empty($moduleId) ? add_log('info','View customer enquiry detail.',$moduleId,Auth::guard('admin')->user()->id,getDateTime()) : '';

        return view('reports.customer_enquiry',compact('activeMenu','subMenu','UserEnquiry'));
    }

    public function replyCustomerEnquiry(Request $request) {
        $userid = Auth::guard('admin')->user()->id;
        $email = $request->email;
        $msg = $request->message;

        $Reply = array(
            'reply_message' => $msg,
            'repliedBy' => $userid,
            'isReplied' => 1,
            'replied_date' => getDateTime()
        );

        $enquiry = UserEnquiry::updateEnquiry($request->enquiry_id,$Reply);

        $emailtemplate =  EmailTemplates::where('label','enquiry-reply')->first();

        $find =  array('#message#');
        $replace = array($msg);
        
        $subject = $emailtemplate->subject;
        $content = str_replace($find,$replace,$emailtemplate->content);
       
        $to = $email;
        
        try {
            Mail::send('email',compact('content'), function ($message) use ($emailtemplate,$to){
                $message->from($emailtemplate->fromEmail, $emailtemplate->from);
                $message->to($to);
                $message->subject($emailtemplate->subject);
            });
            return redirect()->back()->with('success','Enquiry replied successfully.');
        } catch (Exception $e) {
            //Adding Log Data.
            $moduleId = get_module("reply_customer_enquiry");
            $log = !empty($moduleId) ? add_log('info','Failed to reply customer enquiry ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime()) : '';
            return redirect()->back()->with('error','Failed to reply customer enquiry. Please try again later.');
        }

    }
}
