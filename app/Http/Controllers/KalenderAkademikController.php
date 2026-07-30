<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use Illuminate\Http\Request;

class KalenderAkademikController extends Controller
{
    public function index(Request $request)
{
    $bulan = $request->bulan ?? date('m');
    $tahun = $request->tahun ?? date('Y');

    $kalender = KalenderAkademik::whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $bulan)
        ->orderBy('tanggal')
        ->get();

    return view('kalender.index', compact(
        'kalender',
        'bulan',
        'tahun'
    ));
}

    public function generate(Request $request)
{
    $request->validate([
        'tahun' => 'required|integer|min:2025|max:2100',
    ]);

    $tahun = $request->tahun;

    if (KalenderAkademik::whereYear('tanggal', $tahun)->exists()) {

        return redirect()
            ->route('kalender.index')
            ->with('warning', "Kalender tahun {$tahun} sudah pernah dibuat.");
    }

    $mulai = new \DateTime("{$tahun}-01-01");
    $selesai = new \DateTime("{$tahun}-12-31");

while ($mulai <= $selesai) {

    $hari = $mulai->format('N');

    $status = ($hari >= 6) ? 'Libur' : 'Efektif';

    $namaHari = [
        'Monday'    => 'Senin',
        'Tuesday'   => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday'  => 'Kamis',
        'Friday'    => 'Jumat',
        'Saturday'  => 'Sabtu',
        'Sunday'    => 'Minggu',
    ];

    $keterangan = $status == 'Efektif'
        ? 'Hari Belajar'
        : $namaHari[$mulai->format('l')];

    KalenderAkademik::create([
        'tanggal'    => $mulai->format('Y-m-d'),
        'status'     => $status,
        'keterangan' => $keterangan,
    ]);

    $mulai->modify('+1 day');
}

    return redirect()
        ->route('kalender.index')
        ->with('success', "Kalender tahun {$tahun} berhasil dibuat.");
}

public function edit(KalenderAkademik $kalender)
{
    return view('kalender.edit', compact('kalender'));
}
public function update(Request $request, KalenderAkademik $kalender)
{
    $request->validate([
        'status' => 'required|in:Efektif,Libur',
        'keterangan' => 'nullable|string|max:255',
    ]);

    $kalender->update([
        'status' => $request->status,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()
        ->route('kalender.index', [
            'tahun' => $kalender->tanggal->year,
            'bulan' => $kalender->tanggal->month,
        ])
        ->with('success', 'Kalender berhasil diperbarui.');
}
}