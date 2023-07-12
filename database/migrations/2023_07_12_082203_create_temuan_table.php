<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temuan', function (Blueprint $table) {
            $table->increments('id_temuan');

            $table->unsignedInteger('id_proyek')->nullable();
            $table->foreign('id_proyek')->references('id_proyek')->on('proyek')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('id_users')->nullable();
            $table->foreign('id_users')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('id_produk')->nullable();
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('id_car')->nullable();
            $table->foreign('id_car')->references('id_car')->on('car')->onDelete('restrict')->onUpdate('restrict');
            $table->string('nama_proyeks')->nullable();
            $table->string('kode_emu')->nullable();
            $table->string('ncr',25)->nullable()->index();

            $table->string('status',25)->index();
            $table->string('kode_temuan',25)->nullable();
            $table->text('nama_temuan');
            $table->string('Jenis',25)->nullable();
            $table->text('penyebab')->nullable();
            $table->text('akibat1')->nullable();
            $table->text('akibat2')->nullable();
            $table->text('akibat3')->nullable();
            $table->string('nilai',10)->nullable();
            $table->text('penyelesaian')->nullable();
            $table->text('saran')->nullable();
            $table->integer('dampak')->nullable();
            $table->integer('frekuensi')->nullable();
            $table->integer('pantau')->nullable();
            $table->string('operasi',7)->nullable();
            $table->string('level',15)->nullable();
            $table->string('car',11)->nullable()->index();
            $table->string('subsistem',50)->nullable()->index();
            $table->string('bagian',30)->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('aksi',30)->nullable();
            $table->string('nama_produks',100)->nullable();
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
        Schema::dropIfExists('temuan');
    }
}
