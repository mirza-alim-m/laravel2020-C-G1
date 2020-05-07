<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukmasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produkmasuks', function (Blueprint $table) {
            $table->increments('id_masuk');
            $table->integer('id_buku')->unsigned();
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('id_buku')->references('id_buku')->on('databukus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produkmasuks');
    }
}
