<?php
 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\housingController;
 
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
Route::middleware(['auth', 'admin'])->group(function () {
 
    Route::get('admin/dashboard', [HomeController::class, 'index']);
 
    Route::get('/admin/products', [housingController::class, 'index'])->name('admin/housings');
    Route::get('/admin/products/create', [housingController::class, 'create'])->name('admin/housings/create');
    Route::post('/admin/products/save', [housingController::class, 'save'])->name('admin/housings/save');
    Route::get('/admin/products/edit/{id}', [housingController::class, 'edit'])->name('admin/housings/edit');
    Route::put('/admin/products/edit/{id}', [housingController::class, 'update'])->name('admin/housings/update');
    Route::get('/admin/products/delete/{id}', [housingController::class, 'delete'])->name('admin/housings/delete');
});
 
require __DIR__.'/auth.php';
 
//Route::get('admin/dashboard', [HomeController::class, 'index']);
//Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);