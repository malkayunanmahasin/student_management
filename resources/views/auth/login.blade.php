@extends('layouts.auth')

@section('content')
<style>
    body {
        /* Ganti gradient jadi gambar + overlay (pakai URL absolut yang valid di lingkungan XAMPP) */
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.49), rgba(255,255,255,0.49)),
            url('http://localhost/student-management/public/images/login-bg.jpg') !important;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        min-height: 100vh;
        color: #fff;
    }

    .login-card {
        background: rgba(255,255,255,0.95);
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 40px;
        width: 100%;
        max-width: 420px;
        margin: auto;
        margin-top: 60px;
        animation: fadeIn 0.7s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-title {
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    /* Label & teks form lebih gelap untuk kontras */
    .form-label {
        color: #222 !important;
        font-weight: 600;
    }

    /* Pastikan judul juga tetap gelap pada card putih */
    .login-title {
        color: #222;
    }

    .btn-login {
        background-color: #4CA1AF;
        color: white;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-login:hover {
        background-color: #3b8a97;
        color: white;
    }

    .text-center a {
        color: #4CA1AF;
        font-weight: 600;
    }
</style>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">

    <div class="login-card">
        <h2 class="login-title">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email atau NIM</label>
                <input id="email" type="text" 
                    class="form-control @error('email') is-invalid @enderror" 
                    name="email" required autofocus
                   placeholder="Masukkan email atau NIM">

                @error('email')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input id="password" type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    name="password" required>

                @error('password')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <button type="submit" class="btn btn-login w-100 py-2">Login</button>

            <div class="text-center mt-3">
                <p style="color: #222; font-weight: 600;">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
            </div>

        </form>
    </div>

</div>
@endsection
