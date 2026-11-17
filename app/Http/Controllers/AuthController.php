<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRegistrationRequest;
use App\Models\StudentRegistration;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function loginView()
    {
        return view('auth.login', [
            'title' => 'Halaman Login',
        ]);
    }

    // Memproses login
    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'student') {
                return redirect()->intended(route('students.index'));
            }

            // Untuk role selain student
            return redirect()->intended(route('students.index'));
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password tidak cocok.',
            ])
            ->onlyInput('email');
    }

    // Menampilkan halaman register
    public function registerView()
    {
        return view('auth.register', [
            'title' => 'Halaman Register',
        ]);
    }

    // Memproses pembuatan akun
    public function registerPost(Request $request)
    {
        $validatedRequest = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validatedRequest['name'],
            'email' => $validatedRequest['email'],
            'password' => $validatedRequest['password'],
            'role' => 'student',
        ]);

        return redirect()
            ->route('auth.login')
            ->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('auth.login')
            ->with('success', 'Kamu berhasil logout.');
    }

    // Halaman profil
    public function view()
    {
        return view('auth.view', [
            'title' => 'Halaman Profil',
        ]);
    }

    // Halaman pendaftaran siswa
    public function registration(): View
    {
        return view('auth.registration', [
            'title' => 'Halaman Registrasi',
        ]);
    }

    // Memproses pendaftaran siswa
    public function storeRegistration(StoreStudentRegistrationRequest $request): RedirectResponse
    {
        StudentRegistration::create($request->validated());

        return redirect()
            ->route('auth.registration')
            ->with('success', 'Pendaftaran berhasil dikirim.');
    }
}
