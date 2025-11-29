<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\News;


class NewsController extends Controller
{
    public function news(){
        $newsList = News::orderBy('id', 'desc')->get();
        return view('admin.news.news', compact('newsList'));
    }

    public function addNews(){
        $categoris = CategoryModel::getCategory();                                        
        return view('admin.news.add_news', compact('categoris'));
    }

    public function getNews(Request $request){
        $draw = $request->input('draw');
        $start = $request->input('start');    // offset
        $length = $request->input('length');  // limit
        $searchValue = $request->input('search.value');

        $query = News::with(['category:id,category_title', 'subCategory:id,title']);

        if(!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->where('title', 'like', "%$searchValue%");
            });
        }

        $recordsTotal = News::count();
        $recordsFiltered = $query->count();

        // Pagination
        $news = $query->skip($start)->take($length)->get();

        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $news
        ]); 
    }

    public function submitAddNews(Request $request){                        

        $validator = Validator::make($request->all(), [
            "title" => "required|min:3|max:80|unique:news,title",
            "category" => "required|integer|exists:categories,id",
            "sub_category" => "required|integer|exists:sub_categories,id",
            "publishDate" => "required|date",
            "publishTime" => "required",
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',            
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

            if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()){
                
                $uploadDir = public_path('image/news-img');
                // $file = $request->file('thumbnail');  
                // $ext  = $file->extension();
                // $filename = uniqid(time()).".".$ext;
                // $file->move($uploadDir, $filename);
                $filename = fileUploads($request->file('thumbnail'), $uploadDir);
            }else{
                $filename = NULL;
            }

            $news = News::create([
               "title" => $request->input("title"),
               "category_id" => $request->input("category"),
               "sub_category_id" => $request->input("sub_category"),
               "publish_date" => $request->input("publishDate"),
               "publish_time" => $request->input("publishTime"),
               "status" => $request->input("status"),
               "publish_end_date" => $request->input("publishEndDate"),               
               "thumbnail" => $filename,               
               "meta_title" => $request->input("meta_title"),
               "meta_keywords" => $request->input("meta_keyword"),
               "meta_description" => $request->input("meta_description"),               
               "description" => $request->input("description"),
            ]);
            $result = ["status" => true, "msg"=> "News Artical Successfully added"];
            return response()->json($result);

        }catch(\Exception $e){
            $result = ["status" => false, "msg"=> $e->getMessage()];
            return response()->json($result);
        }
        
    }

    public function editNews($id){        
        $categoris = CategoryModel::getCategory();
        $news = News::where('id', $id)->get();        
        $subCategories = SubCategoryModel::where('category_id', $news[0]->category_id)->orderBy('id', 'desc')->get();        
        if(count($news) > 0){
           return view('admin.news.edit_news', compact('categoris', 'news', 'subCategories'));                                                    
        }
        return redirect()->back();
        
    }

    public function submitEditNews(Request $request){               
        $validator = Validator::make($request->all(), [
            "news_id" => "required|integer|exists:news,id",
            "title" => "required|min:3|max:80|unique:news,title,".$request->input('news_id').",id",
            "category" => "required|integer|exists:categories,id",
            "sub_category" => "required|integer|exists:sub_categories,id",
            "publishDate" => "required|date",
            "publishTime" => "required",
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',            
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
                        
            $news = News::findOrFail($request->input('news_id'));                                                          
            if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()){                      
                $uploadDir = public_path('image/news-img');
                if(!is_null($news->thumbnail)){
                   if(file_exists($uploadDir."/".$news->thumbnail)){
                      unlink($uploadDir."/".$news->thumbnail);
                   }
                }                                                
                $filename = fileUploads($request->file('thumbnail'), $uploadDir);
            }else{                
                $filename = (!is_null($news->thumbnail)) ? $news->thumbnail : NULL;
            }            

            $news->update([
               "title" => $request->input("title"),
               "category_id" => $request->input("category"),
               "sub_category_id" => $request->input("sub_category"),
               "publish_date" => $request->input("publishDate"),
               "publish_time" => $request->input("publishTime"),
               "status" => $request->input("status"),
               "publish_end_date" => $request->input("publishEndDate"),               
               "thumbnail" => $filename,               
               "meta_title" => $request->input("meta_title"),
               "meta_keywords" => $request->input("meta_keyword"),
               "meta_description" => $request->input("meta_description"),               
               "description" => $request->input("description"),
            ]);
            $result = ["status" => true, "msg"=> "News Artical Successfully update"];
            return response()->json($result);

        }catch(\Exception $e){
            debug($e->getMessage());

            $result = ["status" => false, "msg"=> $e->getMessage()];
            return response()->json($result);
        }
    }

    public function newsDetail($id){
        $news = News::find($id);
        if($news){
           return view('admin.news.news_detail', compact('news'));
        }        
        return redirect()->back();
    }


}


