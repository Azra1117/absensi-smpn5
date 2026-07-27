@extends('layouts.admin')

@section('title','Edit Guru')

@section('content')

<h2>Edit Data Guru</h2>

<form action="{{ route('guru.update',$guru->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div style="margin-bottom:15px;">
        <label>NIP</label><br>
        <input type="text" name="nip" value="{{ $guru->nip }}" style="width:100%;padding:10px;" required>
    </div>

    <div style="margin-bottom:15px;">
        <label>Nama Guru</label><br>
        <input type="text" name="nama" value="{{ $guru->nama }}" style="width:100%;padding:10px;" required>
    </div>

    <div style="margin-bottom:15px;">
        <label>Mata Pelajaran</label><br>
        <input type="text" name="mapel" value="{{ $guru->mapel }}" style="width:100%;padding:10px;" required>
    </div>

    <div style="margin-bottom:15px;">
        <label>Jenis Kelamin</label><br>

        <select name="jenis_kelamin" style="width:100%;padding:10px;">

            <option value="Laki-laki"
                {{ $guru->jenis_kelamin=='Laki-laki'?'selected':'' }}>
                Laki-laki
            </option>

            <option value="Perempuan"
                {{ $guru->jenis_kelamin=='Perempuan'?'selected':'' }}>
                Perempuan
            </option>

        </select>

    </div>

    <div style="margin-bottom:15px;">
        <label>No HP</label><br>
        <input type="text" name="no_hp" value="{{ $guru->no_hp }}" style="width:100%;padding:10px;" required>
    </div>

    <div style="margin-bottom:15px;">
        <label>Alamat</label><br>
        <textarea name="alamat" rows="4" style="width:100%;padding:10px;">{{ $guru->alamat }}</textarea>
    </div>

    <button type="submit"
        style="padding:12px 25px;background:#2563eb;color:white;border:none;border-radius:8px;">
        Update
    </button>

    <a href="{{ route('guru.index') }}"
        style="padding:12px 25px;background:#6b7280;color:white;text-decoration:none;border-radius:8px;">
        Kembali
    </a>

</form>

@endsection