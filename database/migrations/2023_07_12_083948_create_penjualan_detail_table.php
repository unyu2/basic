<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_detail', function (Blueprint $table) {
            $table->increments('id_penjualan_detail');
            $table->unsignedInteger('id_penjualan');
            $table->foreign('id_penjualan')->references('id_penjualan')->on('penjualan')->onDelete('cascade')->onUpdate('restrict');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade')->onUpdate('restrict');
            $table->integer('harga_jual')->default(0);
            $table->integer('jumlah');
            $table->integer('jumlah2')->nullable();
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
        Schema::dropIfExists('penjualan_detail');
    }
}
