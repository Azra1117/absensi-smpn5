<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KalenderAkademikSeeder extends Seeder
{
    public function run()
    {
        $mulai = Carbon::create(2026, 8, 1);
        $selesai = Carbon::create(2027, 12, 31);

        while ($mulai <= $selesai) {

            DB::table('kalender_akademiks')->updateOrInsert(
                ['tanggal' => $mulai->toDateString()],
                [
                    'status' => $mulai->isWeekend() ? 'Libur' : 'Efektif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $mulai->addDay();
        }
    }
}