<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_detail', function (Blueprint $table) {
            $table->increments('id_pemesanan_detail');
            $table->unsignedInteger('id_pemesanan')->nullable();
            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanan')->onDelete('cascade')->onUpdate('restrict');
            $table->unsignedInteger('id_produk')->nullable();
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade')->onUpdate('restrict');
            $table->string('kode_pemesanan_detail')->nullable();
            $table->integer('harga_jual')->nullable();
            $table->string('trainset')->index()->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('status')->nullable();
            $table->tinyInteger('diskon')->nullable();
            $table->integer('subtotal')->nullable();
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
        Schema::dropIfExists('pemesanan_detail');
    }
}
