<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emu', function (Blueprint $table) {
            $table->increments('id_emu');

            $table->unsignedInteger('id_dmu')->index();
            $table->foreign('id_dmu')->references('id_dmu')->on('dmu')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('id_subpengujian')->nullable()->index();
            $table->foreign('id_subpengujian')->references('id_subpengujian')->on('subpengujian')->onDelete('cascade')->onUpdate('restrict');
            $table->unsignedInteger('id_proyek')->nullable()->index();
            $table->foreign('id_proyek')->references('id_proyek')->on('proyek')->onDelete('cascade')->onUpdate('restrict');
            $table->string('nama_proyeks',180)->nullable();
            $table->unsignedBigInteger('id_user')->nullable()->index();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('restrict');
            $table->string('id_users')->nullable()->index();
            $table->string('id_car')->nullable()->index();

            $table->string('kode_emu',25)->index();
            $table->string('status',20)->nullable()->index();
            $table->string('keterangan',20)->nullable()->index();
            $table->string('Approved',20)->nullable()->index();
            $table->string('lanjut',10)->nullable()->index();
            $table->string('form',30)->nullable()->index();
            $table->string('ok',5)->nullable()->index();
            
            $table->integer('jam');
            $table->integer('t_operasi');
            $table->integer('revisi');

            $table->string('M1_1',6)->nullable();
            $table->string('M2_1',6)->nullable();
            $table->string('Mc1_1',6)->nullable();
            $table->string('Mc2_1',6)->nullable();
            $table->string('T1_1',6)->nullable();
            $table->string('T2_1',6)->nullable();
            $table->string('T3_1',6)->nullable();
            $table->string('T4_1',6)->nullable();
            $table->string('Tc1_1',6)->nullable();
            $table->string('Tc2_1',6)->nullable();
            $table->string('Tc3_1',6)->nullable();
            $table->string('Tc4_1',6)->nullable();
           
            $table->string('M1_2',6)->nullable();
            $table->string('M2_2',6)->nullable();
            $table->string('Mc1_2',6)->nullable();
            $table->string('Mc2_2',6)->nullable();
            $table->string('T1_2',6)->nullable();
            $table->string('T2_2',6)->nullable();
            $table->string('T3_2',6)->nullable();
            $table->string('T4_2',6)->nullable();
            $table->string('Tc1_2',6)->nullable();
            $table->string('Tc2_2',6)->nullable();
            $table->string('Tc3_2',6)->nullable();
            $table->string('Tc4_2',6)->nullable();
           
            $table->string('M1_3',6)->nullable();
            $table->string('M2_3',6)->nullable();
            $table->string('Mc1_3',6)->nullable();
            $table->string('Mc2_3',6)->nullable();
            $table->string('T1_3',6)->nullable();
            $table->string('T2_3',6)->nullable();
            $table->string('T3_3',6)->nullable();
            $table->string('T4_3',6)->nullable();
            $table->string('Tc1_3',6)->nullable();
            $table->string('Tc2_3',6)->nullable();
            $table->string('Tc3_3',6)->nullable();
            $table->string('Tc4_3',6)->nullable();
           
            $table->string('M1_4',6)->nullable();
            $table->string('M2_4',6)->nullable();
            $table->string('Mc1_4',6)->nullable();
            $table->string('Mc2_4',6)->nullable();
            $table->string('T1_4',6)->nullable();
            $table->string('T2_4',6)->nullable();
            $table->string('T3_4',6)->nullable();
            $table->string('T4_4',6)->nullable();
            $table->string('Tc1_4',6)->nullable();
            $table->string('Tc2_4',6)->nullable();
            $table->string('Tc3_4',6)->nullable();
            $table->string('Tc4_4',6)->nullable();
           
            $table->string('M1_5',6)->nullable();
            $table->string('M2_5',6)->nullable();
            $table->string('Mc1_5',6)->nullable();
            $table->string('Mc2_5',6)->nullable();
            $table->string('T1_5',6)->nullable();
            $table->string('T2_5',6)->nullable();
            $table->string('T3_5',6)->nullable();
            $table->string('T4_5',6)->nullable();
            $table->string('Tc1_5',6)->nullable();
            $table->string('Tc2_5',6)->nullable();
            $table->string('Tc3_5',6)->nullable();
            $table->string('Tc4_5',6)->nullable();
           
            $table->string('M1_6',6)->nullable();
            $table->string('M2_6',6)->nullable();
            $table->string('Mc1_6',6)->nullable();
            $table->string('Mc2_6',6)->nullable();
            $table->string('T1_6',6)->nullable();
            $table->string('T2_6',6)->nullable();
            $table->string('T3_6',6)->nullable();
            $table->string('T4_6',6)->nullable();
            $table->string('Tc1_6',6)->nullable();
            $table->string('Tc2_6',6)->nullable();
            $table->string('Tc3_6',6)->nullable();
            $table->string('Tc4_6',6)->nullable();
           
            $table->string('M1_7',6)->nullable();
            $table->string('M2_7',6)->nullable();
            $table->string('Mc1_7',6)->nullable();
            $table->string('Mc2_7',6)->nullable();
            $table->string('T1_7',6)->nullable();
            $table->string('T2_7',6)->nullable();
            $table->string('T3_7',6)->nullable();
            $table->string('T4_7',6)->nullable();
            $table->string('Tc1_7',6)->nullable();
            $table->string('Tc2_7',6)->nullable();
            $table->string('Tc3_7',6)->nullable();
            $table->string('Tc4_7',6)->nullable();
           
            $table->string('M1_8',6)->nullable();
            $table->string('M2_8',6)->nullable();
            $table->string('Mc1_8',6)->nullable();
            $table->string('Mc2_8',6)->nullable();
            $table->string('T1_8',6)->nullable();
            $table->string('T2_8',6)->nullable();
            $table->string('T3_8',6)->nullable();
            $table->string('T4_8',6)->nullable();
            $table->string('Tc1_8',6)->nullable();
            $table->string('Tc2_8',6)->nullable();
            $table->string('Tc3_8',6)->nullable();
            $table->string('Tc4_8',6)->nullable();
           
            $table->string('M1_9',6)->nullable();
            $table->string('M2_9',6)->nullable();
            $table->string('Mc1_9',6)->nullable();
            $table->string('Mc2_9',6)->nullable();
            $table->string('T1_9',6)->nullable();
            $table->string('T2_9',6)->nullable();
            $table->string('T3_9',6)->nullable();
            $table->string('T4_9',6)->nullable();
            $table->string('Tc1_9',6)->nullable();
            $table->string('Tc2_9',6)->nullable();
            $table->string('Tc3_9',6)->nullable();
            $table->string('Tc4_9',6)->nullable();
           
            $table->string('M1_10',6)->nullable();
            $table->string('M2_10',6)->nullable();
            $table->string('Mc1_10',6)->nullable();
            $table->string('Mc2_10',6)->nullable();
            $table->string('T1_10',6)->nullable();
            $table->string('T2_10',6)->nullable();
            $table->string('T3_10',6)->nullable();
            $table->string('T4_10',6)->nullable();
            $table->string('Tc1_10',6)->nullable();
            $table->string('Tc2_10',6)->nullable();
            $table->string('Tc3_10',6)->nullable();
            $table->string('Tc4_10',6)->nullable();
           
            $table->string('M1_11',6)->nullable();
            $table->string('M2_11',6)->nullable();
            $table->string('Mc1_11',6)->nullable();
            $table->string('Mc2_11',6)->nullable();
            $table->string('T1_11',6)->nullable();
            $table->string('T2_11',6)->nullable();
            $table->string('T3_11',6)->nullable();
            $table->string('T4_11',6)->nullable();
            $table->string('Tc1_11',6)->nullable();
            $table->string('Tc2_11',6)->nullable();
            $table->string('Tc3_11',6)->nullable();
            $table->string('Tc4_11',6)->nullable();
           
            $table->string('M1_12',6)->nullable();
            $table->string('M2_12',6)->nullable();
            $table->string('Mc1_12',6)->nullable();
            $table->string('Mc2_12',6)->nullable();
            $table->string('T1_12',6)->nullable();
            $table->string('T2_12',6)->nullable();
            $table->string('T3_12',6)->nullable();
            $table->string('T4_12',6)->nullable();
            $table->string('Tc1_12',6)->nullable();
            $table->string('Tc2_12',6)->nullable();
            $table->string('Tc3_12',6)->nullable();
            $table->string('Tc4_12',6)->nullable();
           
            $table->string('M1_13',6)->nullable();
            $table->string('M2_13',6)->nullable();
            $table->string('Mc1_13',6)->nullable();
            $table->string('Mc2_13',6)->nullable();
            $table->string('T1_13',6)->nullable();
            $table->string('T2_13',6)->nullable();
            $table->string('T3_13',6)->nullable();
            $table->string('T4_13',6)->nullable();
            $table->string('Tc1_13',6)->nullable();
            $table->string('Tc2_13',6)->nullable();
            $table->string('Tc3_13',6)->nullable();
            $table->string('Tc4_13',6)->nullable();
           
            $table->string('M1_14',6)->nullable();
            $table->string('M2_14',6)->nullable();
            $table->string('Mc1_14',6)->nullable();
            $table->string('Mc2_14',6)->nullable();
            $table->string('T1_14',6)->nullable();
            $table->string('T2_14',6)->nullable();
            $table->string('T3_14',6)->nullable();
            $table->string('T4_14',6)->nullable();
            $table->string('Tc1_14',6)->nullable();
            $table->string('Tc2_14',6)->nullable();
            $table->string('Tc3_14',6)->nullable();
            $table->string('Tc4_14',6)->nullable();

            $table->text('nama_dmu1')->nullable();
            $table->text('nama_dmu2')->nullable();
            $table->text('nama_dmu3')->nullable();
            $table->text('nama_dmu4')->nullable();
            $table->text('nama_dmu5')->nullable();
            $table->text('nama_dmu6')->nullable();
            $table->text('nama_dmu7')->nullable();
            $table->text('nama_dmu8')->nullable();
            $table->text('nama_dmu9')->nullable();
            $table->text('nama_dmu10')->nullable();
            $table->text('nama_dmu11')->nullable();
            $table->text('nama_dmu12')->nullable();
            $table->text('nama_dmu13')->nullable();
            $table->text('nama_dmu14')->nullable();

            $table->text('p1')->nullable();
            $table->text('p2')->nullable();
            $table->text('p3')->nullable();
            $table->text('p4')->nullable();
            $table->text('p5')->nullable();
            $table->text('p6')->nullable();
            $table->text('p7')->nullable();
            $table->text('p8')->nullable();
            $table->text('p9')->nullable();
            $table->text('p10')->nullable();
            $table->text('p11')->nullable();
            $table->text('p12')->nullable();
            $table->text('p13')->nullable();
            $table->text('p14')->nullable();

            $table->integer('total_item');
            $table->integer('total_harga');
            $table->tinyInteger('diskon')->default(0);
            $table->integer('bayar')->default(0);

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
        Schema::dropIfExists('emu');
    }
}
