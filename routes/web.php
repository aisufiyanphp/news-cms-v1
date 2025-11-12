<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\AdminGuest;


Route::get('test', function () {
    $session = session()->all();
    debug($session);
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

      Route::get('category', [CategoryController::class, 'category'])->name('admin.category.list');
      Route::get('add-category', [CategoryController::class, 'addCategory'])->name('admin.add.category');
      Route::post('add-category', [CategoryController::class, 'submitCategory'])->name('admin.submit.category');  
      Route::get('edit-category/{id}', [CategoryController::class, 'editCategory'])->name('admin.edit.category')->whereNumber('id');
      Route::post('edit-category', [CategoryController::class, 'submitEditCategory'])->name('admin.submit.edit.category');      

      Route::get('sub-category', [CategoryController::class, 'subCategory'])->name('admin.sub.category.list');
      Route::get('add-sub-category', [CategoryController::class, 'addSubCategory'])->name('admin.add.sub.category');
      Route::post('add-sub-category', [CategoryController::class, 'submitAddSubCategory'])->name('admin.submit.add.sub.category');
      Route::get('edit-sub-category', [CategoryController::class, 'editSubCategory'])->name('admin.edit.sub.category');

      Route::get('news', [NewsController::class, "news"])->name('admin.news.list');
      Route::get('add-news', [NewsController::class, "addNews"])->name('admin.add.news');
  }); 
  
});

Route::fallback(function () {
   return redirect()->route('admin.login');
});

