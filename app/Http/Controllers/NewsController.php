<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{       
    public function index(){
        $title = "ini test";
        return view('news.index', [
            'title' => $title,
        ] );
    }
}