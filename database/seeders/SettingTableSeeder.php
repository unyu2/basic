<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            'id_setting' => 1,
            'nama_perusahaan' => 'PMO SYSTEM',
            'alamat' => 'Jl. Yos Sudarso Madiun',
            'telepon' => '081234779987',
            'tipe_nota' => 2,
            'diskon' => 0,
            'path_logo' => '/img/logo.png',
            'path_logo2' => '/img/logo2.png',
            'path_kartu_member' => '/img/member.png',
        ]);
    }
}
