<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->integer('id_kategori')->unsigned();

            $table->string('nama_barang');
            $table->integer('harga');
            $table->text('spesifikasi');
            $table->integer('qty');
            $table->string('img')->nullable()->default(null);
            $table->string('document')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('id_kategori')->references('id_kategori')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
