<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AdminGuest;


Route::get('test', function () {
    debug(getSetting('logo'));
});

// admin route start here
Route::prefix('admin')->group(function(){
  
  Route::middleware([AdminGuest::class])->group(function(){
     Route::get('login', [AuthController::class, 'loginForm'])->name('admin.login');
     Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');     
     Route::get('forget-password', [AuthController::class, 'forgetPasswordForm'])->name('admin.forget.password');
  });

  Route::middleware([AdminAuth::class])->group(function(){

      Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

      Route::get('profile', [ProfileController::class, 'profile'])->name('admin.profile');
      Route::get('change-password', [ProfileController::class, 'changePassword'])->name('admin.change.password');

      Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

      //setting route
      Route::get('settings', [SettingController::class, 'settings'])->name('admin.settings');
      Route::post('settings', [SettingController::class, 'submitSettings'])->name('admin.submit.settings');

      Route::get('category', [CategoryController::class, 'category'])->name('admin.category.list');
      Route::get('add-category', [CategoryController::class, 'addCategory'])->name('admin.add.category');
      Route::post('add-category', [CategoryController::class, 'submitCategory'])->name('admin.submit.category');  
      Route::get('edit-category/{id}', [CategoryController::class, 'editCategory'])->name('admin.edit.category')->whereNumber('id');
      Route::post('edit-category', [CategoryController::class, 'submitEditCategory'])->name('admin.submit.edit.category');      

      Route::get('sub-category', [CategoryController::class, 'subCategory'])->name('admin.sub.category.list');
      Route::get('all-sub-category/{id}', [CategoryController::class, 'allSubCategory'])->name('admin.all.sub.category');      
      Route::get('add-sub-category', [CategoryController::class, 'addSubCategory'])->name('admin.add.sub.category');
      Route::post('add-sub-category', [CategoryController::class, 'submitAddSubCategory'])->name('admin.submit.add.sub.category');
      Route::get('edit-sub-category/{id}', [CategoryController::class, 'editSubCategory'])->name('admin.edit.sub.category')->whereNumber('id');
      Route::post('edit-sub-category', [CategoryController::class, 'submiteditSubCategory'])->name('admin.submit.edit.sub.category');
      
      //news 
      Route::get('news', [NewsController::class, "news"])->name('admin.news.list');
      Route::get('news-detail/{id}', [NewsController::class, "newsDetail"])->name('admin.news.detail')->whereNumber('id');

      Route::post('get-news-by', [NewsController::class, 'getNews'])->name('admin.get.news');

      Route::get('add-news', [NewsController::class, "addNews"])->name('admin.add.news');
      Route::post('add-news', [NewsController::class, "submitAddNews"])->name('admin.submit.add.news');
      Route::get('edit-news/{id}', [NewsController::class, "editNews"])->name('admin.edit.news')->whereNumber('id');
      Route::post('edit-news', [NewsController::class, "submitEditNews"])->name('admin.submit.edit.news');

      Route::post('upload-thumbnail', [DashboardController::class, "uploadThumbnail"])->name('admin.upload.thumbnail');            
  }); 
  
});

//frontend side
Route::get('/', function(){
   return view('home');
});

Route::fallback(function () {
   return redirect()->route('admin.login');
});

