<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmu', function (Blueprint $table) {
            $table->increments('id_dmu');
            $table->unsignedInteger('id_subpengujian');
            $table->foreign('id_subpengujian')->references('id_subpengujian')->on('subpengujian')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('id_proyek')->index()->nullable();
            $table->foreign('id_proyek')->references('id_proyek')->on('proyek')->onDelete('restrict')->onUpdate('restrict');
            $table->string('kode_dmu',55)->unique()->nullable();
            $table->string('nama_dmu',150)->unique()->nullable();
            $table->string('revisi',10)->index()->nullable();
            $table->string('status',12)->index()->nullable();

            $table->string('foto1')->nullable();
            $table->string('foto2')->nullable();
            $table->string('foto3')->nullable();
            $table->string('foto4')->nullable();
            $table->string('foto5')->nullable();
            $table->string('foto6')->nullable();
            $table->string('foto7')->nullable();
            $table->string('foto8')->nullable();
            $table->string('foto9')->nullable();
            $table->string('foto10')->nullable();
            $table->string('foto11')->nullable();
            $table->string('foto12')->nullable();
            $table->string('foto13')->nullable();
            $table->string('foto14')->nullable();

            $table->text('nama_dmu1')->nullable();
            $table->text('metode1',230)->nullable();
            $table->text('standar1',230)->nullable();
            $table->string('lokasi1',70)->nullable();
            $table->string('a1',6)->nullable();
            $table->string('a2',6)->nullable();
            $table->string('a3',6)->nullable();
            $table->string('a4',6)->nullable();
            $table->string('a5',6)->nullable();
            $table->string('a6',6)->nullable();
            $table->string('a7',6)->nullable();
            $table->string('a8',6)->nullable();
            $table->string('a9',6)->nullable();
            $table->string('a10',6)->nullable();
            $table->string('a11',6)->nullable();
            $table->string('a12',6)->nullable();

            $table->text('nama_dmu2')->nullable();
            $table->text('metode2',230)->nullable();
            $table->text('standar2',230)->nullable();
            $table->string('lokasi2',70)->nullable();
            $table->string('b1',6)->nullable();
            $table->string('b2',6)->nullable();
            $table->string('b3',6)->nullable();
            $table->string('b4',6)->nullable();
            $table->string('b5',6)->nullable();
            $table->string('b6',6)->nullable();
            $table->string('b7',6)->nullable();
            $table->string('b8',6)->nullable();
            $table->string('b9',6)->nullable();
            $table->string('b10',6)->nullable();
            $table->string('b11',6)->nullable();
            $table->string('b12',6)->nullable();

            $table->text('nama_dmu3')->nullable();
            $table->text('metode3',230)->nullable();
            $table->text('standar3',230)->nullable();
            $table->string('lokasi3',70)->nullable();
            $table->string('c1',6)->nullable();
            $table->string('c2',6)->nullable();
            $table->string('c3',6)->nullable();
            $table->string('c4',6)->nullable();
            $table->string('c5',6)->nullable();
            $table->string('c6',6)->nullable();
            $table->string('c7',6)->nullable();
            $table->string('c8',6)->nullable();
            $table->string('c9',6)->nullable();
            $table->string('c10',6)->nullable();
            $table->string('c11',6)->nullable();
            $table->string('c12',6)->nullable();
            
            $table->text('nama_dmu4')->nullable();
            $table->text('metode4',230)->nullable();
            $table->text('standar4',230)->nullable();
            $table->string('lokasi4',70)->nullable();
            $table->string('d1',6)->nullable();
            $table->string('d2',6)->nullable();
            $table->string('d3',6)->nullable();
            $table->string('d4',6)->nullable();
            $table->string('d5',6)->nullable();
            $table->string('d6',6)->nullable();
            $table->string('d7',6)->nullable();
            $table->string('d8',6)->nullable();
            $table->string('d9',6)->nullable();
            $table->string('d10',6)->nullable();
            $table->string('d11',6)->nullable();
            $table->string('d12',6)->nullable();

            $table->text('nama_dmu5')->nullable();
            $table->text('metode5',230)->nullable();
            $table->text('standar5',230)->nullable();
            $table->string('lokasi5',70)->nullable();
            $table->string('e1',6)->nullable();
            $table->string('e2',6)->nullable();
            $table->string('e3',6)->nullable();
            $table->string('e4',6)->nullable();
            $table->string('e5',6)->nullable();
            $table->string('e6',6)->nullable();
            $table->string('e7',6)->nullable();
            $table->string('e8',6)->nullable();
            $table->string('e9',6)->nullable();
            $table->string('e10',6)->nullable();
            $table->string('e11',6)->nullable();
            $table->string('e12',6)->nullable();

            $table->text('nama_dmu6')->nullable();
            $table->text('metode6',230)->nullable();
            $table->text('standar6',230)->nullable();
            $table->string('lokasi6',70)->nullable();
            $table->string('f1',6)->nullable();
            $table->string('f2',6)->nullable();
            $table->string('f3',6)->nullable();
            $table->string('f4',6)->nullable();
            $table->string('f5',6)->nullable();
            $table->string('f6',6)->nullable();
            $table->string('f7',6)->nullable();
            $table->string('f8',6)->nullable();
            $table->string('f9',6)->nullable();
            $table->string('f10',6)->nullable();
            $table->string('f11',6)->nullable();
            $table->string('f12',6)->nullable();

            $table->text('nama_dmu7')->nullable();
            $table->text('metode7',230)->nullable();
            $table->text('standar7',230)->nullable();
            $table->string('lokasi7',70)->nullable();
            $table->string('g1',6)->nullable();
            $table->string('g2',6)->nullable();
            $table->string('g3',6)->nullable();
            $table->string('g4',6)->nullable();
            $table->string('g5',6)->nullable();
            $table->string('g6',6)->nullable();
            $table->string('g7',6)->nullable();
            $table->string('g8',6)->nullable();
            $table->string('g9',6)->nullable();
            $table->string('g10',6)->nullable();
            $table->string('g11',6)->nullable();
            $table->string('g12',6)->nullable();

            $table->text('nama_dmu8')->nullable();
            $table->text('metode8',230)->nullable();
            $table->text('standar8',230)->nullable();
            $table->string('lokasi8',70)->nullable();
            $table->string('h1',6)->nullable();
            $table->string('h2',6)->nullable();
            $table->string('h3',6)->nullable();
            $table->string('h4',6)->nullable();
            $table->string('h5',6)->nullable();
            $table->string('h6',6)->nullable();
            $table->string('h7',6)->nullable();
            $table->string('h8',6)->nullable();
            $table->string('h9',6)->nullable();
            $table->string('h10',6)->nullable();
            $table->string('h11',6)->nullable();
            $table->string('h12',6)->nullable();

            $table->text('nama_dmu9')->nullable();
            $table->text('metode9',230)->nullable();
            $table->text('standar9',230)->nullable();
            $table->string('lokasi9',70)->nullable();
            $table->string('i1',6)->nullable();
            $table->string('i2',6)->nullable();
            $table->string('i3',6)->nullable();
            $table->string('i4',6)->nullable();
            $table->string('i5',6)->nullable();
            $table->string('i6',6)->nullable();
            $table->string('i7',6)->nullable();
            $table->string('i8',6)->nullable();
            $table->string('i9',6)->nullable();
            $table->string('i10',6)->nullable();
            $table->string('i11',6)->nullable();
            $table->string('i12',6)->nullable();

            $table->text('nama_dmu10')->nullable();
            $table->text('metode10',230)->nullable();
            $table->text('standar10',230)->nullable();
            $table->string('lokasi10',70)->nullable();
            $table->string('j1',8)->nullable();
            $table->string('j2',8)->nullable();
            $table->string('j3',8)->nullable();
            $table->string('j4',8)->nullable();
            $table->string('j5',8)->nullable();
            $table->string('j6',8)->nullable();
            $table->string('j7',8)->nullable();
            $table->string('j8',8)->nullable();
            $table->string('j9',8)->nullable();
            $table->string('j10',8)->nullable();
            $table->string('j11',8)->nullable();
            $table->string('j12',8)->nullable();

            $table->text('nama_dmu11')->nullable();
            $table->text('metode11',230)->nullable();
            $table->text('standar11',230)->nullable();
            $table->string('lokasi11',70)->nullable();
            $table->string('k1',8)->nullable();
            $table->string('k2',8)->nullable();
            $table->string('k3',8)->nullable();
            $table->string('k4',8)->nullable();
            $table->string('k5',8)->nullable();
            $table->string('k6',8)->nullable();
            $table->string('k7',8)->nullable();
            $table->string('k8',8)->nullable();
            $table->string('k9',8)->nullable();
            $table->string('k10',8)->nullable();
            $table->string('k11',8)->nullable();
            $table->string('k12',8)->nullable();

            $table->text('nama_dmu12')->nullable();
            $table->text('metode12',230)->nullable();
            $table->text('standar12',230)->nullable();
            $table->string('lokasi12',70)->nullable();
            $table->string('l1',8)->nullable();
            $table->string('l2',8)->nullable();
            $table->string('l3',8)->nullable();
            $table->string('l4',8)->nullable();
            $table->string('l5',8)->nullable();
            $table->string('l6',8)->nullable();
            $table->string('l7',8)->nullable();
            $table->string('l8',8)->nullable();
            $table->string('l9',8)->nullable();
            $table->string('l10',8)->nullable();
            $table->string('l11',8)->nullable();
            $table->string('l12',8)->nullable();

            $table->text('nama_dmu13')->nullable();
            $table->text('metode13',230)->nullable();
            $table->text('standar13',230)->nullable();
            $table->string('lokasi13',70)->nullable();
            $table->string('m1',8)->nullable();
            $table->string('m2',8)->nullable();
            $table->string('m3',8)->nullable();
            $table->string('m4',8)->nullable();
            $table->string('m5',8)->nullable();
            $table->string('m6',8)->nullable();
            $table->string('m7',8)->nullable();
            $table->string('m8',8)->nullable();
            $table->string('m9',8)->nullable();
            $table->string('m10',8)->nullable();
            $table->string('m11',8)->nullable();
            $table->string('m12',8)->nullable();

            $table->text('nama_dmu14')->nullable();
            $table->text('metode14',230)->nullable();
            $table->text('standar14',230)->nullable();
            $table->string('lokasi14',70)->nullable();
            $table->string('n1',8)->nullable();
            $table->string('n2',8)->nullable();
            $table->string('n3',8)->nullable();
            $table->string('n4',8)->nullable();
            $table->string('n5',8)->nullable();
            $table->string('n6',8)->nullable();
            $table->string('n7',8)->nullable();
            $table->string('n8',8)->nullable();
            $table->string('n9',8)->nullable();
            $table->string('n10',8)->nullable();
            $table->string('n11',8)->nullable();
            $table->string('n12',8)->nullable(); 

            $table->integer('harga_beli')->length(11)->default(0);
            $table->integer('jumlah')->length(11)->nullable();
            $table->integer('stock')->length(11)->nullable();
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
        Schema::dropIfExists('dmu');
    }
}
