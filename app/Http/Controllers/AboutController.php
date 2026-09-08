<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $title = "About Us";
        return view('aboutus.about', [
            'title' => $title,
        ]);
    }

    public function details(){
        $title = "About Us Details";
        return view('aboutus.details', [
            'title' => $title,
        ]);
    }

    public function history(){
        $title = "About Us History";
        return view('aboutus.history', [
            'title' => $title,
        ]);
    }
}