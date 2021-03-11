<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty(Auth::guard('admin')->user())){
            $status = Auth::guard('user')->user()->status;
            $roleid = Auth::guard('user')->user()->roleid;
            if($roleid != 0 && $status == '0'){
                Session::flush();
                Auth::logout();
                return redirect('/');
            }
        }
        

        return $next($request);
    }
}
