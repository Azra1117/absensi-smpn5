<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapBulananExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize,
    WithStyles
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

    public function styles(Worksheet $sheet)
{
    return [

        1 => [

            'font' => [

                'bold' => true,

                'color' => [
                    'rgb' => 'FFFFFF'
                ],

            ],

            'fill' => [

                'fillType' => 'solid',

                'color' => [
                    'rgb' => '0D6EFD'
                ],

            ],

        ],

    ];
}
}