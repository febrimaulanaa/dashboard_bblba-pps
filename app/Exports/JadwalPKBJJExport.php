<?php

namespace App\Exports;

use App\Models\JadwalPKBJJ;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalPKBJJExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'ID',
            'NIM',
            'Nama',
            'Nama Kegiatan',
            'Tanggal',
            'Waktu',
            'Skema',
            'Nomor Meja',
            'No Urut',
            'Link/Lokasi',
            'Created At',
            'Updated At',
        ];
    }

    public function collection()
    {
        return JadwalPKBJJ::all();
    }
}
