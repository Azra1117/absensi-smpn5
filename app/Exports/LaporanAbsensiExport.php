<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanAbsensiExport implements FromCollection, WithHeadings
{
    protected $tanggal;
    protected $shift;
    protected $kelas;

    public function __construct($tanggal, $shift, $kelas)
    {
        $this->tanggal = $tanggal;
        $this->shift = $shift;
        $this->kelas = $kelas;
    }

    public function collection()
    {
        return Absensi::with('siswa')
            ->where('tanggal', $this->tanggal)
            ->where('shift', $this->shift)
            ->where('kelas_id', $this->kelas)
            ->get()
            ->map(function ($item) {
                return [
                    'NIS' => $item->siswa->nis,
                    'Nama' => $item->siswa->nama,
                    'Status' => $item->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Status'
        ];
    }
}
