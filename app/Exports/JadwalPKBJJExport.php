<?php

namespace App\Exports;

use App\Models\JadwalPKBJJ;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalPKBJJExport implements FromCollection, WithHeadings, \Maatwebsite\Excel\Concerns\WithMapping
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
            'Lokasi Detail',
            'Link Google Maps',
            'Created At',
            'Updated At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->nim,
            $row->nama,
            $row->nama_kegiatan,
            $row->tanggal,
            $row->waktu,
            $row->skema,
            $row->nomor_meja,
            $row->no_urut,
            $row->lokasi,
            $row->link_lok,
            $row->created_at,
            $row->updated_at,
        ];
    }

    public function collection()
    {
        return JadwalPKBJJ::all();
    }
}
