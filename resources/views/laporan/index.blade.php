@extends('layouts.admin')

@section('content')

<div class="container">

    <h3 class="mb-4">Laporan Absensi</h3>

    <form method="GET">

        <div class="row mb-3">

            <div class="col-md-3">

                <label>Tanggal</label>

                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="{{ request('tanggal') }}">

            </div>

            <div class="col-md-3">

                <label>Shift</label>

                <select
                    name="shift"
                    class="form-control">

                    <option value="">Pilih</option>

                    <option value="Pagi"
                        {{ request('shift')=='Pagi' ? 'selected' : '' }}>
                        Pagi
                    </option>

                    <option value="Siang"
                        {{ request('shift')=='Siang' ? 'selected' : '' }}>
                        Siang
                    </option>

                </select>

            </div>

            <div class="col-md-3">

                <label>Kelas</label>

                <select
                    name="kelas"
                    class="form-control">

                    <option value="">Pilih</option>

                    @foreach($kelas as $k)

                        <option
                            value="{{ $k->id }}"
                            {{ request('kelas')==$k->id ? 'selected' : '' }}>

                            {{ $k->nama_kelas }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-3 d-flex align-items-end">

                <button class="btn btn-primary w-100">
                    Tampilkan
                    @if(request('tanggal') && request('shift') && request('kelas'))

<a href="{{ route('laporan.excel',[
'tanggal'=>request('tanggal'),
'shift'=>request('shift'),
'kelas'=>request('kelas')
]) }}"

class="btn btn-success mt-2 w-100">

Export Excel
<a href="{{ route('laporan.pdf',[
'tanggal'=>request('tanggal'),
'shift'=>request('shift'),
'kelas'=>request('kelas')
]) }}"

class="btn btn-danger mt-2 w-100">

Export PDF

</a>

</a>

@endif
                </button>

            </div>

        </div>

    </form>

    <table class="table table-bordered table-striped">

        <thead>

            <tr>

                <th width="60">No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th width="120">Status</th>

            </tr>

        </thead>

        <tbody>

            @forelse($absensi as $a)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $a->siswa->nis }}</td>

                    <td>{{ $a->siswa->nama }}</td>

                    <td>{{ $a->status }}</td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="text-center">

                        Belum ada data

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    @if(request('kelas'))

    <div class="card mt-4">

        <div class="card-header">

            <strong>Rekap Absensi</strong>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="250">Jumlah Siswa</th>

                    <td>{{ $totalSiswa }}</td>

                </tr>

                <tr>

                    <th>Hadir</th>

                    <td>{{ $hadir }}</td>

                </tr>

                <tr>

                    <th>Sakit</th>

                    <td>{{ $sakit }}</td>

                </tr>

                <tr>

                    <th>Izin</th>

                    <td>{{ $izin }}</td>

                </tr>

                <tr>

                    <th>Alpha</th>

                    <td>{{ $alpha }}</td>

                </tr>

            </table>

        </div>

    </div>

    @endif

</div>

@endsection