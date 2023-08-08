<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyek', function (Blueprint $table) {
            $table->increments('id_proyek');
            $table->unsignedInteger('id_konfigurasi')->default(0);
            $table->foreign('id_konfigurasi')->references('id_konfigurasi')->on('konfigurasi')->onDelete('restrict')->onUpdate('restrict');
            $table->string('kode_proyek');
            $table->string('nama_proyek')->unique();
            $table->integer('harga_beli')->default(0);
            $table->integer('stok')->nullable();
            $table->integer('subtotal')->nullable();
            $table->string('status')->nullable();
            $table->date('start_date')->index()->nullable();
            $table->date('finish_date')->index()->nullable();

            $table->string('konf1')->index()->nullable();
            $table->string('konf2')->index()->nullable();
            $table->string('konf3')->index()->nullable();
            $table->string('konf4')->index()->nullable();
            $table->string('konf5')->index()->nullable();
            $table->string('konf6')->index()->nullable();
            $table->string('konf7')->index()->nullable();
            $table->string('konf8')->index()->nullable();
            $table->string('konf9')->index()->nullable();
            $table->string('konf10')->index()->nullable();

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
        Schema::dropIfExists('proyek');
    }
}
