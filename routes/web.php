<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
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

      Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

      Route::get('category', [CategoryController::class, 'category'])->name('admin.category.list');
  }); 
  
});

