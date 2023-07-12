<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubpengujianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subpengujian', function (Blueprint $table) {
            $table->increments('id_subpengujian');
            $table->string('kode_subpengujian')->index();
            $table->string('nama_subpengujian')->unique();
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
        Schema::dropIfExists('subpengujian');
    }
}
