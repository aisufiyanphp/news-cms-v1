<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(){
        return view('admin.category');
    }

    public function addCategory(){
        return view('admin.add_category');
    }

    public function editCategory(){
        return view('admin.edit_category');
    }
    
    //Sub Category
    public function subCategory(){
        return view('admin.sub_category');
    }

    public function addSubCategory(){
        return view('admin.add_sub_category');
    }

    public function editSubCategory(){
        return view('admin.edit_sub_category');
    }
}
