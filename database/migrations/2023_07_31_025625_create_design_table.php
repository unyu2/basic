<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design', function (Blueprint $table) {
            $table->increments('id_design');
            $table->unsignedInteger('id_kepala_gambar');
            $table->foreign('id_kepala_gambar')->references('id_kepala_gambar')->on('kepala_gambar')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('id_proyek');
            $table->foreign('id_proyek')->references('id_proyek')->on('proyek')->onDelete('restrict')->onUpdate('restrict');

            $table->string('kode_design');
            $table->string('nama_design');

            $table->string('revisi');
            $table->date('refrensi_design');
            $table->date('tanggal_prediksi');
            $table->integer('prediksi_hari');
            $table->string('status');
            $table->string('size');
            $table->integer('lembar');
            $table->string('konfigurasi');
            $table->integer('id_draft');
            $table->integer('id_check');
            $table->integer('id_approve');
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
        Schema::dropIfExists('design');
    }
}
