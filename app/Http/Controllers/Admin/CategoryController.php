<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;

class CategoryController extends Controller
{    
    public function category(){
        $categories = CategoryModel::getCategory();
        return view('admin.category.category', compact('categories'));
    }

    public function addCategory(){
        return view('admin.category.add_category');
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

            $category = CategoryModel::create([
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
        $category = CategoryModel::getCategory($id);
        if(count($category) > 0){
           return view('admin.category.edit_category', compact('category'));    
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
            $category = CategoryModel::findOrFail($id);

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
        $subCategories = SubCategoryModel::with('category:id,category_title')->orderBy('id', 'desc')->get();                
        return view('admin.category.sub_category', compact('subCategories'));
    }

    public function allSubCategory(Request $request, $id){
        if($request->ajax()){
            $category = CategoryModel::getCategory($id);
            $subCategories = SubCategoryModel::where("category_id", $id)->get(["id", "title"]);  
            if(count($subCategories) > 0){
                $result = ["status"=>true, "msg"=>ucwords($category[0]->category_title)." Sub Category list", "data"=>$subCategories];
                return response()->json($result); 
            }else{
                $result = ["status"=>false, "msg"=>ucwords($category[0]->category_title)." Sub Category Not found"];
                return response()->json($result); 
            }   
        }else{            
            $category = CategoryModel::getCategory($id, "category_title");            
            $subCategories = SubCategoryModel::where("category_id", $id)->get();        
            if(count($subCategories) > 0){
               return view('admin.category.all_sub_category', compact('subCategories', 'category'));
            }
            return redirect()->back();
        }        
    }

    public function addSubCategory(){        
        $categories = CategoryModel::getCategory();
        return view('admin.category.add_sub_category', compact('categories'));
    }

    public function submitAddSubCategory(Request $request){                
        $validator = Validator::make($request->all(), [
          'title' => 'required|unique:sub_categories,title',
          'category' => 'required|integer|exists:categories,id',
          'description' => 'required|max:150',
          'status' => 'required|boolean',
          'order' => [
                'required',
                'integer',
                Rule::unique('sub_categories')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category);
                }),
          ],
          'meta_title' => 'nullable|string|max:255',
          'meta_keywords' => 'nullable|string|max:255',
          'meta_description' => 'nullable|string|max:255',
        ])->stopOnFirstFailure();
        if($validator->fails()){
           $result = ["status"=>false, "msg" => $validator->errors()->first()];                      
           return response()->json($result);
        }
        try{
                        
            $category = SubCategoryModel::create([
               'title' => $request->input('title'),
               'category_id' => $request->input('category'),
               'description' => $request->input('description'),
               'status' => $request->input('status'),
               'order' => $request->input('order'),
               'meta_title' => $request->input('meta_title'),
               'meta_keywords' => $request->input('meta_keyword'),
               'meta_description' => $request->input('meta_description'),
            ]);
            $result = ["status"=>true, "msg"=>"Sub Category successfully created"];
            return response()->json($result); 

        }catch(\Exception $e){
            $result = ["status"=>false, "msg" => $e->getMessage()];                      
            //$result = ["status"=>false, "msg" => "Technical Error! Category not created "];                      
            return response()->json($result); 
        }            
    }

    public function editSubCategory($id){        
        $categories = CategoryModel::getCategory();    
        $subCategory = SubCategoryModel::where('id', $id)->get();
        if(count($subCategory) > 0){
           return view('admin.category.edit_sub_category', compact('categories', 'subCategory'));    
        }    
        return redirect()->back();
        
    }

    public function submiteditSubCategory(Request $request){  
                  
        $validator = Validator::make($request->all(), [
          'subCategoryId' => 'required|integer|exists:sub_categories,id',  
          'title' => 'required|unique:sub_categories,title,'.$request->input('subCategoryId'),
          'category' => 'required|integer|exists:categories,id',
          'description' => 'required|max:150',
          'status' => 'required|boolean',
          'order' => [
                'required',
                'integer',
                Rule::unique('sub_categories')
                ->where(fn($query) => $query->where('category_id', $request->input('category')))
                ->ignore($request->input('subCategoryId')), 
          ],
          'meta_title' => 'nullable|string|max:255',
          'meta_keywords' => 'nullable|string|max:255',
          'meta_description' => 'nullable|string|max:255',
        ])->stopOnFirstFailure();
        if($validator->fails()){
           $result = ["status"=>false, "msg" => $validator->errors()->first()];                      
           return response()->json($result);
        }
        try{

            $subCategory = SubCategory::findOrFail($request->input('subCategoryId'));            
            $subCategory->update([
               'title' => $request->input('title'),
               'category_id' => $request->input('category'),
               'description' => $request->input('description'),
               'status' => $request->input('status'),
               'order' => $request->input('order'),
               'meta_title' => $request->input('meta_title'),
               'meta_keywords' => $request->input('meta_keyword'),
               'meta_description' => $request->input('meta_description'),
            ]);            
            $result = ["status"=>true, "msg"=>"Sub Category successfully update"];
            return response()->json($result); 

        }catch(\Exception $e){
            $result = ["status"=>false, "msg" => $e->getMessage()];                      
            //$result = ["status"=>false, "msg" => "Technical Error! Category not created "];                      
            return response()->json($result); 
        }            
    }
}
