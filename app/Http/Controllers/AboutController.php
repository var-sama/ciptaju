<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $title = "About Us";
        return view('about.index', [
            'title' => $title,
        ]);
    }

    public function view(){
        $title = "About Us Details";
        return view('about.view', [
            'title' => $title,
        ]);
    }

    public function discover(){
        $title = "About Us Discover";
        return view('about.discover', [
            'title' => $title,
        ]);
    }
}