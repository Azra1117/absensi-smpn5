<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ImportSiswaController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function store(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(new SiswaImport, $request->file('file'));

    return redirect()
        ->route('import.siswa')
        ->with('success', 'Data siswa berhasil diimport.');
}

    }