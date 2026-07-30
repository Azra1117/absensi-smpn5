<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        // Ambil daftar kelas untuk dropdown filter
        $kelas = Kelas::orderBy('nama_kelas')->get();

        // Kirim data ke halaman rekap
        return view('rekap.index', [
            'kelas' => $kelas,
        ]);
    }
}
