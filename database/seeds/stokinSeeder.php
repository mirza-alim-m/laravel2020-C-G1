<?php

use Illuminate\Database\Seeder;
use App\Product;

class stokinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(Faker\Generator $faker)
    {
        $products = Product::all();
        for ($i=0; $i < 25; $i++) {
            DB::table('stockins')->insert([
                'id_barang' => $products[$i]->id_barang,
                 'qty' => $faker->numberBetween($min = 100,$max = 150),
              
                // 'qty' => $faker->numberBetween(6,12),
            ]);
        }
    }
}