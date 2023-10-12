<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam', function (Blueprint $table) {
            $table->increments('id_pinjam');
            $table->integer('id_user')->nullable();
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_peminjam')->nullable();
            $table->foreign('id_peminjam')->references('id_user')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->string('fungsi');
            $table->string('kondisi');
            $table->integer('total_item')->nullable();
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
        Schema::dropIfExists('pinjam');
    }
}
