<?php

namespace App\Imports;

use App\Models\Temuan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class temuanImports implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            return new Temuan([
                'id_proyek' => $row['id_proyek'],
                'id_user' => $row['id_user'], //pembuat
                'id_users' => $row['id_users'], //manager
                'id_produk' => $row['id_produk'],
                'id_car' => $row['id_car'],
                'subsistem' => $row['subsistem'],
                'nama_proyeks' => $row['nama_proyeks'],
                'nama_produks' => $row['nama_produks'],
                'kode_emu' => $row['kode_emu'], //kode dari schecksheet
                'ncr' => $row['ncr'], //kode ncr
                'status' => $row['status'],
                'kode_temuan' => $row['kode_temuan'], // lihat kode terakhir pada data
                'nama_temuan' => $row['nama_temuan'],
                'jenis' => $row['jenis'], //lepas / kendor // dst
                'penyebab' => $row['penyebab'],
                'akibat1' => $row['akibat1'],
                'akibat2' => $row['akibat2'],
                'akibat3' => $row['akibat3'],
                'nilai' => $row['nilai'], // nilai RPN // hasil perkalian dampak*frekuensi*pantau
                'penyelesaian' => $row['penyelesaian'],
                'saran' => $row['saran'],
                'dampak' => $row['dampak'], //nilai dampak
                'frekuensi' => $row['frekuensi'], //nilai frekuensi
                'pantau' => $row['pantau'], // nilai keterpantauan
                'operasi' => $row['operasi'],
                'level' => $row['level'], //isi low, medium, high
                'car' => $row['car'], //berisi nama car mc1, mc2 dst
                'bagian' => $row['bagian'], //
                'jumlah' => $row['jumlah'], //
                'aksi' => $row['aksi'], // perbaikan / pengadaan / pengadaan & perbaikan
                'created_at' => $this->transformDate($row['created_at']),
                'updated_at' => $this->transformDate($row['updated_at']),
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
    private function transformDate($value, $format = 'd-m-y')
    {
        try {
            return Carbon::instance(Date::excelToDateTimeObject($value))->format($format);
        } catch (\Exception $e) {
            // Jika konversi tanggal gagal, kembalikan null (kosong)
            return null;
        }
    }

}
