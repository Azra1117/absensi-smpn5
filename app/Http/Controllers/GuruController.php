<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::latest()->get();

        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:gurus',
            'nama' => 'required',
            'mapel' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'nullable'
        ]);

        Guru::create($request->all());

        return redirect('/guru')->with('success', 'Data Guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nip' => 'required|unique:gurus,nip,' . $guru->id,
            'nama' => 'required',
            'mapel' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'nullable'
        ]);

        $guru->update($request->all());

        return redirect('/guru')->with('success', 'Data Guru berhasil diubah.');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect('/guru')->with('success', 'Data Guru berhasil dihapus.');
    }
}