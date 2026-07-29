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
    .wrap{width:100%;max-width:1150px;background:#fff;border-radius:22px;overflow:hidden;display:grid;grid-template-columns:1fr 1fr;box-shadow:0 20px 50px rgba(0,0,0,.15)}
    .left{padding:48px}
    .logo{display:flex;align-items:center;gap:15px;margin-bottom:28px}
    .logo img{width:72px;height:72px}
    h1{font-size:30px;color:#2563EB}
    p{color:#64748B}
    label{display:block;margin-top:18px;margin-bottom:8px;font-weight:600}
    input{width:100%;padding:14px;border:1px solid #dbe3ea;border-radius:12px}
    .pass{position:relative}
    .pass button{position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer}
    .btn{width:100%;margin-top:24px;padding:14px;border:none;border-radius:12px;background:#2563EB;color:#fff;font-weight:700;cursor:pointer}
    .alert{background:#FEE2E2;color:#B91C1C;padding:12px;border-radius:10px;margin-bottom:16px}
    .right{position:relative}
    .right img{width:100%;height:100%;object-fit:cover}
    .overlay{position:absolute;inset:0;background:rgba(37,99,235,.35);display:flex;align-items:center;justify-content:center;color:#fff;text-align:center;padding:40px}
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
<p>Tambun Utara</p>
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
<img src="{{ asset('images/sekolah.jpg') }}" alt="Sekolah">
<div class="overlay">
<div>
<h2>Monitoring Absensi</h2>
<p>SMP Negeri 5 Tambun Utara</p>
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
