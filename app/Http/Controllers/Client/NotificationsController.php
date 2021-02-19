<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class NotificationsController extends Controller
{
    public function getUnreadNotification() {
        $user = Auth::guard('user')->user();
        try {
            $notification = Auth::guard('user')->user()->notifications()->orderBy('created_at','DESC')->take(5)->get();
            if(!empty($notification) && count($notification) > 0) {
                $notification_type = "new-link";
                $view = view('tools.site_notification',compact('notification','notification_type'))->render();
                return response()->json(['status' => '200','result' => $view]);
            } else {
                $view = view('tools.site_notification',compact('notification'))->render();
                return response()->json(['status' => '204','result' => $view]);
            }
        } catch (Exception $e) {
            $view = view('tools.site_notification')->render();
            return response()->json(['status' => '204','result' => $view]);
        }
    }

    public function markAsReadNotification() {
        $user = Auth::guard('user')->user();
        $notification = $user->unreadNotifications;
        if(!empty($notification)) {
            foreach($notification as $noti) {
                $noti->markAsRead();
            }
            return response()->json(['status' => 200]);
        }
    }
}
