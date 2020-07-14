<?php

use Illuminate\Database\Seeder;
use App\Category;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        // $categories = Category::all();
        // for ($i=0; $i < 100; $i++) {
        //     DB::table('products')->insert([
        //         'id_kategori' => $categories[$i]->id_kategori,
        //         'nama_barang'=>$faker->sentence,
        //         'harga' => $faker->numberBetween($min = 1000000,$max = 150000000),
        //         'spesifikasi' => $faker->paragraph,
        //         'qty' => $faker->numberBetween(6,12),
        //     ]);
        // }

        DB::table('products')->insert([
            'id_kategori' => 1,
            'nama_barang'=>'Buku Laravel (pemula)',
            'harga' => 255000,
            'spesifikasi' => 'buku pemula laravel',
            'qty' => 2,
        ]);

        DB::table('products')->insert([
            'id_kategori' => 1,
            'nama_barang'=>'Buku CodeIgniter (mahir)',
            'harga' => 154000,
            'spesifikasi' => 'buku CodeIgniter untuk bisa mahir',
            'qty' => 2,
        ]);

        DB::table('products')->insert([
            'id_kategori' => 1,
            'nama_barang'=>'Buku Lumen (mahir)',
            'harga' => 174990,
            'spesifikasi' => 'Mahir pemrograman Lumen',
            'qty' => 2,
        ]);

        DB::table('products')->insert([
            'id_kategori' => 1,
            'nama_barang'=>'Buku PhalconPHP (pemula)',
            'harga' => 2049900,
            'spesifikasi' => 'buku pemula PhalconPHP',
            'qty' => 3,
        ]);

        DB::table('products')->insert([
            'id_kategori' => 1,
            'nama_barang'=>'Buku Laravel (mahir)',
            'harga' => 599000,
            'spesifikasi' => 'buku ini menjadikan mahir laravel dalam 1minggu',
            'qty' => 3,
        ]);

        DB::table('products')->insert([
            'id_kategori' => 1,
            'nama_barang'=>'Buku Laravel (mahir)',
            'harga' => 599000,
            'spesifikasi' => 'buku ini menjadikan mahir laravel dalam 1minggu',
            'qty' => 3,
        ]);
    }
}
