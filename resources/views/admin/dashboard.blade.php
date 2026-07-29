@extends('layouts.admin')

@section('title','Dashboard Admin')

@section('content')

<style>

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:20px;
    margin-top:30px;
}

.card{
    background:white;
    border-radius:18px;
    padding:25px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
    transition:.3s;
    overflow:hidden;
    position:relative;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(37,99,235,.15);
}

.card h4{
    color:#666;
    margin-bottom:10px;
}

.card h1{
    font-size:40px;
    color:#2563eb;
}

.card i{
    font-size:48px;
    float:right;
    color:#2563EB;
    opacity:.25;
}

</style>

<div class="dashboard-header">

    <div>
        <h1 class="dashboard-title">
            👋 Selamat Datang,
            {{ auth()->user()->nama }}
        </h1>

        <p class="dashboard-subtitle">
            Dashboard Administrator
            <br>
            Sistem Monitoring Absensi SMP Negeri 5 Tambun Utara
        </p>
    </div>

    <div class="dashboard-clock">

        <div id="tanggal"></div>

        <div id="jam"></div>

    </div>

</div>

<div class="cards">

    <div class="card">
        <i class="bi bi-person-video3" style="color:#2563EB;"></i>
        <h4>Jumlah Guru</h4>
        <h1>{{ $guru }}</h1>
        <small style="color:#94A3B8;">
            Guru Aktif
        </small>
    </div>

    <div class="card">
        <i class="bi bi-person-badge" style="color:#22C55E;"></i>
        <h4>Jumlah Staff</h4>
        <h1>{{ $staff }}</h1>
    </div>

    <div class="card">
        <i class="bi bi-people" style="color:#8B5CF6;"></i>
        <h4>Jumlah Kelas</h4>
        <h1>{{ $kelas }}</h1>
    </div>

    <div class="card">
        <i class="bi bi-people"></i>
        <h4>Jumlah Siswa</h4>
        <h1>{{ $siswa }}</h1>
    </div>

    <div class="card">
        <i class="bi bi-calendar-check" style="color:#EF4444;"></i>
        <h4>Absensi Hari Ini</h4>
        <h1>{{ $absensi }}</h1>
    </div>

<div style="margin-top:35px;">

    <h3 style="margin-bottom:20px;color:#0F172A;">
      </h3>  ⚡ Akses Cepat

    <div class="cards">

        <a href="{{ route('guru.create') }}" class="card" style="text-decoration:none;">
            <i class="bi bi-person-plus-fill"></i>
            <h4>Tambah Guru</h4>
            <p style="margin-top:10px;color:#64748B;">
                Tambahkan data guru baru.
            </p>
        </a>

        <a href="{{ route('import.siswa') }}" class="card" style="text-decoration:none;">
            <i class="bi bi-upload"></i>
            <h4>Import Siswa</h4>
            <p style="margin-top:10px;color:#64748B;">
                Upload data siswa dari Excel.
            </p>
        </a>

        <a href="{{ route('absensi.index') }}" class="card" style="text-decoration:none;">
            <i class="bi bi-clipboard-check-fill"></i>
            <h4>Input Absensi</h4>
            <p style="margin-top:10px;color:#64748B;">
                Mulai mengisi absensi hari ini.
            </p>
        </a>

        <a href="{{ route('laporan.index') }}" class="card" style="text-decoration:none;">
            <i class="bi bi-bar-chart-fill"></i>
            <h4>Laporan</h4>
            <p style="margin-top:10px;color:#64748B;">
                Lihat laporan absensi.
            </p>
        </a>

    </div>

</div>

<script>
function updateClock(){

    const now = new Date();

    document.getElementById("jam").innerHTML =
        now.toLocaleTimeString('id-ID');

    document.getElementById("tanggal").innerHTML =
        now.toLocaleDateString('id-ID',{
            weekday:'long',
            day:'numeric',
            month:'long',
            year:'numeric'
        });

}

setInterval(updateClock,1000);

updateClock();
</script>

@endsection