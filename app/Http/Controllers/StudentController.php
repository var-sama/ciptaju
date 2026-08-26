<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $title = "ini test";
        return view('students.index', [
            'title' => $title,
        ] );
    }
}