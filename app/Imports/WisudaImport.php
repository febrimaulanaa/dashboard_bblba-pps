<?php

namespace App\Imports;

use App\Models\Wisuda;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class WisudaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $p = Wisuda::create([
                'kelompok' => $row[1],
                'no_urut_ijazah' => $row[2],
                'nim' => $row[3],
                'nama' => $row[4],
                'no_meja_ambil_ijazah' => $row[5],
                'prodi' => $row[6],
            ]);
        }
    }
}
