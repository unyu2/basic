<?php
namespace App\Exports;

use App\Models\Design;
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
            'id_proyek',
            'kode_design',
            'nama_design',
            'konfigurasi',
            'revisi',
            'status',
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
            $row->proyek->nama_proyek,
            $row->kode_design,
            $row->nama_design,
            $row->konfigurasi,
            $row->revisi,
            $row->status,
            $row->draft->name ?? '', // Menggunakan relasi draft
            $row->check->name ?? '', // Menggunakan relasi check
            $row->approve->name ?? '', // Menggunakan relasi approve
        ];
    }
}