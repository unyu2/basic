<?php
namespace App\Exports;

use App\Models\Design;
use App\Models\User;
use App\Models\KepalaGambar;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class designExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Design::all();
    }

    public function headings(): array
    {
        return [
            'id_design',
            'id_kepala_gambar',
            'id_proyek',
            'kode_design',
            'nama_design',
            'revisi',
            'id_refrensi',
            'refrensi_design',
            'tanggal_refrensi',
            'tanggal_prediksi',
            'tp_dd',
            'tp_mm',
            'tp_yy',
            'prediksi_hari',
            'prediksi_akhir',
            'pa_dd',
            'pa_mm',
            'pa_yy',
            'bobot_rev',
            'bobot_design',
            'status',
            'prosentase',
            'size',
            'lembar',
            'konfigurasi',
            'id_draft',
            'id_check',
            'id_approve',
        ];
    }

    public function map($row): array
    {
        // Sesuaikan dengan data yang ingin Anda ekspor
        return [
            $row->id_design,
            $row->id_kepala_gambar,
            $row->proyek->nama_proyek,
            $row->kode_design,
            $row->nama_design,
            $row->pemilik,
            $row->revisi,
            $row->id_refrensi,
            $row->refrensi_design,
            $row->tanggal_refrensi,
            $row->tanggal_prediksi,
            $row->tp_dd,
            $row->tp_mm,
            $row->tp_yy,
            $row->prediksi_hari,
            $row->prediksi_akhir,
            $row->pa_dd,
            $row->pa_mm,
            $row->pa_yy,
            $row->bobot_rev,
            $row->bobot_design,
            $row->status,
            $row->prosentase,
            $row->size,
            $row->lembar,
            $row->konfigurasi,
            $row->draft->name ?? '', // Menggunakan relasi draft
            $row->check->name ?? '', // Menggunakan relasi check
            $row->approve->name ?? '', // Menggunakan relasi approve
        ];
    }
}