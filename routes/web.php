<?php

use App\Http\Controllers\BukuController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});
//buku
Route::get('/buku', [BukuController::class,'index']);
Route::get('/add/buku', [BukuController::class,'create']);
Route::post('/add/buku', [BukuController::class,'store'])->name('store');
Route::get('/buku/{id}', [BukuController::class,'edit']);
Route::post('/edit/buku', [BukuController::class,'update'])->name('update');
Route::get('/buku/show/{id}', [BukuController::class, 'show'])->name('buku.show');
Route::get('/delete/{id}',[BukuController::class,'destroy']);

