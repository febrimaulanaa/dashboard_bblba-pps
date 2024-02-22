<?php

namespace App\Imports;

use App\Models\DataSertifWTKU;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class WTKUImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $p = DataSertifWTKU::create([
                'masa' => $row[1],
                'nama' => $row[2],
                'nim' => $row[3],
                'prodi' => $row[4],
            ]);
        }
    }
}
