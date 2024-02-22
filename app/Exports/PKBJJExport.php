<?php

namespace App\Exports;

use App\Models\DataSertifMhs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PKBJJExport implements FromCollection, WithHeadings
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
        return DataSertifMhs::all();
    }
}
