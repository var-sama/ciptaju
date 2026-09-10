<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        $title = "Halaman Login";
        return view('auth.login', [
            'title' => $title,
        ] );
    }

    public function register(){
        $title = "Halaman Register";
        return view('auth.register', [
            'title' => $title,
        ] );
    }

    public function view(){
        $title = "Halaman Profil";
        return view('auth.view', [
            'title' => $title,
        ] );
    }

    public function registration()
    {
        $title = "Halaman Registrasi";
        return view('auth.registration', [
            'title' => $title,
        ]);
    }

    public function storeRegistration(Request $request)
    {
        $request->validate([
            'school_target' => ['required', 'string', 'max:100'],
            'school_year' => ['required', 'string', 'max:20'],
            'student_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'active_number' => ['required', 'string', 'max:30'],
        ]);

        return redirect()->route('auth.registration')->with('success', 'Pendaftaran berhasil dikirim.');
    }
}