<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class DashboardController extends Controller
{
    public function dashboard(){
        $data['category'] = Category::count();
        $data['sub_category'] = SubCategory::count();        
        return view('admin.dashboard', compact('data'));
    }

    public function settings(){
        return view('admin.setting');
    }
}
