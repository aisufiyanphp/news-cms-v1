<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get("admin/login", function(){
  return view('admin.login');
})->name('admin.login');
Route::get("admin/forget-password", function(){
  return view('admin.forget-password');
})->name('admin.forget.password');

Route::get('admin/dashboard', function(){
  return view('admin.dashboard');
})->name('admin.dashboard');
