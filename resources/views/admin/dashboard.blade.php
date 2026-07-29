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

.stat-card{
    background:#fff;
    border-radius:20px;
    padding:24px;
    box-shadow:0 10px 25px rgba(15,23,42,.06);
    transition:.25s;
    position:relative;
    overflow:hidden;
}

.stat-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 35px rgba(37,99,235,.12);
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
    <div class="stat-card">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h4>Jumlah Guru</h4>

            <h1>{{ number_format($guru) }}</h1>

            <small>Guru Aktif</small>

        </div>

        <div class="stat-icon">

            <i class="bi bi-person-video3"></i>

        </div>

    </div>

</div>
}

.quick-card{

display:block;

background:white;

padding:22px;

border-radius:20px;

transition:.25s;

box-shadow:0 8px 25px rgba(15,23,42,.05);

}

.quick-card:hover{

transform:translateY(-5px);

}

.stat-card::before{

content:"";

position:absolute;

left:0;

top:0;

bottom:0;

width:6px;

background:#2563EB;

}

.stat-icon{

width:70px;
height:70px;

border-radius:18px;

display:flex;

align-items:center;

justify-content:center;

background:#EFF6FF;

}

.stat-icon i{

font-size:34px;

opacity:1;

}

.dashboard-clock{

background:white;

padding:20px;

border-radius:20px;

box-shadow:0 10px 25px rgba(15,23,42,.05);

min-width:240px;

text-align:center;

}

.dashboard-header{

display:flex;

justify-content:space-between;

align-items:center;

gap:20px;

flex-wrap:wrap;

}

@media(max-width:768px){

.dashboard-clock{

width:100%;

}

.dashboard-title{

font-size:24px;

}

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

    <div class="stat-card">
        <i class="bi bi-person-video3" style="color:#2563EB;"></i>
        <h4>Jumlah Guru</h4>
        <h1>{{ number_format($guru) }}</h1>
        <small style="color:#94A3B8;">
            Guru Aktif
        </small>
    </div>

    <div class="stat-card">
        <i class="bi bi-person-badge" style="color:#22C55E;"></i>
        <h4>Jumlah Staff</h4>
        <h1>{{ $staff }}</h1>
    </div>

    <div class="stat-card">
        <i class="bi bi-people" style="color:#8B5CF6;"></i>
        <h4>Jumlah Kelas</h4>
        <h1>{{ $kelas }}</h1>
    </div>

    <div class="stat-card">
        <i class="bi bi-people"></i>
        <h4>Jumlah Siswa</h4>
        <h1>{{ $siswa }}</h1>
    </div>

    <div class="stat-card">
        <i class="bi bi-calendar-check" style="color:#EF4444;"></i>
        <h4>Absensi Hari Ini</h4>
        <h1>{{ $absensi }}</h1>
    </div>
</div>

<div style="margin-top:35px;">

    <h3 style="margin-bottom:20px;color:#0F172A;">
       ⚡ Akses Cepat
    </h3> 

    <div class="stat-card">

        <a href="{{ route('guru.create') }}" class="quick-card" style="text-decoration:none;">
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