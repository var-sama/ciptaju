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

    public function newsdetail()
    {
        $title = "Detail Berita";
        $id = 1;

        return view('students.newsdetail', [
            'title' => $title,
            'id' => $id,
        ]);
    }
}