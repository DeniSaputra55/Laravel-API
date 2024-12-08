<?php

use App\Http\Controllers\TodoListController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProdukController;
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

//todo list
Route::get('/todo', [TodoListController::class, 'index']);
Route::get('/add/todo', [TodoListController::class, 'create']);
Route::post('/add/todo', [TodoListController::class, 'store'])->name('store');
Route::get('/todo/{id}', [TodoListController::class,'edit']);
Route::post('/edit/todo', [TodoListController::class,'update'])->name('update');
Route::get('/todo/show/{id}', [TodoListController::class, 'show'])->name('todo.show');
Route::get('/delete/{id}',[TodoListController::class,'destroy']);

//produk
Route::get('/produk', [ProdukController::class, 'index']);



