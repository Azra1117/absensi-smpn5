@extends('layouts.admin')

@section('title', 'Edit Kalender Akademik')

@section('content')

<div class="container-fluid">

@if ($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

    <div class="mb-4">

        <h2 class="fw-bold">

            <i class="bi bi-pencil-square text-warning"></i>

            Edit Kalender Akademik

        </h2>

        <p class="text-muted">

            Ubah status hari efektif atau hari libur.

        </p>

    </div>

    <div class="card-modern">

        <form
            action="{{ route('kalender.update', $kalender->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">

                    Tanggal

                </label>

                <input
                    type="text"
                    class="form-control"
                    value="{{ $kalender->tanggal->format('d F Y') }}"
                    readonly>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Status

                </label>

                <select
                    name="status"
                    class="form-select">

                    <option
                        value="Efektif"
                        {{ $kalender->status == 'Efektif' ? 'selected' : '' }}>

                        Efektif

                    </option>

                    <option
                        value="Libur"
                        {{ $kalender->status == 'Libur' ? 'selected' : '' }}>

                        Libur

                    </option>

                </select>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Keterangan

                </label>

                <input
                    type="text"
                    name="keterangan"
                    class="form-control"
                    value="{{ old('keterangan', $kalender->keterangan) }}"
                    placeholder="Contoh: Hari Kemerdekaan RI">

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                <i class="bi bi-save"></i>

                Simpan Perubahan

            </button>

            <a
               href="{{ route('kalender.index', [
    'tahun' => $kalender->tanggal->year,
    'bulan' => $kalender->tanggal->month,
]) }}"
                class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection