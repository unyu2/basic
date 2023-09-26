<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTekprodDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tekprod_detail', function (Blueprint $table) {
            $table->increments('id_tekprod_detail');
            $table->unsignedInteger('id_tekprod');
            $table->foreign('id_tekprod')->references('id_tekprod')->on('tekprod')->onDelete('restrict')->onUpdate('restrict');

            $table->string('kode_tekprod');
            $table->string('revisi_tekprod');
            $table->string('status_tekprod');
            $table->string('prediksi_akhir_tekprod');

            $table->integer('id_draft_tekprod');
            $table->integer('id_check_tekprod');
            $table->integer('id_approve_tekprod');
            $table->string('jenis_tekprod');
            $table->string('pemilik_tekprod');

            $table->integer('bobot_rev_tekprod');
            $table->integer('bobot_design_tekprod');

            $table->integer('size_tekprod');
            $table->integer('lembar_tekprod');

            $table->float('tipe_tekprod');


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
        Schema::dropIfExists('design_detail');
    }
}
