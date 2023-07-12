<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_detail', function (Blueprint $table) {
            $table->increments('id_pembelian_detail');
            $table->unsignedInteger('id_pembelian');
            $table->foreign('id_pembelian')->references('id_pembelian')->on('pembelian')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('pembelian_detail');
    }
}
