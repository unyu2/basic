<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan_detail', function (Blueprint $table) {
            $table->increments('id_permintaan_detail');
            $table->unsignedInteger('id_permintaan')->nullable();
            $table->foreign('id_permintaan')->references('id_permintaan')->on('permintaan')->onDelete('cascade')->onUpdate('restrict');
            $table->unsignedInteger('id_produk')->nullable();
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade')->onUpdate('restrict');
            $table->unsignedInteger('id_proyek')->nullable();
            $table->foreign('id_proyek')->references('id_proyek')->on('proyek')->onDelete('cascade')->onUpdate('restrict');
            $table->string('status2')->nullable()->index();
            $table->string('status3')->nullable()->index();
            $table->date('site')->nullable();
            $table->string('komats')->nullable()->index();
            $table->text('nopr')->nullable();
            $table->text('nopo')->nullable();
            $table->integer('harga_beli')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('permintaan_detail');
    }
}
