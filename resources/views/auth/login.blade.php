@extends('layouts.login')

@section('content')

<div class="login-page">

    <div class="login-card">

        <div class="text-center mb-4">

            <img src="{{ asset('images/logo-sekolah.jpg') }}"
                 class="logo-login"
                 alt="Logo Sekolah">

            <h1>Monitoring Absensi Digital</h1>

            <h5>SMP Negeri 5 Tambun Utara</h5>

            <p>Cepat • Akurat • Real Time</p>

        </div>

        <form action="{{ url('/login') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    class="form-control"
                    required>

            </div>

            <div class="mb-4">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>

            </div>

            <button class="btn btn-primary w-100">

                Login

            </button>

        </form>

    </div>

</div>

@endsection