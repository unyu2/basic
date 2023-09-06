<?php
namespace App\Exports;

use App\Models\User;
use App\Models\Level;
use App\Models\Jabatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class userExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'nip',
            'name',
            'email',
            'level',
            'bagian',
            'status_karyawan',
            'kompetensi',
            'training',
            'sertifikasi',
        ];
    }

    public function map($row): array
    {
        // Sesuaikan dengan data yang ingin Anda ekspor
        return [
            $row->id,
            $row->nip,
            $row->name,
            $row->email,
            $row->level,
            $row->bagian,
            $row->status_karyawan,
            $row->kompetensi,
            $row->training,
            $row->sertifikasi,
        ];
    }
}