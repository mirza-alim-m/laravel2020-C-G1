<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['nama_kategori' => 'Laravel'],
            ['nama_kategori' => 'CodeIgniter4'],
            ['nama_kategori' => 'FuelPHP'],
            ['nama_kategori' => 'PhalconPHP'],
            ['nama_kategori' => 'Slim'],
            ['nama_kategori' => 'Silex'],
            ['nama_kategori' => 'CakePHP'],
            ['nama_kategori' => 'Symfony'],
            ['nama_kategori' => 'Yii2'],
            ['nama_kategori' => 'Laravel'],
            ['nama_kategori' => 'Lumen'],
            ['nama_kategori' => 'ZendFramework'],
            ['nama_kategori' => 'Laravel'],
            ['nama_kategori' => 'CodeIgniter4'],
            ['nama_kategori' => 'FuelPHP'],
            ['nama_kategori' => 'PhalconPHP'],
            ['nama_kategori' => 'Slim'],
            ['nama_kategori' => 'Silex'],
            ['nama_kategori' => 'CakePHP'],
            ['nama_kategori' => 'Symfony'],
            ['nama_kategori' => 'Yii2'],
            ['nama_kategori' => 'Laravel'],
            ['nama_kategori' => 'Lumen'],
            ['nama_kategori' => 'ZendFramework'],
            ['nama_kategori' => 'Laravel'],
           
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
