@extends('layouts.admin')

@section('title','Data Guru')

@section('content')

<h2>Data Guru</h2>

<a href="/guru/create"
style="background:#2563eb;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;">
+ Tambah Guru
</a>

<div class="table-responsive">

<table class="table table-hover align-middle">

...

</table>

</div>

<tr>

<th>No</th>
<th>NIP</th>
<th>Nama</th>
<th>Mapel</th>
<th>Jenis Kelamin</th>
<th>No HP</th>
<th>Aksi</th>

</tr>

@foreach($gurus as $guru)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $guru->nip }}</td>

<td>{{ $guru->nama }}</td>

<td>{{ $guru->mapel }}</td>

<td>{{ $guru->jenis_kelamin }}</td>

<td>{{ $guru->no_hp }}</td>

<td>

<a class="btn-edit" href="{{ route('guru.edit',$guru->id) }}">
    Edit
</a>

<form action="{{ route('guru.destroy',$guru->id) }}"
      method="POST"
      style="display:inline;">

    @csrf
    @method('DELETE')

    <button class="btn-delete"
        onclick="return confirm('Yakin ingin menghapus data guru ini?')">
        Hapus
    </button>

</form>

</td>

</tr>

@endforeach

</table>

@endsection