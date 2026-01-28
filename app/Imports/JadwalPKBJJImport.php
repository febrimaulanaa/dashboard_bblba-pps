<?php

namespace App\Imports;

use App\Models\JadwalPKBJJ;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class JadwalPKBJJImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $jdpkbjj = JadwalPKBJJ::create([
                'nim' => $row[1],
                'nama' => $row[2],
                'tanggal' => $row[3],
                'skema' => $row[4],
                'link_lok' => $row[5],
            ]);
        }
    }
}
