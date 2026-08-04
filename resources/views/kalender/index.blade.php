@extends('layouts.admin')

@section('title', 'Kalender Akademik')

@section('content')

<div class="container-fluid">

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

@if(session('warning'))

<div class="alert alert-warning">

    {{ session('warning') }}

</div>

@endif

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            <i class="bi bi-calendar-event text-primary"></i>
            Kalender Akademik
        </h2>

        <p class="text-muted mb-0">
            Kelola hari efektif dan hari libur sekolah.
        </p>
    </div>

    {{-- Card --}}
    <div class="card-modern">

        <div class="d-flex justify-content-between align-items-center mb-4">

    <h5 class="fw-bold mb-0">
        Daftar Kalender
    </h5>

<div class="d-flex gap-2">

<form
    action="{{ route('kalender.index') }}"
    method="GET">

    <div class="d-flex gap-2">

<select
name="tahun"
class="form-select"
style="width:120px;">

    @for($i = date('Y') + 2; $i >= 2025; $i--)

        <option
            value="{{ $i }}"
            {{ $tahun == $i ? 'selected' : '' }}>

            {{ $i }}

        </option>

    @endfor

</select>

<select
name="bulan"
class="form-select"
style="width:150px;">

@foreach([
1=>'Januari',
2=>'Februari',
3=>'Maret',
4=>'April',
5=>'Mei',
6=>'Juni',
7=>'Juli',
8=>'Agustus',
9=>'September',
10=>'Oktober',
11=>'November',
12=>'Desember'
] as $key => $nama)

<option
value="{{ $key }}"
{{ $bulan == $key ? 'selected' : '' }}>

{{ $nama }}

</option>

@endforeach

</select>

<button
type="submit"
class="btn btn-secondary">

    <i class="bi bi-search"></i>

    Filter

</button>

</div>

</form>

        <form
action="{{ route('kalender.generate') }}"
method="POST">

    @csrf

    <input
        type="hidden"
        name="tahun"
        value="{{ $tahun }}">

    <button
        type="submit"
        class="btn btn-primary">

        <i class="bi bi-magic"></i>

        Generate Kalender

    </button>

</form>

</div>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th width="60">No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th width="120">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($kalender as $index => $item)

                    <tr>

    <td>{{ $loop->iteration }}</td>

    <td>
        {{ $item->tanggal->format('d-m-Y') }}
    </td>

    <td>
        <span class="badge bg-{{ $item->status == 'Efektif' ? 'success' : 'danger' }}">
            {{ $item->status }}
        </span>
    </td>

    <td>
        {{ $item->keterangan ?? '-' }}
    </td>

    <td>

        <a
            href="{{ route('kalender.edit', $item->id) }}"
            class="btn btn-warning btn-sm">

            <i class="bi bi-pencil-square"></i>

        </a>

    </td>

</tr>

                        

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-5 text-muted">

                            Belum ada data kalender akademik.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection