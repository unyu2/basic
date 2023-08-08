<?php
namespace App\Exports;

use App\Models\Dmu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DataExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Dmu::all();
    }

    public function headings(): array
    {
        // Sesuaikan dengan kolom yang ingin Anda ekspor
        return [
            'Column 1',
            'Column 2',
            'Column 3',
            // Dan seterusnya
        ];
    }

    public function map($row): array
    {
        // Sesuaikan dengan data yang ingin Anda ekspor
        return [
            $row->column1,
            $row->column2,
            $row->column3,
            // Dan seterusnya
        ];
    }
}
