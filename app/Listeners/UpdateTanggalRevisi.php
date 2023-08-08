<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTanggalRevisi
{
    public function handle(DesignUpdated $event)
    {
        // Ambil tanggal revisi dari event
        $tanggalRevisi = $event->tanggalRevisi;

        // Simpan tanggal revisi ke dalam model Design sesuai dengan revisi yang ada
        switch ($event->design->revisi) {
            case 'Rev.0':
                $event->design->tanggal_0 = $tanggalRevisi;
                break;
            case 'Rev.A':
                $event->design->tanggal_A = $tanggalRevisi;
                break;
            case 'Rev.B':
                $event->design->tanggal_B = $tanggalRevisi;
                break;
            // Tambahkan kasus lain jika diperlukan
        }

        // Simpan perubahan ke dalam database
        $event->design->save();
    }
}
