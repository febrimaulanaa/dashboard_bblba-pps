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
                'nama' => $row[2],
                'nim' => $row[3],
                'prodi' => $row[4],
            ]);
        }
    }
}
