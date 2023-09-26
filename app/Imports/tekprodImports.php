<?php

namespace App\Imports;

use App\Models\Tekprod;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TekprodImports implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            return new Design([
                'id_kepala_gambar' => $row['id_kepala_gambar'],
                'id_proyek' => $row['id_proyek'],
                'kode_tekprod' => $row['kode_tekprod'],
                'nama_tekprod' => $row['nama_tekprod'],
                'revisi_tekprod' => $row['revisi_tekprod'],
                'rev_for_curva_tekprod' => $row['rev_for_curva_tekprod'],
                'pemilik_tekprod' => $row['pemilik_tekprod'],
                'jenis_tekprod' => $row['jenis_tekprod'],
                'id_refrensi_tekprod' => $row['id_refrensi_tekprod'],
                'refrensi_design_tekprod' => $row['refrensi_design_tekprod'],
                'tanggal_refrensi_tekprod' => $this->transformDate($row['tanggal_refrensi_tekprod']),
                'tanggal_prediksi_tekprod' => $this->transformDate($row['tanggal_prediksi_tekprod']),
                'tp_dd_tekprod' => $row['tp_dd_tekprod'],
                'tp_mm_tekprod' => $row['tp_mm_tekprod'],
                'tp_yy_tekprod' => $row['tp_yy_tekprod'],
                'prediksi_hari_tekprod' => $row['prediksi_hari_tekprod'],
                'prediksi_akhir_tekprod'  => $this->transformDate($row['prediksi_akhir_tekprod']),
                'pa_dd_tekprod' => $row['pa_dd_tekprod'],
                'pa_mm_tekprod' => $row['pa_mm_tekprod'],
                'pa_yy_tekprod' => $row['pa_yy_tekprod'],
                'bobot_rev_tekprod' => $row['bobot_rev_tekprod'],
                'bobot_design_tekprod' => $row['bobot_design_tekprod'],
                'status_tekprod' => $row['status_tekprod'],
                'duplicate_status_tekprod' => $row['duplicate_status_tekprod'],
                'prosentase_tekprod' => $row['prosentase_tekprod'],
                'size_tekprod' => $row['size_tekprod'],
                'lembar_tekprod' => $row['lembar_tekprod'],
                'tipe_tekprod' => $row['tipe_tekprod'],
                'konfigurasi_tekprod' => $row['konfigurasi_tekprod'],
                'id_draft_tekprod' => $row['id_draft_tekprod'],
                'id_check_tekprod' => $row['id_check_tekprod'],
                'id_approve_tekprod' => $row['id_approve_tekprod'],
                'time_release_rev0_tekprod'  => $this->transformDate($row['time_release_rev0_tekprod']),
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
