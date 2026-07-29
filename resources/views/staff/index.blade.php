@extends('layouts.admin')

@section('title','Data Staff')

@section('content')

<h2>Data Staff</h2>

<a href="{{ route('staff.create') }}"
style="background:#2563eb;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;">
+ Tambah Staff
</a>

<br><br>

<table class="table">

<tr>

<th>No</th>
<th>NIP</th>
<th>Nama</th>
<th>Jabatan</th>
<th>Jenis Kelamin</th>
<th>No HP</th>
<th>Aksi</th>

</tr>

@foreach($staffs as $staff)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $staff->nip }}</td>

<td>{{ $staff->nama }}</td>

<td>{{ $staff->jabatan }}</td>

<td>{{ $staff->jenis_kelamin }}</td>

<td>{{ $staff->no_hp }}</td>

<td>

<a class="btn-edit" href="{{ route('staff.edit',$staff->id) }}">
    Edit
</a>

<form action="{{ route('staff.destroy',$staff->id) }}"
      method="POST"
      style="display:inline;">

    @csrf
    @method('DELETE')

    <button class="btn-delete"
        onclick="return confirm('Yakin ingin menghapus data staff ini?')">
        Hapus
    </button>

</form>

</td>

</tr>

@endforeach

</table>

@endsection