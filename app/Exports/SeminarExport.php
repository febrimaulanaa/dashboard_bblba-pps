<?php

namespace App\Exports;

use App\Models\DataSertifSeminar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeminarExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'ID',
            'Masa',
            'Nama',
            'NIM',
            'Prodi',
        ];
    }

    public function collection()
    {
        return DataSertifSeminar::all();
    }
}
