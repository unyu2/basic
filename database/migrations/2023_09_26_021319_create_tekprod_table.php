<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTekprodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tekprod', function (Blueprint $table) {
            $table->increments('id_tekprod');

            $table->unsignedInteger('id_design')->nullable();
            $table->foreign('id_design')->references('id_design')->on('design')->onDelete('cascade')->onUpdate('restrict');
            $table->unsignedInteger('id_proyek')->nullable();
            $table->foreign('id_proyek')->references('id_proyek')->on('proyek')->onDelete('cascade')->onUpdate('restrict');

            $table->string('kode_tekprod')->nullable();
            $table->string('nama_tekprod')->nullable();

            $table->string('revisi_tekprod')->nullable();
            $table->string('rev_for_curva_tekprod')->nullable();
            $table->string('pemilik_tekprod')->nullable();
            $table->string('jenis_tekprod')->nullable();

            $table->integer('id_refrensi_tekprod')->nullable();
            $table->string('refrensi_design_tekprod')->nullable();
            $table->date('tanggal_refrensi_tekprod')->nullable();

            $table->date('tanggal_prediksi_tekprod')->nullable();
            $table->integer('tp_dd_tekprod')->nullable();
            $table->integer('tp_mm_tekprod')->nullable();
            $table->integer('tp_yy_tekprod')->nullable();

            $table->integer('prediksi_hari_tekprod')->nullable();
            $table->date('prediksi_akhir_tekprod')->nullable();
            $table->integer('pa_dd_tekprod')->nullable();
            $table->integer('pa_mm_tekprod')->nullable();
            $table->integer('pa_yy_tekprod')->nullable();

            $table->integer('bobot_rev_tekprod')->nullable();
            $table->integer('bobot_design_tekprod')->nullable();

            $table->string('status_tekprod')->nullable();
            $table->string('duplicate_status_tekprod')->nullable();
            $table->integer('prosentase_tekprod')->nullable();
            $table->string('size_tekprod')->nullable();
            $table->integer('lembar_tekprod')->nullable();

            $table->float('tipe_tekprod')->nullable();

            $table->string('konfigurasi_tekprod')->nullable();
            
            $table->integer('id_draft_tekprod')->nullable();
            $table->integer('id_check_tekprod')->nullable();
            $table->integer('id_approve_tekprod')->nullable();
            
            $table->date('time_release_rev0_tekprod')->nullable();

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
