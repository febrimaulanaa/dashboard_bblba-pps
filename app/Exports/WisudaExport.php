<?php

namespace App\Exports;

use App\Models\Wisuda;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WisudaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID',
            'Kelompok',
            'No Urut Ijazah',
            'NIM',
            'Nama',
            'No Meja Ambil Ijazah',
            'Prodi',
        ];
    }

    public function collection()
    {
        return Wisuda::all();
    }
}
