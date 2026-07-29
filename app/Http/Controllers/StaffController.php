<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::latest()->get();

        return view('staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:staff,nip',
            'nama' => 'required',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'nullable',
        ]);

        Staff::create($request->all());

        return redirect()->route('staff.index')
            ->with('success', 'Data Staff berhasil ditambahkan.');
    }

    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'nip' => 'required|unique:staff,nip,' . $staff->id,
            'nama' => 'required',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'nullable',
        ]);

        $staff->update($request->all());

        return redirect()->route('staff.index')
            ->with('success', 'Data Staff berhasil diubah.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('staff.index')
            ->with('success', 'Data Staff berhasil dihapus.');
    }
}