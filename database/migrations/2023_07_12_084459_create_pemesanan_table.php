<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->increments('id_pemesanan');
            $table->string('kode_pemesanan_detail')->nullable();
            $table->unsignedInteger('id_member')->nullable();
            $table->foreign('id_member')->references('id_member')->on('member')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->integer('total_item');
            $table->string('surat')->default(0)->index();
            $table->string('eta')->default(0);
            $table->integer('total_harga')->default(0);
            $table->tinyInteger('diskon')->default(0);
            $table->integer('bayar')->default(0);
            $table->integer('diterima')->default(0);
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
        Schema::dropIfExists('pemesanan');
    }
}
