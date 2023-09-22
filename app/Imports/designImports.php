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
                'rev_for_curva' => $row['rev_for_curva'],
                'pemilik' => $row['pemilik'],
                'jenis' => $row['jenis'],
                'id_refrensi' => $row['id_refrensi'],
                'refrensi_design' => $row['refrensi_design'],
                'tanggal_refrensi' => $this->transformDate($row['tanggal_refrensi']),
                'tanggal_prediksi' => $this->transformDate($row['tanggal_prediksi']),
                'tp_dd' => $row['tp_dd'],
                'tp_mm' => $row['tp_mm'],
                'tp_yy' => $row['tp_yy'],
                'prediksi_hari' => $row['prediksi_hari'],
                'prediksi_akhir'  => $this->transformDate($row['prediksi_akhir']),
                'pa_dd' => $row['pa_dd'],
                'pa_mm' => $row['pa_mm'],
                'pa_yy' => $row['pa_yy'],
                'bobot_rev' => $row['bobot_rev'],
                'bobot_design' => $row['bobot_design'],
                'status' => $row['status'],
                'duplicate_status' => $row['duplicate_status'],
                'prosentase' => $row['prosentase'],
                'size' => $row['size'],
                'lembar' => $row['lembar'],
                'tipe' => $row['tipe'],
                'konfigurasi' => $row['konfigurasi'],
                'id_draft' => $row['id_draft'],
                'id_check' => $row['id_check'],
                'id_approve' => $row['id_approve'],
                'time_release_rev0'  => $this->transformDate($row['time_release_rev0']),
            ]);
        } catch (\Exception $e) {
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
            return null;
        }
    }
}
