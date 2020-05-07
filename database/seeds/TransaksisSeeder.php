<?php

use Illuminate\Database\Seeder;
use App\Databuku;

class TransaksisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $databukus = Databuku::all();
        for ($i=0; $i < 25; $i++) {
            DB::table('transaksis')->insert([
                'id_buku' => $databukus[$i]->id_buku,
                'nama_pembeli'=>$faker->name,
                'qty' => $faker->numberBetween($min = 100,$max = 150),
                'email'=>$faker->safeEmail,
              
                // 'qty' => $faker->numberBetween(6,12),
            ]);
        }
    }
}
