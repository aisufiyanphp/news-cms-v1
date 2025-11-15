<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get("/test", function(Request $request){
   echo "<pre>";
   print_r($request->all());
});
