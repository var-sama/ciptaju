<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{   
    public function index(){
        $title = "ini test";
        return view('extracurricular.index', [
            'title' => $title,
        ] );
    }
}