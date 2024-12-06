<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;
    //nama table
    protected $table = 'todo_list';
    //nama kolom
    protected $fillable = [
        'id',
        'todo',
        'tanggal',
        'jam',
        'status'
    ];
}
