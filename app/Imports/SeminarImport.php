<?php

namespace App\Imports;

use App\Models\DataSertifSeminar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SeminarImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $p = DataSertifSeminar::create([
                'masa' => $row[1],
                'nama' => $row[2],
                'nim' => $row[3],
                'prodi' => $row[4],
            ]);
        }
    }
}
