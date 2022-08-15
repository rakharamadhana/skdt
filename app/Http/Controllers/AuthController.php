<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Models\User;

use Auth;
use Validator;

class AuthController extends Controller{
    public function indexSignIn(){
        if(Auth::check()){
            return redirect('dashboard');
        }else{
            return view('sign-in');
        }
    }

    public function indexDashboard(){
        return view('dashboard');
    }

    public function indexWelcome(){
        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome']
        );

        return view('pages/welcome', compact('breadcrumb'));
    }

    public function actionSignIn(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required:username',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        if ($user = User::where(['username' => $request->username])->first()) {

            if(env('APP_ENV', '') == 'production'){
                if(strpos(url('/'), 'siap') !== false){ // SIAP
                    if(!in_array($user->user_status, [10, 11, 12])){
                        return error_response('Anda tidak memiliki izin untuk masuk');
                    }
                } else if(strpos(url('/'), 'kpit') !== false){ // KPIT
                    if(!in_array($user->user_status, [1])){
                        return error_response('Anda tidak memiliki izin untuk masuk');
                    }
                } else { // SKDT
                    if(!in_array($user->user_status, [100, 101, 102, 103, 104, 105])){
                        return error_response('Anda tidak memiliki izin untuk masuk');
                    }
                }
            }

            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return success_response('Login Berhasil');
            }else{
                return error_response('Password Anda salah');
            }
        }else{
            return error_response('Akun anda tidak ditemukan');
        }
    }

    public function actionChangePassword(Request $request){
        if($request->new_password == $request->new_confirm_password){
            $user = auth_data();
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();

                return success_response('Sukses mengganti password');
            }else{
                return error_response('Password lama Anda salah');
            }
        }else{
            return error_response('Ketikkan lagi password baru Anda');
        }
    }

    public function actionSignOut(Request $request){
        Auth::logout();
        return redirect('/');
    }
}