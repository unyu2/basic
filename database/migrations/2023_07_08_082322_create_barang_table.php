<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->unsignedInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('restrict')->onUpdate('restrict');
            $table->string('nama_barang')->unique()->index();
            $table->string('kode_barang')->nullable()->index();
            $table->string('merk')->nullable()->index();
            $table->string('asal')->index();
            $table->string('status')->index();
            $table->string('pj')->index();
            $table->string('lokasi')->index();
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
        Schema::dropIfExists('barang');
    }
}
