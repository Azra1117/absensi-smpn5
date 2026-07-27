<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            display:flex;
            background:#f4f7fb;
        }

        .sidebar{

            width:260px;
            height:100vh;
            background:#1e40af;
            color:white;
            position:fixed;
            left:0;
            top:0;

        }

        .logo{

            text-align:center;
            padding:25px;

        }

        .logo img{

            width:90px;

        }

        .menu{

            margin-top:30px;

        }

        .menu a{

            display:block;
            color:white;
            text-decoration:none;
            padding:16px 25px;
            transition:.3s;

        }

        .menu a:hover{

            background:#2563eb;

        }

        .content{

            margin-left:260px;
            width:100%;

        }

        .navbar{

            height:70px;
            background:white;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:0 30px;
            box-shadow:0 3px 8px rgba(0,0,0,.1);

        }

        .main{

            padding:30px;

        }

        .active{
            background:#2563eb;
            border-left:5px solid white;
        }

    </style>

</head>

<body>

<div class="sidebar">

    <div class="logo">

        <img src="{{ asset('images/logo.jpg') }}">

        <h3>SMPN 5</h3>

    </div>

    <div class="menu">

        <<a href="/admin"
class="{{ request()->is('admin') ? 'active' : '' }}">
Dashboard
</a>

        <a href="/guru"
class="{{ request()->is('guru*') ? 'active' : '' }}">
Data Guru
</a>

        <a href="#">Data Staff</a>

        <a href="#">Data Siswa</a>

        <a href="#">Data Kelas</a>

        <a href="#">Absensi</a>

        <a href="#">Laporan</a>

    </div>

</div>

<div class="content">

    <div class="navbar">

        <h2>Dashboard Admin</h2>

        <form action="/logout" method="POST">

            @csrf

            <button>Logout</button>

        </form>

    </div>

    <div class="main">

        @yield('content')

    </div>

</div>

</body>
</html>