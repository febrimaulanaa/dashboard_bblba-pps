<?php

namespace App\Imports;

use App\Models\DataSertifMhs;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PKBJJImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $p = DataSertifMhs::create([
                'masa' => $row[1],
                'email' => $row[2],
                'nama' => $row[3],
                'nim' => $row[4],
                'prodi' => $row[5],
                'kelompok' => $row[6],
            ]);
        }
    }
}
