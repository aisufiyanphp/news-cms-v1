<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news(){
        return view('admin.news.news');
    }

    public function addNews(){
        return view('admin.news.add_news');
    }
}
