<?php

use Illuminate\Database\Seeder;
use App\Product;

class stokoutSeeder extends Seeder
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
            DB::table('stockouts')->insert([
                'id_barang' => $products[$i]->id_barang,
                'qty' => $faker->numberBetween($min = 100,$max = 150),
              
                // 'qty' => $faker->numberBetween(6,12),
            ]);
        }
    }
}
