<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use  App\Models\Category;

class CategoryController extends Controller
{    
    public function category(){
        $categories = Category::orderBy('order', 'asc')->get();
        return view('admin.category', compact('categories'));
    }

    public function addCategory(){
        return view('admin.add_category');
    }

    public function submitCategory(Request $request){        
        $validator = Validator::make($request->all(), [
          'title' => 'required|unique:categories,category_title',
          'description' => 'required|max:150',
          'status' => 'required|boolean',
          'order' => 'required|integer|unique:categories,order',
          'meta_title' => 'nullable|string|max:255',
          'meta_keywords' => 'nullable|string|max:255',
          'meta_description' => 'nullable|string|max:255',
        ])->stopOnFirstFailure();
        if($validator->fails()){
           $result = ["status"=>false, "msg" => $validator->errors()->first()];                      
           return response()->json($result);
        }
        try{

            $category = Category::create([
               'category_title' => $request->input('title'),
               'description' => $request->input('description'),
               'status' => $request->input('status'),
               'order' => $request->input('order'),
               'meta_title' => $request->input('meta_title'),
               'meta_keywords' => $request->input('meta_keyword'),
               'meta_description' => $request->input('meta_description'),
            ]);
            $result = ["status"=>true, "msg"=>"Category successfully created"];
            return response()->json($result); 

        }catch(\Exception $e){
            $result = ["status"=>false, "msg" => $e->getMessage()];                      
            //$result = ["status"=>false, "msg" => "Technical Error! Category not created "];                      
            return response()->json($result); 
        }            
    }

    public function editCategory($id){
        $category = Category::where('id', $id)->get();
        if(count($category) > 0){
           return view('admin.edit_category', compact('category'));    
        }
        return redirect()->back();
        
    }

    public function submitEditCategory(Request $request){        
        $validator = Validator::make($request->all(), [
          'category_id' => 'required|exists:categories,id',  
          'title' => 'required|unique:categories,category_title,'.$request->input('category_id'),
          'description' => 'required|max:150',
          'status' => 'required|boolean',
          'order' => 'required|integer|unique:categories,order,'.$request->input('category_id'),
          'meta_title' => 'nullable|string|max:255',
          'meta_keywords' => 'nullable|string|max:255',
          'meta_description' => 'nullable|string|max:255',
        ])->stopOnFirstFailure();
        if($validator->fails()){
           $result = ["status"=>false, "msg" => $validator->errors()->first()];                      
           return response()->json($result);
        }
        try{

            $id = $request->input('category_id');
            $category = Category::findOrFail($id);

            $category->update([
                'category_title'   => $request->title,
                'description'      => $request->description,
                'status'           => $request->status,
                'meta_title'       => $request->meta_title,
                'meta_keywords'    => $request->meta_keywords,
                'meta_description' => $request->meta_description,
            ]);
            $result = ["status"=>true, "msg"=>"Category successfully update"];
            return response()->json($result); 

        }catch(\Exception $e){
            $result = ["status"=>false, "msg" => $e->getMessage()];                      
            return response()->json($result); 
        }            
    }
    
    //Sub Category
    public function subCategory(){        
        return view('admin.sub_category');
    }

    public function addSubCategory(){
        $categories = Category::orderBy('id', 'desc')->get();        
        return view('admin.add_sub_category', compact('categories'));
    }

    public function submitAddSubCategory(Request $request){                
        $validator = Validator::make($request->all(), [
          'title' => 'required|unique:categories,category_title',
          'category' => 'required|integer|exists:categories,id',
          'description' => 'required|max:150',
          'status' => 'required|boolean',
          'order' => 'required|integer|unique:categories,order',
          'meta_title' => 'nullable|string|max:255',
          'meta_keywords' => 'nullable|string|max:255',
          'meta_description' => 'nullable|string|max:255',
        ])->stopOnFirstFailure();
        if($validator->fails()){
           $result = ["status"=>false, "msg" => $validator->errors()->first()];                      
           return response()->json($result);
        }
        try{
            
            debug("validate");
            // $category = Category::create([
            //    'category_title' => $request->input('title'),
            //    'description' => $request->input('description'),
            //    'status' => $request->input('status'),
            //    'order' => $request->input('order'),
            //    'meta_title' => $request->input('meta_title'),
            //    'meta_keywords' => $request->input('meta_keyword'),
            //    'meta_description' => $request->input('meta_description'),
            // ]);
            // $result = ["status"=>true, "msg"=>"Category successfully created"];
            // return response()->json($result); 

        }catch(\Exception $e){
            $result = ["status"=>false, "msg" => $e->getMessage()];                      
            //$result = ["status"=>false, "msg" => "Technical Error! Category not created "];                      
            return response()->json($result); 
        }            
    }

    public function editSubCategory(){
        return view('admin.edit_sub_category');
    }
}
