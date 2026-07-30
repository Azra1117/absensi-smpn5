@extends('layouts.admin')

@section('title', 'Rekap Absensi')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">
                <i class="bi bi-bar-chart-fill"></i>
                Rekap Absensi
            </h4>

        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-3">

                    <label class="form-label">
                        Bulan
                    </label>

                    <select class="form-select">

                        <option>Januari</option>
                        <option>Februari</option>
                        <option>Maret</option>
                        <option>April</option>
                        <option>Mei</option>
                        <option>Juni</option>
                        <option selected>Juli</option>
                        <option>Agustus</option>
                        <option>September</option>
                        <option>Oktober</option>
                        <option>November</option>
                        <option>Desember</option>

                    </select>

                </div>

                <div class="col-md-2">

                    <label class="form-label">
                        Tahun
                    </label>

                    <select class="form-select">

                        @for($i = date('Y'); $i >= 2025; $i--)

                            <option>{{ $i }}</option>

                        @endfor

                    </select>

                </div>

                <div class="col-md-3">

                    <label class="form-label">
                        Tingkat
                    </label>

                    <select class="form-select">

                        <option value="">Semua Tingkat</option>
                        <option value="7">Kelas 7</option>
                        <option value="8">Kelas 8</option>
                        <option value="9">Kelas 9</option>

                    </select>

                </div>

                <div class="col-md-4">

                    <label class="form-label">
                        Kelas
                    </label>

                    <select class="form-select">

                        <option value="">
                            Semua Kelas
                        </option>

                        @foreach($kelas as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->nama_kelas }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <div class="mt-4">

                <button class="btn btn-primary">

                    <i class="bi bi-search"></i>

                    Tampilkan Rekap

                </button>

            </div>

        </div>

    </div>

</div>

@endsection