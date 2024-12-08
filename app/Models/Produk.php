<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    //nama table
    protected $table = "produk";
    //nama kolom
    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'stok',
        'gambar',
        'harga'
    ];
}
