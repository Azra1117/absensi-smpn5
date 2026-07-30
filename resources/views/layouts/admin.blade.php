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
    --primary-dark:#1D4ED8;
    --sidebar:#0F172A;
    --sidebar2:#1E3A8A;
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
    color:var(--text);
}

/* Scrollbar */

::-webkit-scrollbar{
    width:7px;
}

::-webkit-scrollbar-thumb{
    background:#CBD5E1;
    border-radius:50px;
}

/* ===========================
SIDEBAR
=========================== */

.sidebar{

    position:fixed;

    top:20px;

    left:20px;

    bottom:20px;

    width:280px;

    background:linear-gradient(180deg,var(--sidebar),var(--sidebar2));

    border-radius:24px;

    overflow:auto;

    box-shadow:0 15px 40px rgba(0,0,0,.15);

    transition:.3s;

    z-index:1000;

}

.logo{

    text-align:center;

    padding:30px 20px;

    border-bottom:1px solid rgba(255,255,255,.08);

}

.logo img{

    width:90px;

    height:90px;

    border-radius:50%;

    object-fit:cover;

    border:4px solid rgba(255,255,255,.15);

}

.logo h3{

    color:white;

    margin-top:15px;

    font-weight:700;

}

.logo p{

    color:#CBD5E1;

    margin-top:5px;

    font-size:13px;

}

/* Menu */

.menu{

    padding:18px;

}

.menu-title{

    color:#94A3B8;

    font-size:12px;

    text-transform:uppercase;

    letter-spacing:1px;

    margin-bottom:12px;

    padding-left:12px;

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

    transform:translateX(5px);

}

.menu a.active{

    background:var(--primary);

    color:white;

}

.menu i{

    font-size:20px;

}

/* ===========================
CONTENT
=========================== */

.content{

    margin-left:320px;

    padding:20px;

}

.navbar{

    background:white;

    border-radius:20px;

    padding:20px 30px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:0 8px 25px rgba(0,0,0,.05);

}

.page-title{

    font-size:25px;

    font-weight:700;

}

.page-subtitle{

    color:var(--text2);

    margin-top:4px;

    font-size:14px;

}

.logout-btn{

    background:var(--danger);

    color:white;

    border:none;

    border-radius:12px;

    padding:11px 18px;

    font-weight:600;

    transition:.25s;

}

.logout-btn:hover{

    background:#DC2626;

}

.main{

    margin-top:25px;

}

/* ===========================
CARD
=========================== */

.card-modern{

    background:white;

    border-radius:20px;

    padding:24px;

    box-shadow:0 10px 25px rgba(15,23,42,.05);

}

/* ===========================
FORM
=========================== */

.form-control,
.form-select{

    border-radius:12px;

    min-height:48px;

}

.form-control:focus,
.form-select:focus{

    box-shadow:0 0 0 .2rem rgba(37,99,235,.15);

}

/* ===========================
BUTTON
=========================== */

.btn{

    border-radius:12px !important;

    font-weight:600;

}

/* ===========================
TABLE
=========================== */

.table{

    margin-bottom:0;

}

.table thead{

    background:#EFF6FF;

}

.table thead th{

    border:none;

    color:#1E3A8A;

}

.table td{

    vertical-align:middle;

}

/* ===========================
FOOTER
=========================== */

.footer{

    margin-top:30px;

    background:white;

    border-radius:20px;

    padding:18px 24px;

    display:flex;

    justify-content:space-between;

    color:#64748B;

}

/* ===========================
RESPONSIVE
=========================== */

.menu-toggle{

    display:none;

}

.sidebar-overlay{

    display:none;

}

@media(max-width:768px){

    .sidebar{

        left:0;

        top:0;

        bottom:0;

        width:260px;

        border-radius:0;

        transform:translateX(-100%);

    }

    .sidebar.show{

        transform:translateX(0);

    }

    .content{

        margin-left:0;

        padding:15px;

    }

    .navbar{

        padding:18px;

    }

    .menu-toggle{

        display:flex;

        align-items:center;

        justify-content:center;

        width:45px;

        height:45px;

        border:none;

        border-radius:12px;

        background:var(--primary);

        color:white;

        font-size:24px;

    }

    .sidebar-overlay{

        position:fixed;

        inset:0;

        background:rgba(0,0,0,.35);

        display:none;

        z-index:999;

    }

    .sidebar-overlay.show{

        display:block;

    }

    .page-subtitle{

        display:none;

    }

    .footer{

        flex-direction:column;

        gap:10px;

        text-align:center;

    }

}
</style>


</head>

<body>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">

    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo SMPN 5">

        <h3>SMP Negeri 5</h3>

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

        <div class="menu-title mt-4">
             Analitik
        </div>

        <a href="{{ route('laporan.index') }}"
           class="{{ request()->is('laporan*') ? 'active' : '' }}">

            <i class="bi bi-bar-chart-line"></i>
            <span>Laporan</span>

        </a>

        <a href="{{ route('kalender.index') }}"
   class="{{ request()->is('kalender-akademik*') ? 'active' : '' }}">

    <i class="bi bi-calendar-event"></i>

    <span>Kalender Akademik</span>

</a>

        <a href="{{ route('rekap.index') }} "
        class="{{ request()->is('rekap-absensi*') ? 'active' : ' ' }}">   

        <i class="bi bi-clipboard-data"></i >
        <sp>Rekap Absensi</sp an>

        </a>

    </div>

</aside>

<div class="content">

    <div class="navbar">

        <div class="d-flex align-items-center gap-3">

            <button class="menu-toggle" id="menuToggle">

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

            <button type="submit" class="logout-btn">

                <i class="bi bi-box-arrow-right"></i>

                Logout

            </button>

        </form>

    </div>

    <main class="main">

        @yield('content')

    </main>

        <footer class="footer">

        <div>
            © {{ date('Y') }} SMP Negeri 5 Tambun Utara
        </div>

        <div>
            Monitoring Absensi Versi 1.0
        </div>

    </footer>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const menuToggle = document.getElementById("menuToggle");

    if(menuToggle){

        menuToggle.addEventListener("click", function(){

            sidebar.classList.toggle("show");
            overlay.classList.toggle("show");

        });

    }

    if(overlay){

        overlay.addEventListener("click", function(){

            sidebar.classList.remove("show");
            overlay.classList.remove("show");

        });

    }

    window.addEventListener("resize", function(){

        if(window.innerWidth > 768){

            sidebar.classList.remove("show");
            overlay.classList.remove("show");

        }

    });

});

</script>

</body>
</html>
