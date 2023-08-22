<?php

namespace App\Observers;

use App\Models\Design;

class DesignObserver
{
    public function updating(Design $design)
    {
        // Cek apakah kolom refrensi_design berubah
        if ($design->isDirty('refrensi_design')) {
            $refrensiDesignBaru = Design::where('kode_design', $design->refrensi_design)->first();
            
            // Jika desain referensi baru ditemukan, perbarui tanggal_refrensi dan prediksi_akhir pada semua desain yang memiliki refrensi_design ini
            if ($refrensiDesignBaru) {
                $tanggalRefrensiBaru = $refrensiDesignBaru->tanggal_prediksi;
                $designsToUpdate = Design::where('refrensi_design', $design->kode_design)->get();

                foreach ($designsToUpdate as $designToUpdate) {
                    $designToUpdate->tanggal_refrensi = $tanggalRefrensiBaru;
                    $designToUpdate->prediksi_akhir = date('Y-m-d', strtotime($tanggalRefrensiBaru . ' + ' . $designToUpdate->prediksi_hari . ' days'));
                    $designToUpdate->save();
                }
            }
        }
    }
}


