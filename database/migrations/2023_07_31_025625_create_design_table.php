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

            $table->unsignedInteger('id_kepala_gambar')->nullable();
            $table->foreign('id_kepala_gambar')->references('id_kepala_gambar')->on('kepala_gambar')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('id_proyek')->nullable();
            $table->foreign('id_proyek')->references('id_proyek')->on('proyek')->onDelete('restrict')->onUpdate('restrict');

            $table->string('kode_design')->nullable();
            $table->string('nama_design')->nullable();

            $table->string('revisi')->nullable();
            $table->string('pemilik')->nullable();
            $table->string('jenis')->nullable();

            $table->integer('id_refrensi')->nullable();
            $table->string('refrensi_design')->nullable();
            $table->date('tanggal_refrensi')->nullable();

            $table->date('tanggal_prediksi')->nullable();
            $table->integer('tp_dd')->nullable();
            $table->integer('tp_mm')->nullable();
            $table->integer('tp_yy')->nullable();

            $table->integer('prediksi_hari')->nullable();
            $table->date('prediksi_akhir')->nullable();
            $table->integer('pa_dd')->nullable();
            $table->integer('pa_mm')->nullable();
            $table->integer('pa_yy')->nullable();

            $table->integer('bobot_rev')->nullable();

            $table->string('status')->nullable();
            $table->string('duplicate_status')->nullable();
            $table->integer('prosentase')->nullable();
            $table->string('size')->nullable();
            $table->integer('lembar')->nullable();

            $table->string('konfigurasi')->nullable();
            
            $table->integer('id_draft')->nullable();
            $table->integer('id_check')->nullable();
            $table->integer('id_approve')->nullable();
            
            $table->date('time_release_rev0')->nullable();

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
