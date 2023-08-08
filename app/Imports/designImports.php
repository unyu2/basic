<?php

namespace App\Imports;

use App\Models\Design;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DesignImports implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            return new Design([
                'id_kepala_gambar' => $row['id_kepala_gambar'],
                'id_proyek' => $row['id_proyek'],
                'kode_design' => $row['kode_design'],
                'nama_design' => $row['nama_design'],
                'revisi' => $row['revisi'],
                'refrensi_design' => $row['refrensi_design'],
                'tanggal_refrensi' => $this->transformDate($row['tanggal_refrensi']),
                'tanggal_prediksi' => $this->transformDate($row['tanggal_prediksi']),
                'prediksi_hari' => $row['prediksi_hari'],
                'bobot_rev' => $row['bobot_rev'],
                'prediksi_akhir' => $row['prediksi_akhir'],
                'status' => $row['status'],
                'size' => $row['size'],
                'lembar' => $row['lembar'],
                'konfigurasi' => $row['konfigurasi'],
                'id_draft' => $row['id_draft'],
                'id_check' => $row['id_check'],
                'id_approve' => $row['id_approve'],
            ]);
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan konversi tanggal atau data lainnya
            return null;
        }
    }

    /**
     * Transform a date value into a Carbon object.
     *
     * @return \Carbon\Carbon|null
     */
    private function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return Carbon::instance(Date::excelToDateTimeObject($value))->format($format);
        } catch (\Exception $e) {
            // Jika konversi tanggal gagal, kembalikan null (kosong)
            return null;
        }
    }
}
