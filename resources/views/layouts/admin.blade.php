<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','Monitoring Absensi')</title>
@vite(['resources/css/app.css','resources/js/app.js'])
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{--primary:#2563EB;--danger:#EF4444;--bg:#F1F5F9}
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins,sans-serif}
body{background:var(--bg)}
.sidebar{position:fixed;left:0;top:0;bottom:0;width:270px;background:linear-gradient(180deg,#0F172A,#1E3A8A);overflow:auto;color:#fff;transition:.3s;z-index:1040}
.logo{text-align:center;padding:28px 20px}.logo img{width:90px;height:90px;border-radius:50%}
.menu{padding:16px}.menu a{display:flex;gap:12px;padding:14px 16px;border-radius:12px;color:#dbeafe;text-decoration:none;margin-bottom:8px}.menu a.active,.menu a:hover{background:#2563EB;color:#fff}
.content{margin-left:270px;padding:24px}.topbar{background:#fff;padding:18px 22px;border-radius:18px;display:flex;justify-content:space-between;align-items:center}
.menu-toggle{display:none;width:44px;height:44px;border:none;border-radius:10px;background:#2563EB;color:#fff}.logout-btn{background:var(--danger);color:#fff;border:none;padding:10px 18px;border-radius:10px}.main{margin-top:24px}.footer{margin-top:24px;background:#fff;padding:16px;border-radius:16px;display:flex;justify-content:space-between}.sidebar-overlay{position:fixed;inset:0;background:rgba(0,0,0,.35);display:none;z-index:1030}.sidebar-overlay.show{display:block}
@media(max-width:768px){.sidebar{transform:translateX(-100%)}.sidebar.show{transform:translateX(0)}.content{margin-left:0;padding:16px}.menu-toggle{display:block}.page-subtitle{display:none}.footer{flex-direction:column;gap:8px;text-align:center}}
</style>
</head>
<body>
<div class="sidebar-overlay" id="overlay"></div>
<aside class="sidebar" id="sidebar">
<div class="logo"><img src="{{ asset('images/logo.jpg') }}"><h3>SMPN 5</h3><small>Monitoring Absensi</small></div>
<nav class="menu">
<a href="{{ url('/admin') }}" class="{{ request()->is('admin') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a>
<a href="{{ route('guru.index') }}" class="{{ request()->is('guru*') ? 'active' : '' }}"><i class="bi bi-person-workspace"></i><span>Data Guru</span></a>
<a href="{{ route('import.siswa') }}" class="{{ request()->is('import-siswa') ? 'active' : '' }}"><i class="bi bi-upload"></i><span>Import Siswa</span></a>
<a href="{{ route('kelas.index') }}" class="{{ request()->is('kelas*') ? 'active' : '' }}"><i class="bi bi-building"></i><span>Data Kelas</span></a>
<a href="{{ route('absensi.index') }}" class="{{ request()->is('absensi*') ? 'active' : '' }}"><i class="bi bi-clipboard-check"></i><span>Absensi</span></a>
<a href="{{ route('laporan.index') }}" class="{{ request()->is('laporan*') ? 'active' : '' }}"><i class="bi bi-bar-chart-line"></i><span>Laporan</span></a>
</nav></aside>
<div class="content">
<div class="topbar">
<div style="display:flex;align-items:center;gap:14px">
<button class="menu-toggle" id="toggle"><i class="bi bi-list"></i></button>
<div><div style="font-size:22px;font-weight:700">Halo, {{ Auth::user()->name }} 👋</div><div class="page-subtitle">Selamat datang di Sistem Monitoring Absensi</div></div>
</div>
<form action="{{ url('/logout') }}" method="POST">@csrf<button class="logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</button></form>
</div>
<div class="main">@yield('content')</div>
<footer class="footer"><div>© {{ date('Y') }} SMP Negeri 5 Tambun Utara</div><div>Monitoring Absensi v1.0</div></footer>
</div>
<script>
const s=document.getElementById('sidebar'),o=document.getElementById('overlay'),t=document.getElementById('toggle');
if(t){t.onclick=()=>{s.classList.toggle('show');o.classList.toggle('show');}}
o.onclick=()=>{s.classList.remove('show');o.classList.remove('show');}
</script>
</body>
</html>