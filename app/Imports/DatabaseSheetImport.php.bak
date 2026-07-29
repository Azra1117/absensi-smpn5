<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DatabaseSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $namaKelas = $row['kls2728']
                ?? $row['kls2627']
                ?? null;

            if (empty($row['nis']) || empty($namaKelas)) {
                continue;
            }

            $kelas = Kelas::firstOrCreate(
                ['nama_kelas' => $namaKelas],
                [
                    'tingkat' => substr($namaKelas, 0, 1),
                    'shift' => 'Pagi',
                    'wali_kelas' => '-'
                ]
            );

            Siswa::updateOrCreate(
                ['nis' => $row['nis']],
                [
                    'nama' => $row['nama_dapodik'],
                    'jenis_kelamin' => strtoupper($row['jk7']),
                    'kelas_id' => $kelas->id,
                ]
            );
        }
    }
}