<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class AuthController extends Controller
{
    public function loginForm(){
        return view('admin.login');
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->stopOnFirstFailure();

        if($validator->fails()){
            $error = $validator->errors()->first();
            return redirect(route('admin.login'))
                ->withErrors($error)
                ->withInput();
        }

        $admin = Admin::where('email', $request->input('email'))->first();
        if($admin){
            if(Hash::check($request->input('password'), $admin->password)){
                Session::put('ADMIN_LOGIN', true);
                Session::put('ADMIN_ID', $admin->id);
                Session::put('ADMIN_NAME', $admin->name);
                return redirect()->route('admin.dashboard');
            }else{
                return redirect(route('admin.login'))
                  ->withErrors('Invalid Credentials! Please confirm email & password.')->withInput();    
            }
        }else{
            return redirect(route('admin.login'))
                ->withErrors('Invalid Credentials! Please confirm email & password.')->withInput();
        }
               
    }

    public function logout(){
        Session::flush();
        return redirect()->route('admin.login');
    }

    public function forgetPasswordForm(){
        return view('admin.forget-password');
    }
}
