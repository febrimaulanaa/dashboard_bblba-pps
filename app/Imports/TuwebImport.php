<?php

namespace App\Imports;

use App\Models\JadwalTuweb;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TuwebImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $p = JadwalTuweb::create([
                'masa' => $row[1],
                'nim' => $row[2],
                'nama_mhs' => $row[3],
                'nama_tutor' => $row[4],
                'kode_matkul' => $row[5],
                'nama_matkul' => $row[6],
                'link_tuweb' => $row[7],
                'lokasi' => $row[8],
                'jam' => $row[9],
                'hari' => $row[10],
                'tanggal_mulai' => $row[11],
                'tanggal_selesai' => $row[12],
                'keterangan' => $row[13],
            ]);
        }
    }
}
