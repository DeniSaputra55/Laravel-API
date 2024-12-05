<?php

use App\Http\Controllers\Api\BukuController;
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

//route buku
// Route::get('buku',[BukuController::class,'index']); //tampilkan seluruh data 
// Route::get('buku/{id}', [BukuController::class, 'show']);//tampilkan data berdasarkan id
// Route::post('buku', [BukuController::class, 'store']); //memasukan data baru
// Route::put('buku/{id}', [BukuController::class, 'update']);//untuk update data
// Route::delete('buku/{id}', [BukuController::class, 'destroy']);//untuk update data

//API RINGKAS
Route::apiResource('buku',BukuController::class);


