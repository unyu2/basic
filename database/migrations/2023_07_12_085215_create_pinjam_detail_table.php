<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_detail', function (Blueprint $table) {
            $table->increments('id_pinjam_detail');
            $table->integer('id_pinjam')->null();
            $table->foreign('id_pinjam')->references('id_pinjam')->on('pinjam')->onDelete('cascade')->onUpdate('restrict');
            $table->integer('id_barang')->null();
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade')->onUpdate('restrict');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjam_detail');
    }
}
