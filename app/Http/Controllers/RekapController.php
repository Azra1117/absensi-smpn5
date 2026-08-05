<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Exports\RekapBulananExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
public function index(Request $request)
{
    $bulan = $request->bulan ?? date('m');
    $tahun = $request->tahun ?? date('Y');
$hariEfektif = \App\Models\KalenderAkademik::whereYear('tanggal', $tahun)
    ->whereMonth('tanggal', $bulan)
    ->where('status', 'Efektif')
    ->count();
    $tingkat = $request->tingkat;
    $kelasId = $request->kelas;

    $kelas = Kelas::orderBy('nama_kelas')->get();

    $querySiswa = Siswa::query();

    if ($tingkat) {
        $querySiswa->whereHas('kelas', function ($q) use ($tingkat) {
            $q->where('tingkat', $tingkat);
        });
    }

    if ($kelasId) {
        $querySiswa->where('kelas_id', $kelasId);
    }

    $totalSiswa = $querySiswa->count();

    $queryAbsensi = Absensi::whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun);

    if ($kelasId) {
        $queryAbsensi->where('kelas_id', $kelasId);
    }

    if ($tingkat) {
        $queryAbsensi->whereHas('kelas', function ($q) use ($tingkat) {
            $q->where('tingkat', $tingkat);
        });
    }

    $izin = (clone $queryAbsensi)
        ->where('status', 'Izin')
        ->count();

    $sakit = (clone $queryAbsensi)
        ->where('status', 'Sakit')
        ->count();

    $alpha = (clone $queryAbsensi)
        ->where('status', 'Alpha')
        ->count();
    
    $rekapKelas = [];

$queryKelas = Kelas::query();

if ($tingkat) {
    $queryKelas->where('tingkat', $tingkat);
}

if ($kelasId) {
    $queryKelas->where('id', $kelasId);
}

foreach ($queryKelas->orderBy('nama_kelas')->get() as $kls) {

    $jumlahSiswa = Siswa::where('kelas_id', $kls->id)->count();

    $izinKelas = Absensi::where('kelas_id', $kls->id)
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->where('status', 'Izin')
        ->count();

    $sakitKelas = Absensi::where('kelas_id', $kls->id)
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->where('status', 'Sakit')
        ->count();

    $alphaKelas = Absensi::where('kelas_id', $kls->id)
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->where('status', 'Alpha')
        ->count();
        $totalHariBelajar = $jumlahSiswa * $hariEfektif;

$hadirKelas = max(
    0,
    $totalHariBelajar - ($izinKelas + $sakitKelas + $alphaKelas)
);

$persentase = $totalHariBelajar > 0
    ? round(($hadirKelas / $totalHariBelajar) * 100, 2)
    : 0;

    $rekapKelas[] = [
        'kelas' => $kls->nama_kelas,
        'total' => $jumlahSiswa,
        'hari_efektif' => $hariEfektif,
        'total_kehadiran' => $totalHariBelajar,
        'hadir' => $hadirKelas,
        'izin' => $izinKelas,
        'sakit' => $sakitKelas,
        'alpha' => $alphaKelas,
        'persentase' => $persentase,
    ];
}

    $totalKehadiranSemua = $totalSiswa * $hariEfektif;

$hadir = max(
    0,
    $totalKehadiranSemua - ($izin + $sakit + $alpha)
);

$persentaseKeseluruhan = $totalKehadiranSemua > 0
    ? round(($hadir / $totalKehadiranSemua) * 100, 2)
    : 0;

    $totalHadir = collect($rekapKelas)->sum('hadir');
$totalIzin = collect($rekapKelas)->sum('izin');
$totalSakit = collect($rekapKelas)->sum('sakit');
$totalAlpha = collect($rekapKelas)->sum('alpha');
$totalKehadiran = collect($rekapKelas)->sum('total_kehadiran');

$persentaseTotal = $totalKehadiran > 0
    ? round(($totalHadir / $totalKehadiran) * 100, 2)
    : 0;

    $grafikBulanan = [];

for ($i = 1; $i <= 12; $i++) {

    $hariEfektifBulanan = \App\Models\KalenderAkademik::whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $i)
        ->where('status', 'Efektif')
        ->count();

    $querySiswaBulanan = Siswa::query();

    if ($tingkat) {
        $querySiswaBulanan->whereHas('kelas', function ($q) use ($tingkat) {
            $q->where('tingkat', $tingkat);
        });
    }

    if ($kelasId) {
        $querySiswaBulanan->where('kelas_id', $kelasId);
    }

    $jumlahSiswa = $querySiswaBulanan->count();

    $totalHariBelajar = $jumlahSiswa * $hariEfektifBulanan;

    $absen = Absensi::whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $i);

    if ($kelasId) {
        $absen->where('kelas_id', $kelasId);
    }

    if ($tingkat) {
        $absen->whereHas('kelas', function ($q) use ($tingkat) {
            $q->where('tingkat', $tingkat);
        });
    }

    $tidakHadir = (clone $absen)
    ->whereIn('status', [
        'Izin',
        'Sakit',
        'Alpha'
    ])
    ->count();

