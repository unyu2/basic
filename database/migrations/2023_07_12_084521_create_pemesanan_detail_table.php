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
            $table->unsignedInteger('id_pemesanan');
            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanan')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('restrict')->onUpdate('restrict');
            $table->string('kode_pemesanan_detail')->nullable();
            $table->integer('harga_jual');
            $table->string('trainset')->index();
            $table->integer('jumlah');
            $table->string('status');
            $table->tinyInteger('diskon')->default(0);
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
        Schema::dropIfExists('pemesanan_detail');
    }
}
