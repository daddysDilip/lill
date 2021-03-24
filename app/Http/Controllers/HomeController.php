<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LinkType;
use Auth;
use Mail;
use App\FAQ;
use App\EmailTemplates;
use App\UserEnquiry;
use App\Plans;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $LinkType = LinkType::getLinkTypes();
        return view('welcome',compact('LinkType'));
    }
    
    public function showPricing() {
        $Plans = Plans::orderBy('id','ASC')->get();
        // dd($Plans->toArray());
        return view('pricing',compact('Plans'));
    }
    public function showPricingDetail($id) {
        $Plans = Plans::where('id',$id)->get();
        // dd($Plans->toArray());
        return view('pricing_detail',compact('Plans'));
    }
    public function showFAQ() {
        $FAQ = FAQ::getActiveFAQ();
        return view('faq',compact('FAQ'));
    }

    public function showAbout() {
        return view('about');
    }
    public function showPrivacyPolicy() {
        return view('privacypolicy');
    }
    public function showTermsandconditions() {
        return view('termsandconditions');
    }
    public function showCookiePolicy() {
        return view('cookiepolicy');
    }

    public function showUserLogin() {
        if(Auth::guard('user')->user() != null)
        {
            return redirect('/user-dashboard');
        }
        return view('auth.client_login');
    }

    public function showAdminLoginForm() {
        if(Auth::guard('admin')->user() != null){
            return redirect('/admin-dashboard');
        }
        return view('auth.login');
    }

    public function sendQuotation(Request $request) {
        if($request->ajax()) {
            
            $fullname = $request->fullname;
            $email = $request->email;
            $phone_number = $request->phone_number;
            $message = $request->message;

            $emailtemplate =  EmailTemplates::where('label','get-quote')->first();

            $find =  array('#fullname#','#email#','#phone_number#','#message#');
            $replace = array($fullname,$email,$phone_number);
            
            $subject = $emailtemplate->subject;
            $content = str_replace($find,$replace,$emailtemplate->content);
        
            $to = $emailtemplate->fromEmail;

            $storeEnquiry = array(
                'fullname' => $fullname ?? null,
                'email' => $email ?? null,
                'phone_number' => $phone_number ?? null,
                'message' => $message ?? null,
                'created_at' => getDateTime() ?? null
            );
            
            UserEnquiry::addEnquiry($storeEnquiry);

            Mail::send('email',compact('content'), function ($message) use ($emailtemplate,$to){
                $message->from($emailtemplate->fromEmail, $emailtemplate->from);
                $message->to($to);
                $message->subject($emailtemplate->subject);
            });

            if (Mail::failures()) 
            {
                $failures[] = Mail::failures()[0];
                return response()->json(['status' => 'fail','msg' => 'Failed to send your quotation. Please try again later.']);
            }

            return response()->json(['status' => 'success','msg' => 'Your inquiry has been sent successfully.']);

        }
    }
}
