<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller    
{
    public function index(){
        $title = "Daftar Berita Ciptaju";
        return view('news.index', [
            'title' => $title,
        ] );
    }

    public function view($id = 1)
    {
        $title = "Detail Berita";

        return view('news.view', [
            'title' => $title,
            'id' => $id,
        ]);
    }
}