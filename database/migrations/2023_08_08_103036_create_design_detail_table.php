<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_detail', function (Blueprint $table) {
            $table->increments('id_design_detail');
            $table->unsignedInteger('id_design');
            $table->foreign('id_design')->references('id_design')->on('design')->onDelete('cascade')->onUpdate('restrict');

            $table->string('kode_design');
            $table->string('revisi');
            $table->string('status');
            $table->string('prediksi_akhir');

            $table->integer('id_draft');
            $table->integer('id_check');
            $table->integer('id_approve');
            $table->string('jenis');
            $table->string('pemilik');

            $table->integer('bobot_rev');
            $table->integer('bobot_design');

            $table->integer('size');
            $table->integer('lembar');

            $table->float('tipe');


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
