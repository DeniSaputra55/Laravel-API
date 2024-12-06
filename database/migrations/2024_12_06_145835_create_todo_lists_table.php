<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todo_list', function (Blueprint $table) {
            $table->id();
            $table->string('todo',30); //memberika panjang karakter 30
            $table->date('tanggal');
            $table->time('jam');
            $table->enum('status', ['belum', 'sedang', 'sudah']); // Mendefinisikan enum dengan nilai yang diizinkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todo_list');
    }
};
