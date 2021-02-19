<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\User;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

            echo "<pre>";
            print_r($user->user['given_name']);


     
            $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
     
                //Auth::login($finduser);
    
                //return redirect('/home');
     
            }else{
                // $newUser = User::create([
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'google_id'=> $user->id,
                //     'password' => encrypt('123456dummy')
                // ]);
    
                // Auth::login($newUser);
     
                // return redirect('/home');
            }
    }
}
