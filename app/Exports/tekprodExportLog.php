<?php
namespace App\Exports;

use App\Models\TekprodDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class tekprodExportLog implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return TekprodDetail::all();
    }

    public function headings(): array
    {
        return [
            'id_tekprod_detail',
            'id_tekprod',
            'kode_tekprod',
            'id_tekprod',
            'id_draft_tekprod',
            'id_check_tekprod',
            'id_approve_tekprod',
            'revisi_tekprod',
            'created_at',
        ];
    }

    public function map($row): array
    {
        // Sesuaikan dengan data yang ingin Anda ekspor
        return [
            $row->id_tekprod_detail,
            $row->id_tekprod,
            $row->kode_tekprod,
            $row->tekprod->nama_tekprod,
            $row->revisi_tekprod,
            $row->draft->name ?? '', // Menggunakan relasi draft
            $row->check->name ?? '', // Menggunakan relasi check
            $row->approve->name ?? '', // Menggunakan relasi approve
            $row->created_at,
        ];
    }
}