<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        $title = "ini test";
        return view('auth.login', [
            'title' => $title,
        ] );
    }

    public function register(){
        $title = "ini test";
        return view('auth.register', [
            'title' => $title,
        ] );
    }

    public function view(){
        $title = "ini test";
        return view('auth.view', [
            'title' => $title,
        ] );
    }
}