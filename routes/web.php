<?php
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::name('students.')->prefix('students')->group(function(){
   
    //daftar(index)
    Route::get('/', [StudentController::class, 'index'])->name('index');
    //detail(show)
    //tambah(create)
    Route::get('/create',[StudentController::class, 'create'])->name('create');
    //edit(edit)
    Route::get('/{id}',[StudentController::class, 'show'])->name('show');//->whereNumber('');
    Route::get('/{id}/edit',[StudentController::class, 'edit'])->name('edit');
    //logika tambah(store)
    Route::post('/',[StudentController::class, 'store'])->name('store');
    //logika edit(update)
    Route::put('/{id}',[StudentController::class, 'update'])->name('update');
    //logika hapus(delete)
    Route::delete('/{id}',[StudentController::class, 'destroy'])->name('destroy');
});

// Route Halaman Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route Halaman Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Route Halaman Profile
Route::get('/profile', function () {
    return view('students.profile');
})->name('profile');

// Route dummy untuk proses update form agar tidak error
Route::put('/profile', function () {
    return back();
})->name('profile.update');

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});