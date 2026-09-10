<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AboutController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::name('about.')->prefix('about')->group(function(){
   
    //daftar(index)
    Route::get('/', [AboutController::class, 'index'])->name('index');
    //detail(show)
    //tambah(create)
    Route::get('/view',[AboutController::class, 'view'])->name('view');
    Route::get('/discover',[AboutController::class, 'discover'])->name('discover');
});