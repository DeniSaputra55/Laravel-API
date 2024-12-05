<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
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
            Buku::create([
                'judul'=>$faker->sentence,
                'pengarang' =>$faker->name,
                'tanggal_publikasi' => $faker->date
            ]);
        }
    }
}
