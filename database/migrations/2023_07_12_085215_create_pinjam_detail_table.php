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
            $table->unsignedInteger('id_pinjam');
            $table->foreign('id_pinjam')->references('id_pinjam')->on('pinjam')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('restrict')->onUpdate('restrict');
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
