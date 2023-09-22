<?php

namespace App\Imports;

use App\Models\DesignDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DesignDetailImports implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            return new DesignDetail([
                'id_design' => $row['id_design'],
                'kode_design' => $row['kode_design'],
                'revisi' => $row['revisi'],
                'status' => $row['status'],
                'prediksi_akhir' => $this->transformDate($row['prediksi_akhir']),
                'id_draft' => $row['id_draft'],
                'id_check' => $row['id_check'],
                'id_aprove' => $row['id_aprove'],
                'jenis' => $row['jenis'],
                'pemilik' => $row['pemilik'],
                'bobot_rev' => $row['bobot_rev'],
                'bobot_design' => $row['bobot_design'],
                'size' => $row['size'],
                'lembar' => $row['lembar'],
                'tipe' => $row['tipe'],
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
