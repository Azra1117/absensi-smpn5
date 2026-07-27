@extends('layouts.admin')

@section('title','Dashboard Admin')

@section('content')

<style>

.cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-top:30px;
}

.card{
    background:white;
    border-radius:15px;
    padding:25px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
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
    font-size:45px;
    float:right;
    color:#2563eb;
}

</style>

<h2>Selamat Datang, {{ auth()->user()->nama }}</h2>

<p>Dashboard Sistem Absensi Digital SMP Negeri 5 Tambun Utara</p>

<div class="cards">

    <div class="card">
        <i class="bi bi-person-video3"></i>
        <h4>Jumlah Guru</h4>
        <h1>{{ $guru }}</h1>
    </div>

    <div class="card">
        <i class="bi bi-person-badge"></i>
        <h4>Jumlah Staff</h4>
        <h1>{{ $staff }}</h1>
    </div>

    <div class="card">
        <i class="bi bi-people"></i>
        <h4>Jumlah Siswa</h4>
        <h1>{{ $siswa }}</h1>
    </div>

    <div class="card">
        <i class="bi bi-calendar-check"></i>
        <h4>Absensi Hari Ini</h4>
        <h1>{{ $absensi }}</h1>
    </div>

</div>

@endsection