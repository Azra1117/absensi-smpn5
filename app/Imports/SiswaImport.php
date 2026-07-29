<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SiswaImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Database VII' => new DatabaseSheetImport(),
            'Database VIII' => new DatabaseSheetImport(),
            'Database IX' => new DatabaseSheetImport(),
        ];
    }
}
