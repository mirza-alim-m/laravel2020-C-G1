<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('databukus', function (Blueprint $table) {
            $table->increments('id_buku');
            $table->integer('id_kategori')->unsigned();

            $table->string('nama_barang');
            $table->integer('harga');
            $table->string('cover')->nullable();
            $table->integer('qty');
            $table->string('doc_pdf')->nullable();
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
