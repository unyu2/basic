<?php

namespace App\Imports;

use App\Models\TekprodDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TekprodDetailImports implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            return new TekprodDetail([
                'id_tekprod' => $row['id_tekprod'],
                'kode_tekprod' => $row['kode_tekprod'],
                'revisi_tekprod' => $row['revisi_tekprod'],
                'status_tekprod' => $row['status_tekprod'],
                'prediksi_akhir_tekprod' => $this->transformDate($row['prediksi_akhir_tekprod']),
                'id_draft_tekprod' => $row['id_draft_tekprod'],
                'id_check_tekprod' => $row['id_check_tekprod'],
                'id_approve_tekprod' => $row['id_approve_tekprod'],
                'jenis_tekprod' => $row['jenis_tekprod'],
                'pemilik_tekprod' => $row['pemilik_tekprod'],
                'bobot_rev_tekprod' => $row['bobot_rev_tekprod'],
                'bobot_design_tekprod' => $row['bobot_design_tekprod'],
                'size_tekprod' => $row['size_tekprod'],
                'lembar_tekprod' => $row['lembar_tekprod'],
                'tipe_tekprod' => $row['tipe_tekprod'],
                'created_at' => $this->transformDate($row['created_at']),
                'updated_at' => $this->transformDate($row['updated_at']),
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
