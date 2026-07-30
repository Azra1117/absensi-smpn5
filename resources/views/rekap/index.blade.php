@extends('layouts.admin')

@section('title', 'Rekap Absensi')

@section('content')

<div class="container-fluid">

    {{-- Judul --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            <i class="bi bi-clipboard-data-fill text-primary"></i>
            Rekap Absensi
        </h2>

        <p class="text-muted mb-0">
            Monitoring kehadiran siswa berdasarkan bulan, kelas, dan tingkat.
        </p>
    </div>

    {{-- Statistik --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card-modern h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Siswa</small>
                        <h2 class="fw-bold mt-2">
                         {{ number_format($totalSiswa) }}
                        </h2>
                    </div>

                    <i class="bi bi-people-fill text-primary fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-modern h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Hadir</small>
                        <h2 class="fw-bold text-success mt-2">
                            {{ number_format($hadir) }}
                        </h2>
                    </div>

                    <i class="bi bi-check-circle-fill text-success fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-modern h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Alpha</small>
                        <h2 class="fw-bold text-danger mt-2">
                            {{ number_format($alpha) }}
                        </h2>
                    </div>

                    <i class="bi bi-x-circle-fill text-danger fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-modern h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Izin / Sakit</small>
                        <h2 class="fw-bold text-warning mt-2">
                            {{ number_format($izin + $sakit) }}
                        </h2>
                    </div>

                    <i class="bi bi-file-earmark-medical-fill text-warning fs-1"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="alert alert-info mb-4">
    <i class="bi bi-calendar-event"></i>
    <strong>Hari Efektif Bulan Ini :</strong>
    {{ $hariEfektif }} Hari
</div>

    {{-- Filter --}}
    <div class="card-modern mb-4">

        <h5 class="fw-bold mb-4">
            Filter Rekap
        </h5>

        <form method="GET" action="{{ route('rekap.index') }}">

        <div class="row g-3">

            <div class="col-md-3">

                <label class="form-label">Bulan</label>

                <select name="bulan" class="form-select">

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
                    ] as $key=>$nama)

                    <option
                    value="{{ $key }}"
                    {{ $bulan==$key?'selected':'' }}>

                    {{ $nama }}

                    </option>

                    @endforeach

                    </select>

            </div>

            <div class="col-md-2">

                <label class="form-label">
                    Tahun
                </label>

                <select
                    name="tahun"
                    class="form-select">

                    @for($i=date('Y');$i>=2025;$i--)

                    <option
                    value="{{ $i }}"
                    {{ $tahun==$i?'selected':'' }}>

                    {{ $i }}

                    </option>

                    @endfor

                    </select>

            </div>

            <div class="col-md-3">

                <label class="form-label">
                    Tingkat
                </label>

                <select name="tingkat" class="form-select">

    <option value="">
        Semua Tingkat
    </option>

    <option value="7"
        {{ $tingkat == 7 ? 'selected' : '' }}>
        Kelas 7
    </option>

    <option value="8"
        {{ $tingkat == 8 ? 'selected' : '' }}>
        Kelas 8
    </option>

    <option value="9"
        {{ $tingkat == 9 ? 'selected' : '' }}>
        Kelas 9
    </option>

</select>

            </div>

            <div class="col-md-4">

                <label class="form-label">
                    Kelas
                </label>

                <select name="kelas" class="form-select">

    <option value="">
        Semua Kelas
    </option>

    @foreach($kelas as $item)

        <option value="{{ $item->id }}"
            {{ $kelasId == $item->id ? 'selected' : '' }}>
            {{ $item->nama_kelas }}
        </option>

    @endforeach

</select>

            </div>

        </div>

        <div class="mt-4">

            <button type="submit" class="btn btn-primary px-4">  
                <i class="bi bi-search"></i>
                Tampilkan Rekap
            </button>

            <a href="{{ route('rekap.export.excel', request()->query()) }}"
   class="btn btn-success px-4 ms-2">
    <i class="bi bi-file-earmark-excel"></i>
    Export Excel
</a>

<a href="{{ route('rekap.export.pdf', request()->query()) }}"
    class="btn btn-danger ms-2">

    <i class="bi bi-file-earmark-pdf"></i>

    Export PDF

</a>

        </div>

        </form>

    </div>

    {{-- Tabel --}}
    <div class="card-modern">

        <h5 class="fw-bold mb-3">
            Data Rekap
        </h5>

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

<th>No</th>
<th>Kelas</th>
<th>Total Siswa</th>
<th>Hari Efektif</th>
<th>Total Kehadiran</th>
<th>Hadir</th>
<th>Izin</th>
<th>Sakit</th>
<th>Alpha</th>
<th>% Hadir</th>

</tr>

                </thead>

                <tbody>

@if(count($rekapKelas) > 0)

    @foreach($rekapKelas as $index => $row)

    <tr>

        <td>{{ $index + 1 }}</td>

        <td>{{ $row['kelas'] }}</td>

        <td>{{ $row['total'] }}</td>

<td>{{ $row['hari_efektif'] }} Hari</td>

<td>{{ number_format($row['total_kehadiran']) }}</td>

<td class="text-success fw-bold">
    {{ number_format($row['hadir']) }}
</td>

<td class="text-warning">
    {{ number_format($row['izin']) }}
</td>

<td class="text-info">
    {{ number_format($row['sakit']) }}
</td>

<td class="text-danger">
    {{ number_format($row['alpha']) }}
</td>

<td>
    <span class="badge bg-success">
        {{ $row['persentase'] }}%
    </span>
</td>

        <td class="text-warning">
            {{ $row['izin'] }}
        </td>

        <td class="text-info">
            {{ $row['sakit'] }}
        </td>

        <td class="text-danger">
            {{ $row['alpha'] }}
        </td>

        <td>

    <span class="badge bg-success">

        {{ $row['persentase'] }}%

    </span>

</td>

    </tr>

    @endforeach

@else

<tr>

    <td colspan="8" class="text-center text-muted py-5">

        Tidak ada data ditemukan

    </td>

</tr>

@endif

</tbody>

            </table>

            <div class="card mt-4 border-0 shadow-sm">
    <div class="card-body">

        <h5 class="fw-bold mb-3">
            Ringkasan Rekap Bulanan
        </h5>

        <div class="row">

            <div class="col-md-4 mb-3">
                <strong>Total Kehadiran</strong><br>
                {{ number_format($totalKehadiran) }}
            </div>

            <div class="col-md-4 mb-3">
                <strong>Total Hadir</strong><br>
                <span class="text-success fw-bold">
                    {{ number_format($totalHadir) }}
                </span>
            </div>

            <div class="col-md-4 mb-3">
                <strong>Total Izin</strong><br>
                <span class="text-warning fw-bold">
                    {{ number_format($totalIzin) }}
                </span>
            </div>

            <div class="col-md-4 mb-3">
                <strong>Total Sakit</strong><br>
                <span class="text-info fw-bold">
                    {{ number_format($totalSakit) }}
                </span>
            </div>

            <div class="col-md-4 mb-3">
                <strong>Total Alpha</strong><br>
                <span class="text-danger fw-bold">
                    {{ number_format($totalAlpha) }}
                </span>
            </div>

            <div class="col-md-4 mb-3">
                <strong>Persentase Kehadiran</strong><br>
                <span class="badge bg-success fs-6">
                    {{ $persentaseTotal }}%
                </span>
            </div>

        </div>

    </div>
</div>

        </div>

    </div>

</div>

@endsection