<?php

use App\Http\Controllers\BantuanController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

Route::resource('bantuans', BantuanController::class);
Route::resource('testimonis', TestimoniController::class);
Route::resource('tentangs', TentangController::class);
Route::resource('hargas', HargaController::class);

require __DIR__.'/auth.php';