$hadirBulanan = max(0, $totalHariBelajar - $tidakHadir);

$persen = $totalHariBelajar > 0
    ? round(($hadirBulanan / $totalHariBelajar) * 100, 2)
    : 0;

    $grafikBulanan[] = $persen;
}

    return view('rekap.index', compact(
    'kelas',
    'bulan',
    'tahun',
    'tingkat',
    'kelasId',
    'hariEfektif',
    'totalSiswa',
    'hadir',
    'izin',
    'sakit',
    'alpha',
    'rekapKelas',
    'totalHadir',
'totalIzin',
'totalSakit',
'totalAlpha',
'totalKehadiran',
'persentaseTotal',
'grafikBulanan',
'persentaseKeseluruhan'
));
}
public function exportExcel(Request $request)
{
    $bulan = $request->bulan ?? date('m');
    $tahun = $request->tahun ?? date('Y');
    $tingkat = $request->tingkat;
    $kelasId = $request->kelas;

    $hariEfektif = \App\Models\KalenderAkademik::whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $bulan)
        ->where('status', 'Efektif')
        ->count();

    $rekapKelas = [];

    $queryKelas = Kelas::query();

    if ($tingkat) {
        $queryKelas->where('tingkat', $tingkat);
    }

    if ($kelasId) {
        $queryKelas->where('id', $kelasId);
    }

    foreach ($queryKelas->orderBy('nama_kelas')->get() as $kls) {

        $jumlahSiswa = Siswa::where('kelas_id', $kls->id)->count();

        $izin = Absensi::where('kelas_id', $kls->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'Izin')
            ->count();

        $sakit = Absensi::where('kelas_id', $kls->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'Sakit')
            ->count();

        $alpha = Absensi::where('kelas_id', $kls->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'Alpha')
            ->count();

        $totalHariBelajar = $jumlahSiswa * $hariEfektif;

        $hadir = max(
            0,
            $totalHariBelajar - ($izin + $sakit + $alpha)
        );

        $persentase = $totalHariBelajar > 0
            ? round(($hadir / $totalHariBelajar) * 100, 2)
            : 0;

        $rekapKelas[] = [
            'kelas' => $kls->nama_kelas,
            'total' => $jumlahSiswa,
            'hari_efektif' => $hariEfektif,
            'total_kehadiran' => $totalHariBelajar,
            'hadir' => $hadir,
            'izin' => $izin,
            'sakit' => $sakit,
            'alpha' => $alpha,
            'persentase' => $persentase,
        ];
    }

    return Excel::download(
        new RekapBulananExport($rekapKelas),
        "Rekap_Bulanan_{$bulan}_{$tahun}.xlsx"
    );
}

public function exportPdf(Request $request)
{
    $bulan = $request->bulan ?? date('m');
    $tahun = $request->tahun ?? date('Y');
    $tingkat = $request->tingkat;
    $kelasId = $request->kelas;

    $hariEfektif = \App\Models\KalenderAkademik::whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $bulan)
        ->where('status', 'Efektif')
        ->count();

    $rekapKelas = [];

    $queryKelas = Kelas::query();

    if ($tingkat) {
        $queryKelas->where('tingkat', $tingkat);
    }

    if ($kelasId) {
        $queryKelas->where('id', $kelasId);
    }

    foreach ($queryKelas->orderBy('nama_kelas')->get() as $kls) {

        $jumlahSiswa = Siswa::where('kelas_id', $kls->id)->count();

        $izin = Absensi::where('kelas_id', $kls->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'Izin')
            ->count();

        $sakit = Absensi::where('kelas_id', $kls->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'Sakit')
            ->count();

        $alpha = Absensi::where('kelas_id', $kls->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'Alpha')
            ->count();

        $totalHariBelajar = $jumlahSiswa * $hariEfektif;

        $hadir = max(
            0,
            $totalHariBelajar - ($izin + $sakit + $alpha)
        );

        $persentase = $totalHariBelajar > 0
            ? round(($hadir / $totalHariBelajar) * 100, 2)
            : 0;

        $rekapKelas[] = [
            'kelas' => $kls->nama_kelas,
            'total' => $jumlahSiswa,
            'hari_efektif' => $hariEfektif,
            'total_kehadiran' => $totalHariBelajar,
            'hadir' => $hadir,
            'izin' => $izin,
            'sakit' => $sakit,
            'alpha' => $alpha,
            'persentase' => $persentase,
        ];
    }
    $namaBulan = [
    1=>'Januari',
    2=>'Februari',
    3=>'Maret',
    4=>'April',
    5=>'Mei',
    6=>'Juni',
    7=>'Juli',
    8=>'Agustus',
    9=>'September',
    10=>'Oktober',
    11=>'November',
    12=>'Desember'
];


    $pdf = Pdf::loadView('rekap.pdf', compact(
        'rekapKelas',
        'bulan',
        'tahun'
    ));

    return $pdf->download("Rekap_Bulanan_{$bulan}_{$tahun}.pdf");
}
}