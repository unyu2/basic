<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('level')->insert([
            [
                'id_level' => '2',
                'nama_level' => 'Staff Tekno',
            ],
            [
                'id_level' => '3',
                'nama_level' => 'Manager Tekno',
            ],
            [
                'id_level' => '4',
                'nama_level' => 'Senior Manager Tekno',
            ],
            [
                'id_level' => '5',
                'nama_level' => 'Eksekutif',
            ],
            [
                'id_level' => '6',
                'nama_level' => 'External Outsourche',
            ],
            [
                'id_level' => '7',
                'nama_level' => 'Pengadaan',
            ],
            [
                'id_level' => '8',
                'nama_level' => 'Supervisor QaQc',
            ],
            [
                'id_level' => '9',
                'nama_level' => 'Staff IMS',
            ],
            [
                'id_level' => '10',
                'nama_level' => 'Manager IMS',
            ],
            [
                'id_level' => '11',
                'nama_level' => 'Staff QaQc',
            ],
            [
                'id_level' => '12',
                'nama_level' => 'Manager QaQc',
            ],
            [
                'id_level' => '13',
                'nama_level' => 'Spesialis Tekno',
            ],
            [
                'id_level' => '14',
                'nama_level' => 'Supervisor Tekno',
            ],
        ]);
    }
}
