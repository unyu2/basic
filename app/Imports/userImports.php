<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UserImports implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            return new KepalaGambar([
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'email_verified_at' => $this->transformDate($row['email_verified_at']),
                'password' => $row['password'],
                'level' => $row['level'],
                'nip' => $row['nip'],
                'bagian' => $row['bagian'],
                'status_karyawan' => $row['status_karyawan'],
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
