<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemintaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->increments('id_permintaan');
            $table->unsignedInteger('id_proyek');
            $table->foreign('id_proyek')->references('id_proyek')->on('proyek')->onDelete('restrict')->onUpdate('restrict');
            $table->string('memo')->nullable()->index();
            $table->string('nama_proyeks')->nullable();
            $table->integer('id_user')->index();
            $table->integer('total_item')->nullable();
            $table->integer('total_harga')->nullable();
            $table->tinyInteger('diskon')->default(0);
            $table->integer('bayar')->nullable();
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
        Schema::dropIfExists('pemintaan');
    }
}
