<?php
namespace App\Exports;

use App\Models\Tekprod;
use App\Models\Design;
use App\Models\User;
use App\Models\KepalaGambar;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class tekprodExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Design::all();
    }

    public function headings(): array
    {
        return [
            'id_tekprod',
            'id_kepala_gambar',
            'id_proyek',
            'kode_tekprod',
            'nama_tekprod',
            'revisi_tekprod',
            'id_refrensi_tekprod',
            'refrensi_design_tekprod',
            'tanggal_refrensi_tekprod',
            'tanggal_prediksi_tekprod',
            'tp_dd_tekprod',
            'tp_mm_tekprod',
            'tp_yy_tekprod',
            'prediksi_hari_tekprod',
            'prediksi_akhir_tekprod',
            'pa_dd_tekprod',
            'pa_mm_tekprod',
            'pa_yy_tekprod',
            'bobot_rev_tekprod',
            'bobot_design_tekprod',
            'status_tekprod',
            'prosentase_tekprod',
            'size_tekprod',
            'lembar_tekprod',
            'konfigurasi_tekprod',
            'id_draft_tekprod',
            'id_check_tekprod',
            'id_approve_tekprod',
        ];
    }

    public function map($row): array
    {
        // Sesuaikan dengan data yang ingin Anda ekspor
        return [
            $row->id_tekprod,
            $row->id_kepala_gambar,
            $row->proyek->nama_proyek,
            $row->kode_tekprod,
            $row->nama_tekprod,
            $row->pemilik_tekprod,
            $row->revisi_tekprod,
            $row->id_refrensi_tekprod,
            $row->refrensi_design_tekprod,
            $row->tanggal_refrensi_tekprod,
            $row->tanggal_prediksi_tekprod,
            $row->tp_dd_tekprod,
            $row->tp_mm_tekprod,
            $row->tp_yy_tekprod,
            $row->prediksi_hari_tekprod,
            $row->prediksi_akhir_tekprod,
            $row->pa_dd_tekprod,
            $row->pa_mm_tekprod,
            $row->pa_yy_tekprod,
            $row->bobot_rev_tekprod,
            $row->bobot_design_tekprod,
            $row->status_tekprod,
            $row->prosentase_tekprod,
            $row->size_tekprod,
            $row->lembar_tekprod,
            $row->konfigurasi_tekprod,
            $row->draft->name ?? '', // Menggunakan relasi draft
            $row->check->name ?? '', // Menggunakan relasi check
            $row->approve->name ?? '', // Menggunakan relasi approve
        ];
    }
}