@extends('layout')

@section('content')
<style>
    /* Fullscreen fixed background layer (covers entire viewport) */
    .page-bg { position: relative; min-height: 100vh; }

    /* Pseudo-element makes the image full-screen and fixed behind content */
    .page-bg::before {
        content: "";
        position: fixed;
        inset: 0; /* top:0; right:0; bottom:0; left:0; */
        z-index: -1;
        background-image:
            linear-gradient(rgba(255,255,255,0.65), rgba(255,255,255,0.65)),
            url('http://localhost/student-management/public/images/user-bg.jpg');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    /* Keep navbar/card backgrounds slightly opaque so content stays readable */
    .card { background-clip: padding-box; }
</style>

<div class="bg-light min-vh-100 page-bg">
    <nav class="navbar navbar-dark position-fixed top-0 start-0 end-0 shadow-sm" style="background-color: #cff4fc; z-index: 999;">
        <div class="container-fluid py-2 px-4 d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <span class="fs-5 fw-bold text-dark">Student Portal</span>
                <span class="ms-3 text-muted small">Dashboard Mahasiswa</span>
            </a>

            <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container py-4">
        
        <div class="card shadow-sm border-0 mb-4" style="background-color: #e6f7ff; border-radius: 12px; border: 1px solid #b3e6ff;">
            <div class="card-body p-4 d-flex align-items-center">
                <h4 class="mb-0 text-dark">Selamat Datang, <b>{{ $student->nama }}</b>! 👋</h4>
                <p class="ms-auto mb-0 text-muted small d-none d-md-block">Kelola informasi akademik dan lihat data teman sekelas Anda</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Profil Saya</h5>
                        
                        <div class="d-flex flex-column align-items-center mb-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                                {{ strtoupper(substr($student->nama, 0, 2)) }}
                            </div>
                            <h6 class="fw-bold mb-0">{{ $student->nama }}</h6>
                            <p class="text-muted small mb-1">{{ $student->nim }}</p>
                            <span class="badge bg-secondary text-white">{{ $student->jurusan }}</span>
                        </div>
                        
                        <div class="mt-3 pt-3 border-top">
                            <p class="mb-2 d-flex align-items-center text-muted small">
                                <i class="bi bi-envelope me-2 text-primary"></i> 
                                <span class="text-dark">{{ $student->email }}</span>
                            </p>
                            <p class="mb-2 d-flex align-items-center text-muted small">
                                <i class="bi bi-telephone me-2 text-primary"></i> 
                                <span class="text-dark">{{ $student->telepon }}</span>
                            </p>
                            <p class="mb-0 d-flex align-items-center text-muted small">
                                <i class="bi bi-calendar me-2 text-primary"></i> 
                                Angkatan {{ $student->angkatan }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 col-lg-4">
                <div class="card shadow-sm h-100 d-flex justify-content-center" style="min-height: 150px;">
                    <div class="card-body d-flex flex-column align-items-start justify-content-center">
                        <p class="text-muted small mb-1">Angkatan</p>
                        <h2 class="display-4 fw-bold text-primary mb-2">{{ $student->angkatan }}</h2>
                        <i class="bi bi-mortarboard fs-3 text-secondary position-absolute bottom-0 end-0 p-3" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-4">
                <div class="card shadow-sm h-100 d-flex justify-content-center" style="min-height: 150px;">
                    <div class="card-body d-flex flex-column align-items-start justify-content-center">
                        <p class="text-muted small mb-1">Total Mahasiswa</p>
                        <h2 class="display-4 fw-bold text-success mb-2">{{ $totalStudents }}</h2>
                        <i class="bi bi-people-fill fs-3 text-success position-absolute bottom-0 end-0 p-3" style="opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <h3 class="fw-bold mb-2">Direktori Mahasiswa</h3>
        <p class="text-muted mb-4">Daftar mahasiswa di program studi Anda</p>
        
        <form action="{{ route('students.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" name="search" placeholder="Cari NIM / Nama / Jurusan / Angkatan..."
                       value="{{ request('search') }}"
                       class="form-control border-start-0" style="height: 45px;">
                <button type="submit" class="btn btn-primary d-none">Search</button>
            </div>
        </form>

        <div class="row g-4">
            @forelse ($classmates as $mate)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card shadow-sm h-100 border-0">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-size: 1rem;">
                                    {{ strtoupper(substr($mate->nama, 0, 2)) }}
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">{{ $mate->nama }}</h6>
                                    <p class="text-muted small mb-0">{{ $mate->nim }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-auto small pt-2">
                                <p class="mb-1 text-muted d-flex align-items-center">
                                    <i class="bi bi-book me-2"></i> {{ $mate->jurusan }}
                                </p>
                                <p class="mb-1 text-muted d-flex align-items-center">
                                    <i class="bi bi-envelope me-2"></i> {{ $mate->email }}
                                </p>
                                <p class="mb-1 text-muted d-flex align-items-center">
                                    <i class="bi bi-telephone me-2"></i> {{ $mate->telepon }}
                                </p>
                                <p class="mb-0 text-muted d-flex align-items-center">
                                    <i class="bi bi-calendar-check me-2"></i> Angkatan {{ $mate->angkatan }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Tidak ada teman sekelas lain yang ditemukan di jurusan Anda.
                    </div>
                </div>
            @endforelse
        </div>
        {{-- Jika Anda menggunakan Bootstrap 5 dan ingin ikon bi-*, pastikan Anda sudah melampirkan Bootstrap Icons CSS di layout Anda. --}}
        
    </div>
</div>
@endsection