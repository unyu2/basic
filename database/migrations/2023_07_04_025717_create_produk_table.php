<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->unsignedInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('id_proyek');
            $table->foreign('id_proyek')->references('id_proyek')->on('id_proyek')->onDelete('restrict')->onUpdate('restrict');
            $table->string('kode_produk')->unique();
            $table->string('nama_produk')->unique();
            $table->string('merk')->nullable();
            $table->integer('harga_beli')->default(0);
            $table->tinyInteger('diskon')->default(0);
            $table->integer('harga_jual')->default(0);
            $table->integer('stok')->nullable();
            $table->integer('stok_minta')->nullable();
            $table->integer('stok_kirim')->nullable();
            $table->integer('rusak')->nullable();
            $table->string('satuan')->index();
            $table->string('komat')->nullable()->index();
            $table->string('status')->nullable();
            $table->string('sets')->nullable();
            $table->string('spesifikasi')->nullable();
            $table->string('keterangan')->nullable();

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
        Schema::dropIfExists('produk');
    }
}

