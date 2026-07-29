<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMP Negeri 5 Tambun Utara</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif}
    body{min-height:100vh;background:linear-gradient(135deg,#2563EB,#10B981);display:flex;align-items:center;justify-content:center;padding:24px}
    .wrap{
    width:100%;
    max-width:1150px;
    background:#fff;
    border-radius:22px;
    overflow:hidden;
    display:grid;
    grid-template-columns:1fr 1fr;
    box-shadow:0 20px 50px rgba(0,0,0,.15);
    transition:.3s;
}
.wrap:hover{
    transform:translateY(-3px);
    box-shadow:0 35px 70px rgba(0,0,0,.18);
}
    .left{
    padding:55px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}
    .logo{
    display:flex;
    align-items:center;
    gap:18px;
    margin-bottom:35px;
}
    .logo img{
    width:72px;
    height:72px;
    background:#fff;
    padding:5px;
    border-radius:50%;
}
    h1{
    font-size:34px;
    color:#2563EB;
    font-weight:700;
    line-height:1.2;
}
    p{
    color:#64748B;
    font-size:17px;
}
    label{
    display:block;
    margin-top:22px;
    margin-bottom:8px;
    font-weight:600;
    color:#334155;
}
    input{
    width:100%;
    padding:16px;
    border:1px solid #dbe3ea;
    border-radius:12px;
    transition:.25s;
}
input:focus{
    outline:none;
    border-color:#2563EB;
    box-shadow:0 0 0 4px rgba(37,99,235,.15);
}
    .pass{position:relative}
    .pass button{
    position:absolute;
    right:18px;
    top:50%;
    transform:translateY(-50%);
    background:none;
    border:none;
    cursor:pointer;
    color:#64748B;
    font-size:20px;
}
    .btn{
    width:100%;
    margin-top:24px;
    padding:16px;
    border:none;
    border-radius:12px;
    background:#2563EB;
    color:#fff;
    font-weight:600;
font-size:17px;
letter-spacing:.3px;
    cursor:pointer;
    transition:.25s;
}
.btn:hover{
    background:#1D4ED8;
    transform:translateY(-2px);
}
    .alert{background:#FEE2E2;color:#B91C1C;padding:12px;border-radius:10px;margin-bottom:16px}
    .right{position:relative}
    .right img{width:100%;height:100%;object-fit:cover}
    .overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(
        rgba(37,99,235,.75),
        rgba(16,185,129,.45)
    );
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    text-align:center;
    padding:40px;
}
    @media(max-width:768px){
      .wrap{grid-template-columns:1fr}
      .right{display:none}
      .left{padding:28px}
    }
    </style>
</head>
<body>
<div class="wrap">
<div class="left">
<div class="logo">
<img src="{{ asset('images/logo.jpg') }}" alt="Logo">
<div>
<h1>SMP Negeri 5</h1>
<p>Sistem Informasi Absensi Guru & Staff</p>
</div>
</div>

@if(session('error'))
<div class="alert">{{ session('error') }}</div>
@endif

<form action="{{ url('/login') }}" method="POST">
@csrf

<label>Username</label>
<input type="text" name="username" value="{{ old('username') }}" required>

<label>Password</label>
<div class="pass">
<input id="password" type="password" name="password" required>
<button type="button" onclick="togglePass()">
<i id="eye" class="bi bi-eye"></i>
</button>
</div>

<button class="btn" type="submit">
<i class="bi bi-box-arrow-in-right"></i> Login
</button>
</form>
</div>

<div class="right">
<img src="{{ asset('images/gerbang.jpg') }}" alt="Sekolah">
<div class="overlay">
<div>
<h2>Monitoring Absensi Digital</h2>

<p>
SMP Negeri 5 Tambun Utara
</p>

<p style="margin-top:15px;font-size:15px">
Cepat • Akurat • Real Time
</p>
</div>
</div>
</div>
</div>

<script>
function togglePass(){
 const p=document.getElementById('password');
 const e=document.getElementById('eye');
 if(p.type==='password'){p.type='text';e.className='bi bi-eye-slash';}
 else{p.type='password';e.className='bi bi-eye';}
}
</script>
</body>
</html>
