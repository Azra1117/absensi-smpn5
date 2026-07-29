<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Exports\LaporanAbsensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    $kelas = Kelas::orderBy('nama_kelas')->get();

    $absensi = collect();

    $totalSiswa = 0;
    $hadir = 0;
    $sakit = 0;
    $izin = 0;
    $alpha = 0;

    if (
        $request->filled('tanggal') &&
        $request->filled('shift') &&
        $request->filled('kelas')
    ) {

        $absensi = Absensi::with('siswa')
            ->where('tanggal', $request->tanggal)
            ->where('shift', $request->shift)
            ->where('kelas_id', $request->kelas)
            ->get();

        $totalSiswa = \App\Models\Siswa::where('kelas_id', $request->kelas)->count();

        $sakit = $absensi->where('status', 'Sakit')->count();

        $izin = $absensi->where('status', 'Izin')->count();

        $alpha = $absensi->where('status', 'Alpha')->count();

        $hadir = $totalSiswa - ($sakit + $izin + $alpha);
    }

    return view('laporan.index', compact(
        'kelas',
        'absensi',
        'totalSiswa',
        'hadir',
        'sakit',
        'izin',
        'alpha'
    ));
}
public function exportExcel(Request $request)
{
    return Excel::download(

        new LaporanAbsensiExport(
            $request->tanggal,
            $request->shift,
            $request->kelas
        ),

        'Laporan_Absensi.xlsx'

    );
}
public function exportPdf(Request $request)
{
    $absensi = Absensi::with('siswa')
        ->where('tanggal', $request->tanggal)
        ->where('shift', $request->shift)
        ->where('kelas_id', $request->kelas)
        ->get();

    $kelas = Kelas::find($request->kelas);

    $pdf = Pdf::loadView('laporan.pdf', compact(
        'absensi',
        'kelas',
        'request'
    ));

    return $pdf->download('Laporan_Absensi.pdf');
}
}
