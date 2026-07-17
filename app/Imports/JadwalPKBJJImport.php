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
            // Skip empty rows (if NIM is empty)
            if (empty($row[1])) {
                continue;
            }
            $jdpkbjj = JadwalPKBJJ::create([
                'nim' => $row[1] ?? null,
                'nama' => $row[2] ?? null,
                'tanggal' => $row[3] ?? null,
                'waktu' => $row[4] ?? null,
                'skema' => $row[5] ?? null,
                'nomor_meja' => $row[6] ?? null,
                'no_urut' => $row[7] ?? null,
                'link_lok' => $row[8] ?? null,
            ]);
        }
    }
}
