<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepalaGambarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepala_gambar', function (Blueprint $table) {
            $table->increments('id_kepala_gambar');
            $table->unsignedInteger('id_jabatan');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan')->onDelete('restrict')->onUpdate('restrict');
            $table->string('nama');
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
        Schema::dropIfExists('kepala_gambar');
    }
}
