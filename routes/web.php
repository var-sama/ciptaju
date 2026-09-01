<?php
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('students.newsdetail');
});

Route::name('students.')->prefix('students')->group(function(){
   
    //daftar(index)
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/news-detail', [StudentController::class, 'newsdetail'])->name('newsdetail');
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