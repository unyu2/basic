<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsistemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsistem', function (Blueprint $table) {
            $table->increments('id_subsistem');
            $table->unsignedInteger('id_sistem');
            $table->foreign('id_sistem')->references('id_sistem')->on('sistem')->onDelete('restrict')->onUpdate('restrict');
            $table->string('kode_sistem')->unique();
            $table->string('nama_sistem')->unique();
            $table->integer('bobot');
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
        Schema::dropIfExists('subsistem');
    }
}
