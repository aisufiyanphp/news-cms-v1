<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\News;

class DashboardController extends Controller
{
    public function dashboard(){        
        $data['count_category'] = CategoryModel::count();
        $data['count_sub_category'] = SubCategoryModel::count();
        $data['count_news'] = News::count();        
        return view('admin.dashboard', compact('data'));
    }

    public function uploadThumbnail(Request $request){
        if($request->hasFile('upload')){
                
            $uploadDir = public_path('image');
            $file = $request->file('upload');  
            $ext  = $file->extension();
            $filename = uniqid(time()).".".$ext;
            $file->move($uploadDir, $filename);            
            return response()->json(['uploaded'=>1, 'url'=>asset('image').'/'.$filename]);
        }else{
            return response()->json(['uploaded'=>0, 'url'=>'http://127.0.0.1:8000/Error']);
        } 
        
    }
}
