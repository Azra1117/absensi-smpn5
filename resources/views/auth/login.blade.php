<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Absensi SMPN 5 Tambun Utara</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        body{
            margin:0;
            font-family:Arial, Helvetica, sans-serif;
            background:linear-gradient(135deg,#2563eb,#10b981);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .container{
            width:1200px;
            height:700px;
            background:white;
            border-radius:25px;
            overflow:hidden;
            display:flex;
            box-shadow:0 15px 40px rgba(0,0,0,.2);
        }

        .left{
            width:50%;
            padding:50px;
        }

        .right{
            width:50%;
            position:relative;
        }

        .right img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .overlay{
            position:absolute;
            inset:0;
            background:rgba(37,99,235,.35);
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            color:white;
            text-align:center;
        }

        .logo{
            display:flex;
            align-items:center;
            gap:20px;
            margin-bottom:50px;
        }

        .logo img{
            width:90px;
        }

        h1{
            color:#1d4ed8;
            margin:0;
            font-size:48px;
        }

        h2{
            margin-top:10px;
            color:#666;
            font-weight:400;
        }

        label{
            display:block;
            margin-top:25px;
            font-weight:bold;
            font-size:18px;
        }

        input{
            width:100%;
            padding:18px;
            margin-top:10px;
            border-radius:12px;
            border:1px solid #ccc;
            font-size:18px;
        }

        button{
            width:100%;
            padding:18px;
            margin-top:35px;
            background:#1d4ed8;
            color:white;
            border:none;
            border-radius:12px;
            font-size:20px;
            cursor:pointer;
            font-weight:bold;
        }

        button:hover{
            background:#1e40af;
        }

        .error{
            margin-top:15px;
            color:red;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="left">

        <div class="logo">

            <img src="{{ asset('images/logo.jpg') }}">

            <div>
                <h1>Sistem Absensi Digital</h1>
                <h2>SMP Negeri 5 Tambun Utara</h2>
            </div>

        </div>

        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST">

            @csrf

            <label>Username</label>

            <input
                type="text"
                name="username"
                placeholder="Masukkan Username"
                required>

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan Password"
                required>

            <button type="submit">
                LOGIN
            </button>

        </form>

    </div>

    <div class="right">

        <img src="{{ asset('images/gerbang.png') }}">

        <div class="overlay">

            <h1 style="color:white;">Selamat Datang</h1>

            <h2 style="color:white;">
                Sistem Absensi Digital
                <br>
                SMP Negeri 5 Tambun Utara
            </h2>

        </div>

    </div>

</div>

</body>
</html>