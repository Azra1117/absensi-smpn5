<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Monitoring Absensi')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

:root{

    --primary:#2563EB;
    --primary2:#3B82F6;

    --dark:#0F172A;

    --dark2:#1E293B;

    --bg:#F1F5F9;

    --white:#ffffff;

    --text:#0F172A;

    --text2:#64748B;

    --danger:#EF4444;

    --success:#22C55E;

    --warning:#F59E0B;

    --radius:18px;

}

*{

    margin:0;

    padding:0;

    box-sizing:border-box;

    font-family:'Poppins',sans-serif;

}

body{

    background:var(--bg);

    display:flex;

}

/* Scrollbar */

::-webkit-scrollbar{

    width:7px;

}

::-webkit-scrollbar-thumb{

    background:#CBD5E1;

    border-radius:50px;

}

/* ==========================
SIDEBAR
========================== */

.sidebar{

    position:fixed;

    left:20px;

    top:20px;

    bottom:20px;

    width:280px;

    background:linear-gradient(180deg,#0F172A,#1E3A8A);

    border-radius:25px;

    box-shadow:0 25px 45px rgba(15,23,42,.15);

    overflow:auto;

}

.logo{

    text-align:center;

    padding:35px 20px;

    border-bottom:1px solid rgba(255,255,255,.08);

}

.logo img{

    width:95px;

    height:95px;

    border-radius:50%;

    object-fit:cover;

    border:5px solid rgba(255,255,255,.15);

}

.logo h3{

    color:white;

    margin-top:15px;

    font-weight:700;

}

.logo p{

    color:#94A3B8;

    margin-top:6px;

    font-size:13px;

}

/* ==========================
MENU
========================== */

.menu{

    padding:18px;

}

.menu-title{

    color:#94A3B8;

    font-size:12px;

    text-transform:uppercase;

    margin:15px 0;

    padding-left:12px;

    letter-spacing:1px;

}

.menu a{

    display:flex;

    align-items:center;

    gap:14px;

    color:#CBD5E1;

    text-decoration:none;

    padding:15px 18px;

    border-radius:14px;

    margin-bottom:8px;

    transition:.25s;

}

.menu a:hover{

    background:rgba(255,255,255,.08);

    color:white;

    transform:translateX(6px);

}

.menu a i{

    font-size:20px;

}

.active{

    background:var(--primary);

    color:white !important;

    box-shadow:0 15px 30px rgba(37,99,235,.35);

}

/* ==========================
CONTENT
========================== */

.content{

    margin-left:320px;

    width:calc(100% - 320px);

    padding:20px;

}

.navbar{

    background:white;

    border-radius:22px;

    padding:22px 30px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:0 10px 35px rgba(15,23,42,.06);

}

.page-title{

    font-size:25px;

    font-weight:700;

    color:var(--text);

}

.page-subtitle{

    margin-top:3px;

    color:var(--text2);

    font-size:14px;

}

.logout-btn{

    background:var(--danger);

    color:white;

    border:none;

    border-radius:12px;

    padding:12px 20px;

    cursor:pointer;

    font-weight:600;

    transition:.3s;

}

.logout-btn:hover{

    background:#DC2626;

    transform:translateY(-2px);

}

.main{

    margin-top:25px;

}

/* ==========================
CARD
========================== */

.card-modern{

    background:white;

    border-radius:22px;

    padding:25px;

    box-shadow:0 10px 35px rgba(15,23,42,.05);

    transition:.25s;

}

.card-modern:hover{

    transform:translateY(-5px);

    box-shadow:0 18px 40px rgba(15,23,42,.08);

}

/* ==========================
FORM
========================== */

.form-control,
.form-select{

    border-radius:12px !important;

    border:1px solid #CBD5E1;

    height:48px;

    box-shadow:none !important;

}

.form-control:focus,
.form-select:focus{

    border-color:var(--primary);

    box-shadow:0 0 0 .2rem rgba(37,99,235,.15) !important;

}

/* ==========================
BUTTON
========================== */

.btn{

    border:none !important;

    border-radius:12px !important;

    padding:10px 18px !important;

    font-weight:600 !important;

    transition:.25s;

}

.btn:hover{

    transform:translateY(-2px);

}

/* ==========================
TABLE
========================== */

.table{

    border-radius:18px;

    overflow:hidden;

    background:white;

}

.table thead{

    background:#EFF6FF;

}

.table thead th{

    color:#1E3A8A;

    font-weight:600;

    border:none;

}

.table td{

    vertical-align:middle;

}

.table tbody tr{

    transition:.2s;

}

.table tbody tr:hover{

    background:#F8FAFC;

}

/* ==========================
BADGE
========================== */

.badge{

    border-radius:50px;

    padding:8px 14px;

    font-weight:500;

}

/* ==========================
RESPONSIVE
========================== */

@media(max-width:992px){

.sidebar{

left:0;

top:0;

bottom:0;

border-radius:0;

width:250px;

}

.content{

margin-left:250px;

width:calc(100% - 250px);

}

}

@media(max-width:768px){

.sidebar{

transform:translateX(-100%);

transition:.3s;

}

.sidebar.show{

transform:translateX(0);

}

.content{

margin-left:0;

width:100%;

padding:15px;

}

.navbar{

padding:18px;

}

.page-title{

font-size:20px;

}

}

</style>

</head>
<script>

const sidebar = document.querySelector('.sidebar');

const overlay = document.getElementById('sidebarOverlay');

const menu = document.getElementById('menuToggle');

menu?.addEventListener('click',()=>{

    sidebar.classList.toggle('show');

    overlay.classList.toggle('show');

});

overlay?.addEventListener('click',()=>{

    sidebar.classList.remove('show');

    overlay.classList.remove('show');

});

window.addEventListener('resize',()=>{

    if(window.innerWidth>768){

        sidebar.classList.remove('show');

        overlay.classList.remove('show');

    }

});

</script>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar">

<div class="logo">

<img src="{{ asset('images/logo.jpg') }}" class="img-fluid">

<h3>SMPN 5</h3>

<p>Monitoring Absensi</p>

</div>

<div class="menu">

<div class="menu-title">

Menu Utama

</div>

<a href="{{ url('/admin') }}"
class="{{ request()->is('admin') ? 'active' : '' }}">

<i class="bi bi-speedometer2"></i>

<span>Dashboard</span>

</a>

<a href="{{ route('guru.index') }}"
class="{{ request()->is('guru*') ? 'active' : '' }}">

<i class="bi bi-person-workspace"></i>

<span>Data Guru</span>

</a>

<a href="#">

<i class="bi bi-people-fill"></i>

<span>Data OSIS</span>

</a>

<a href="{{ route('import.siswa') }}"
class="{{ request()->is('import-siswa') ? 'active' : '' }}">

<i class="bi bi-file-earmark-arrow-up"></i>

<span>Import Siswa</span>

</a>

<a href="{{ route('kelas.index') }}"
class="{{ request()->is('kelas*') ? 'active' : '' }}">

<i class="bi bi-building"></i>

<span>Data Kelas</span>

</a>

<a href="{{ route('absensi.index') }}"
class="{{ request()->is('absensi*') ? 'active' : '' }}">

<i class="bi bi-clipboard-check"></i>

<span>Absensi</span>

</a>

<a href="{{ route('laporan.index') }}"
class="{{ request()->is('laporan*') ? 'active' : '' }}">

<i class="bi bi-bar-chart-line"></i>

<span>Laporan</span>

</a>

</div>

</div>

<div class="content">

<div class="navbar">

    <div class="d-flex align-items-center gap-3">

        <button class="menu-toggle d-md-none" id="menuToggle">
            <i class="bi bi-list"></i>
        </button>

        <div>
            <div class="page-title">
                Halo, {{ Auth::user()->name }} 👋
            </div>

            <div class="page-subtitle">
                Selamat datang di Sistem Monitoring Absensi SMP Negeri 5 Tambun Utara
            </div>
        </div>

    </div>

    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button class="logout-btn">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </button>
    </form>

</div>

<div>

<div class="page-title">

Halo, {{ Auth::user()->name }} 👋

</div>

<div class="page-subtitle">

Selamat datang di Sistem Monitoring Absensi SMP Negeri 5 Tambun Utara

</div>

</div>

<form action="{{ url('/logout') }}" method="POST">

@csrf

<button class="logout-btn">

<i class="bi bi-box-arrow-right"></i>

Logout

</button>

</form>

</div>

<div class="main">

@yield('content')

</div>

<footer class="footer">

    <div>

        © {{ date('Y') }} SMP Negeri 5 Tambun Utara

    </div>

    <div>

        Monitoring Absensi Versi 1.0

    </div>

</footer>

</div>

<style>

/* ===========================
FOOTER
=========================== */

.footer{

    margin-top:35px;

    background:white;

    border-radius:20px;

    padding:18px 25px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    color:#64748B;

    box-shadow:0 10px 25px rgba(15,23,42,.05);

    font-size:14px;

}

/* ===========================
CARD TITLE
=========================== */

.card-title{

    font-size:20px;

    font-weight:700;

    color:#0F172A;

    margin-bottom:20px;

}

/* ===========================
CARD HEADER
=========================== */

.card-header-modern{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:20px;

}

/* ===========================
SEARCH BOX
=========================== */

.search-box{

    position:relative;

}

.search-box i{

    position:absolute;

    top:50%;

    left:15px;

    transform:translateY(-50%);

    color:#94A3B8;

}

.search-box input{

    padding-left:45px !important;

}

/* ===========================
TABLE
=========================== */

.table{

    margin-bottom:0;

}

.table tbody td{

    padding:15px;

}

.table thead th{

    padding:15px;

}

/* ===========================
ANIMATION
=========================== */

.fade-up{

    animation:fadeUp .45s ease;

}

@keyframes fadeUp{

0%{

opacity:0;

transform:translateY(20px);

}

100%{

opacity:1;

transform:translateY(0);

}

}

/* ===========================
CUSTOM SCROLL
=========================== */

.sidebar::-webkit-scrollbar{

    width:6px;

}

.sidebar::-webkit-scrollbar-thumb{

    background:#475569;

    border-radius:20px;

}

.table{

    border-radius:18px;

    overflow:hidden;

    white-space:nowrap;

}

.table td{

    vertical-align:middle;

}

.table th{

    white-space:nowrap;

}

.table-responsive{

    border-radius:18px;

}

.btn{

    min-height:45px;

}

@media(max-width:768px){

.btn{

    width:100%;

    margin-bottom:10px;

}

}

.form-control,
.form-select{

    min-height:48px;

    font-size:15px;

}

label{

    margin-bottom:7px;

    font-weight:600;

}

.card-modern{

transition:.25s ease;

}

.card-modern:hover{

transform:translateY(-5px);

box-shadow:0 18px 40px rgba(15,23,42,.08);

}

button:active{

transform:scale(.98);

}

/* ===========================
RESPONSIVE
=========================== */

@media(max-width:768px){

.footer{

flex-direction:column;

gap:10px;

text-align:center;

}

}

</style>
/* ===========================
   MOBILE SIDEBAR
=========================== */

.menu-toggle{

    width:45px;
    height:45px;

    border:none;

    border-radius:12px;

    background:#2563EB;

    color:white;

    font-size:24px;

    display:flex;

    align-items:center;

    justify-content:center;
}

.sidebar-overlay{

    position:fixed;

    inset:0;

    background:rgba(15,23,42,.45);

    opacity:0;

    visibility:hidden;

    transition:.3s;

    z-index:998;
}

.sidebar-overlay.show{

    opacity:1;

    visibility:visible;
}

.sidebar{

    z-index:999;
}

@media(max-width:768px){

    .navbar{

        gap:15px;

    }

    .page-subtitle{

        display:none;

    }

    .logout-btn{

        padding:10px 14px;

    }

}

</body>
</html>