<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use Socialite;
use Auth;
use Exception;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

class GoogleLoginController extends Controller{
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle(){
        session(['saved_url' => url('auth/google/callback')]);
        config(['services.google.redirect' => url('auth/google/callback')]);

        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(){
        $saved_url = session('saved_url');
        config(['services.google.redirect' => $saved_url]);
        
        try {
            $google_user = Socialite::driver('google')->stateless()->user();

            if($user = User::where('google_id', $google_user->id)->first()){
                $user->google_token = $google_user->token;
                $user->save();
            }else{
                $user = new User;
                $user->fullname = $google_user->name;
                $user->email = $google_user->email;
                $user->google_id = $google_user->id;
                $user->google_token = $google_user->token;
                $user->username = $google_user->email;
                $user->password = Hash::make($google_user->id);
            
                $user->save();
            }

            Auth::login($user);
            return redirect('dashboard');

        } catch (Exception $e) {
            return $e->getMessage();
            // return redirect('auth/google');
        }
    }
}