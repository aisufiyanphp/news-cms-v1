<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\News;


class NewsController extends Controller
{
    public function news(){
        $newsList = News::orderBy('id', 'desc')->get();
        return view('admin.news.news', compact('newsList'));
    }

    public function addNews(){
        $categoris = Category::getCategory();                                        
        return view('admin.news.add_news', compact('categoris'));
    }

    public function submitAddNews(Request $request){        
        
        $validator = Validator::make($request->all(), [
            "title" => "required|min:3|max:80|unique:news,title",
            "category" => "required|integer|exists:categories,id",
            "sub_category" => "required|integer|exists:sub_categories,id",
            "publishDate" => "required|date",
            "publishTime" => "required",            
            "description" => "required",
            "publishEndDate" => "nullable|date",
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255'
        ])->stopOnFirstFailure();            
        if($validator->fails()){            
            $result = ["status" => false, "msg"=> $validator->errors()->first()];
            return response()->json($result);
        }

        try{
           
           $news = News::create([
               "title" => $request->input("title"),
               "category_id" => $request->input("category"),
               "sub_category_id" => $request->input("sub_category"),
               "publish_date" => $request->input("publishDate"),
               "publish_time" => $request->input("publishTime"),
               "status" => $request->input("status"),
               "publish_end_date" => $request->input("publishEndDate"),
               "thumbnail" => $request->input("thumbnail"),
               "description" => $request->input("title"),
               "meta_title" => $request->input("meta_title"),
               "meta_keywords" => $request->input("meta_keyword"),
               "meta_description" => $request->input("description"),               
           ]);
           $result = ["status" => true, "msg"=> "News Artical Successfully added"];
           return response()->json($result);

        }catch(\Exception $e){
            $result = ["status" => false, "msg"=> $e->getMessage()];
            return response()->json($result);
        }
        
    }

    public function editNews($id){
        $categoris = Category::getCategory();
        return view()                                        
    }
}
