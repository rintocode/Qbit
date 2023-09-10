<?php

use App\Http\Controllers\API\BantuanController;
use App\Http\Controllers\API\HargaController;
use App\Http\Controllers\API\TestimoniController;
use App\Http\Controllers\API\TentangController;
use App\Models\Bantuan;
use App\Models\Harga;
use App\Models\Tentang;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/bantuans', function () {
    $bantuans = Bantuan::orderBy('name')->get();
    return BantuanController::collection($bantuans);
});
Route::get('/testimonis', function () {
    $testimonis = Testimoni::orderBy('nama')->get();
    return TestimoniController::collection($testimonis);
});
Route::get('/hargas', function () {
    $hargas = Harga::orderBy('name')->get();
    return HargaController::collection($hargas);
});
Route::get('/tentangs', function () {
    $tentangs = Tentang::orderBy('name')->get();
    return TentangController::collection($tentangs);
});
