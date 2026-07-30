<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapBulananExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = collect($data);
    }

    public function collection(): Collection
    {
        return $this->data->map(function ($row) {
            return [
                $row['kelas'],
                $row['total'],
                $row['hari_efektif'],
                $row['total_kehadiran'],
                $row['hadir'],
                $row['izin'],
                $row['sakit'],
                $row['alpha'],
                $row['persentase'].'%',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kelas',
            'Total Siswa',
            'Hari Efektif',
            'Total Kehadiran',
            'Hadir',
            'Izin',
            'Sakit',
            'Alpha',
            'Persentase',
        ];
    }
}