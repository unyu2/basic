<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_detail', function (Blueprint $table) {
            $table->increments('id_pendaftaran_detail');
            $table->unsignedInteger('id_pendaftaran');
            $table->foreign('id_pendaftaran')->references('id_pendaftaran')->on('pendaftaran')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('id_pengujian');
            $table->foreign('id_pengujian')->references('id_pengujian')->on('pengujian')->onDelete('restrict')->onUpdate('restrict');
            $table->integer('harga_beli');
            $table->integer('jumlah');
            $table->integer('subtotal');
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
        Schema::dropIfExists('pendaftaran_detail');
    }
}
