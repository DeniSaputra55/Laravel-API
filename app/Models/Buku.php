<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    //nama table
    protected $table = "buku";
    //nama kolom
    protected $fillable = ['judul', 'pengarang', 'tanggal_publikasi'];
}
