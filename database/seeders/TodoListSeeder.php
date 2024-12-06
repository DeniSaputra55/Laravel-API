<?php

namespace Database\Seeders;

use App\Models\TodoList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //memasukkan data fake sesuai nama indonesia
        $faker = \Faker\Factory::create('id_ID');
        //menentukan jumlah data
        for ($i = 0; $i < 10; $i++){
            TodoList::create([
                'todo' => substr($faker->sentence, 0, 30), // Memotong string menjadi maksimal 30 karakter
                'tanggal'=>$faker->date,
                'jam' =>$faker->time,
                'status' => $faker->randomElement(['belum', 'sedang', 'sudah']) //untuk enum
            ]);
        }
    }
}
