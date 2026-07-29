@extends('layouts.admin')

@section('title','Tambah Staff')

@section('content')

<h2>Tambah Data Staff</h2>

<form action="{{ route('staff.store') }}" method="POST">

    @csrf

    <div style="margin-bottom:15px;">
        <label>NIP</label><br>
        <input type="text" name="nip" style="width:100%;padding:10px;" required>
    </div>

    <div style="margin-bottom:15px;">
        <label>Nama Staff</label><br>
        <input type="text" name="nama" style="width:100%;padding:10px;" required>
    </div>

    <div style="margin-bottom:15px;">
        <label>Jabatan</label><br>
        <input type="text" name="jabatan" style="width:100%;padding:10px;" required>
    </div>

    <div style="margin-bottom:15px;">
        <label>Jenis Kelamin</label><br>

        <select name="jenis_kelamin" style="width:100%;padding:10px;">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

    </div>

    <div style="margin-bottom:15px;">
        <label>No HP</label><br>
        <input type="text" name="no_hp" style="width:100%;padding:10px;" required>
    </div>

    <div style="margin-bottom:15px;">
        <label>Alamat</label><br>
        <textarea name="alamat" rows="4" style="width:100%;padding:10px;"></textarea>
    </div>

    <button type="submit"
        style="padding:12px 25px;background:#2563eb;color:white;border:none;border-radius:8px;">
        Simpan
    </button>

    <a href="{{ route('staff.index') }}"
        style="padding:12px 25px;background:#6b7280;color:white;text-decoration:none;border-radius:8px;">
        Kembali
    </a>

</form>

@endsection