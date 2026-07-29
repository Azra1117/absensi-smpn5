@extends('layouts.admin')

@section('title', 'Data Kelas')

@section('content')

<h2>Data Kelas</h2>

<hr><br>

<a href="{{ route('kelas.create') }}">
    <button>+ Tambah Kelas</button>
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0" width="100%">

    <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Tingkat</th>
        <th>Shift</th>
        <th>Wali Kelas</th>
        <th>Aksi</th>
    </tr>

    @forelse($kelas as $item)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ $item->nama_kelas }}</td>

        <td>{{ $item->tingkat }}</td>

        <td>{{ $item->shift }}</td>

        <td>{{ $item->wali_kelas }}</td>

        <td>
            Edit | Hapus
        </td>

    </tr>

    @empty

    <tr>
        <td colspan="6" align="center">
            Belum ada data kelas.
        </td>
    </tr>

    @endforelse

</table>

@endsection