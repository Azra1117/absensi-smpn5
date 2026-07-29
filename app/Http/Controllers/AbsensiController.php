<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Services\GoogleSheetService;

class AbsensiController extends Controller
{
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('absensi.index', compact('kelas'));
    }

    public function getSiswa($kelas)
{
    $siswa = Siswa::where('kelas_id', $kelas)
        ->orderBy('nama')
        ->get();

    return response()->json($siswa);
}

    public function create()
    {
        //
    }

    public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required',
        'shift' => 'required',
        'kelas_id' => 'required',
    ]);

    // Hapus data absensi yang sudah ada untuk tanggal, shift, dan kelas yang sama
    Absensi::where('tanggal', $request->tanggal)
        ->where('shift', $request->shift)
        ->where('kelas_id', $request->kelas_id)
        ->delete();

    if ($request->has('status')) {

        foreach ($request->status as $siswa_id => $status) {

            // Simpan hanya yang tidak hadir
            if ($status != 'Hadir') {

                $absensi = Absensi::create([
                    'tanggal' => $request->tanggal,
                    'shift' => $request->shift,
                    'kelas_id' => $request->kelas_id,
                    'siswa_id' => $siswa_id,
                    'status' => $status,
                    'user_id' => auth()->id(),
                ]);

                $siswa = $absensi->siswa;
                $kelas = $absensi->kelas;
                $user = $absensi->user;
                
                app(GoogleSheetService::class)->append([
                    $absensi->tanggal,
                    $absensi->shift,
                    $kelas->nama_kelas,
                    $siswa->nis,
                    $siswa->nama,
                    $absensi->status,
                    $user->name,
                ]);

            }

        }

    }

    return redirect()->route('absensi.index')
        ->with('success', 'Absensi berhasil disimpan.');
}

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

public function destroy(string $id)
{
    //
}

public function getAbsensi($tanggal, $shift, $kelas)
{
    $absensi = Absensi::where('tanggal', $tanggal)
        ->where('shift', $shift)
        ->where('kelas_id', $kelas)
        ->get()
        ->keyBy('siswa_id');

    return response()->json($absensi);
}
}