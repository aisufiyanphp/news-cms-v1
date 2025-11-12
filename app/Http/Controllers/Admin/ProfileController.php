<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class ProfileController extends Controller
{
    public function profile(){
        $adminId = Session::get('ADMIN_ID');        
        $admin = Admin::where('id', $adminId)->get();             
        return view('admin.profile.profile', compact('admin'));
    }

    public function changePassword(){
        return view('admin.change_password');
    }
}
