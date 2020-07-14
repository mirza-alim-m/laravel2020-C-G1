<?php

use Illuminate\Database\Seeder;
use App\Category;

class DatabukusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $categories = Category::all();
        for ($i=0; $i < 25; $i++) {
            DB::table('databukus')->insert([
                'id_kategori' => $categories[$i]->id_kategori,
                'nama_barang'=>$faker->sentence,
                'harga' => $faker->numberBetween($min = 50.000,$max = 500.000),
                
                'qty' => $faker->numberBetween(6,12),
            ]);
        }
    }
}
