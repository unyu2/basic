<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubpengujianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subpengujian')->insert(
            [
                'id_subpengujian' => '4',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'P3 PERAWATAN - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '5',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'P1 PERAWATAN - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '6',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'P6 PERAWATAN - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '7',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'P12 PERAWATAN - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '8',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'DAILY CHECK - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '9',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'SARANA ON - LRT JABODEBEK ',
            ],
            [
                'id_subpengujian' => '10',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'SARANA OFF - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '11',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'INJECT KOMPONEN RUSAK - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '13',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'P3 PEMERIKSAAN - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '14',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'P1 PEMERIKSAAN - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '15',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'SPARE 1 - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '16',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'SPARE 2 - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '17',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'SPARE 3 - LRT JABODEBEK',
            ],
            [
                'id_subpengujian' => '18',
                'kode_subpengjian' => '0',
                'nama_subpengujian' => 'SPARE 4 - LRT JABODEBEK',
            ]
        );
    }
}
