<?php
namespace App\Exports;

use App\Models\DesignDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class designExportLog implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return DesignDetail::all();
    }

    public function headings(): array
    {
        return [
            'id_design_detail',
            'id_design',
            'kode_design',
            'id_design',
            'id_draft',
            'id_check',
            'id_approve',
            'revisi',
            'created_at',
        ];
    }

    public function map($row): array
    {
        // Sesuaikan dengan data yang ingin Anda ekspor
        return [
            $row->id_design_detail,
            $row->id_design,
            $row->kode_design,
            $row->design->nama_design,
            $row->revisi,
            $row->draft->name ?? '', // Menggunakan relasi draft
            $row->check->name ?? '', // Menggunakan relasi check
            $row->approve->name ?? '', // Menggunakan relasi approve
            $row->created_at,
        ];
    }
}