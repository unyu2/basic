<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('foto')
                  ->nullable()
                  ->after('password');
            $table->string('level')
                  ->default(2)
                  ->after('foto');
            $table->string('nip')
                  ->nullable()
                  ->after('level');
            $table->string('bagian')
                  ->nullable()
                  ->after('nip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
