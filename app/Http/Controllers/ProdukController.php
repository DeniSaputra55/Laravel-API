<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    //menampilkan halaman index
    public function index()
    {
        $data_produk = Produk::all();
        return view('Produk.index', compact('data_produk'));
    }
}
