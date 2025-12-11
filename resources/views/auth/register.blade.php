@extends('layouts.auth')

@section('content')
<style>
    body {
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.49), rgba(255,255,255,0.49)),
            url('http://localhost/student-management/public/images/login-bg.jpg') !important;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        min-height: 100vh;
        color: #fff;
    }

    .register-card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 40px;
        width: 100%;
        max-width: 460px;
        margin: auto;
        margin-top: 50px;
        animation: fadeIn 0.7s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .register-title {
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .btn-register {
        background-color: #4CA1AF;
        color: white;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-register:hover {
        background-color: #3b8a97;
    }

    .text-center a {
        color: #4CA1AF;
        font-weight: 600;
    }
</style>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">

    <div class="register-card">
        <h2 class="register-title">Buat Akun</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input id="name" type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" required
                    placeholder="Masukkan nama lengkap">

                @error('name')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" required
                    placeholder="Masukkan email">

                @error('email')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" required
                    placeholder="Masukkan password yang anda mau">

                @error('password')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input id="password_confirmation" type="password"
                    class="form-control" name="password_confirmation" required
                    placeholder="Masukkan password yang sama seperti di atas">
            </div>

            <button type="submit" class="btn btn-register w-100 py-2">Daftar</button>

            <div class="text-center mt-3">
                <p>Sudah punya akun? <a href="{{ route('login.form') }}">Login</a></p>
            </div>

        </form>
    </div>

</div>

@endsection
