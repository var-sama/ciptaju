<?php
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('news.index');
});

Route::name('news.')->prefix('news')->group(function(){
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/detail', [NewsController::class, 'view'])->name('view');
    Route::get('/registration', [NewsController::class, 'registration'])->name('registration');
    Route::post('/registration', [NewsController::class, 'storeRegistration'])->name('registration.store');

    // //detail(show)
    // //tambah(create)
    // Route::get('/create',[StudentController::class, 'create'])->name('create');
    // //edit(edit)
    // Route::get('/{id}',[StudentController::class, 'show'])->name('show');//->whereNumber('');
    // Route::get('/{id}/edit',[StudentController::class, 'edit'])->name('edit');
    // //logika tambah(store)
    // Route::post('/',[StudentController::class, 'store'])->name('store');
    // //logika edit(update)
    // Route::put('/{id}',[StudentController::class, 'update'])->name('update');
    // //logika hapus(delete)
    // Route::delete('/{id}',[StudentController::class, 'destroy'])->name('destroy');
});
Route::name('auth.')->prefix('auth')->group(function(){
   
    //daftar(index)
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/view', [AuthController::class, 'view'])->name('view');
    //detail(show)
    
});



