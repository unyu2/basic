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
            'kode_design',
            'nama_design',
            'revisi',
            'created_at',
        ];
    }

    public function map($row): array
    {
        // Sesuaikan dengan data yang ingin Anda ekspor
        return [
            $row->kode_design,
            $row->nama_design,
            $row->revisi,
            $row->created_at,
        ];
    }
}