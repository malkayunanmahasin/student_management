@extends('layout')

@section('content')
<style>
    /* Background halaman students — overlay putih agar konten tetap terbaca */
    .page-bg {
        background-image:
            linear-gradient(rgba(255,255,255,0.85), rgba(255,255,255,0.85)),
            url('http://localhost/student-management/public/images/admin-bg.jpg') !important;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
    }
</style>
<div class="bg-light min-vh-80 page-bg">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gear-fill text-primary me-2" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.472 1.472 0 0 1-2.5 1.055l-.142-.146a1.472 1.472 0 0 0-2.001 2.001l.147.142a1.472 1.472 0 0 1-1.054 2.5l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.473 1.473 0 0 1 1.055 2.5l-.146.142a1.473 1.473 0 0 0 2.001 2.001l.142-.147a1.472 1.472 0 0 1 2.5 1.054l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.472 1.472 0 0 1 2.5-1.055l.142.146a1.472 1.472 0 0 0 2.001-2.001l-.147-.142a1.472 1.472 0 0 1 1.054-2.5l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.473 1.473 0 0 1-1.055-2.5l.146-.142a1.473 1.473 0 0 0-2.001-2.001l-.142.147a1.472 1.472 0 0 1-2.5-1.054l-.1-.34zM8 10.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                </svg>
                <span class="fs-5 fw-bold text-dark">Admin Panel</span>
                <span class="ms-3 text-muted small">Kelola Data Mahasiswa</span>
            </a>

            {{-- Logout button aligned right (uses hidden POST form for Laravel logout) --}}
            <div class="d-flex align-items-center m-0">
                <a href="{{ route('logout') }}" id="logout-button" class="btn btn-danger btn-sm" style="margin-right:0;">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container pt-4 pb-5">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h1 class="h3 fw-bold text-dark mb-0">Daftar Mahasiswa</h1>
                <p class="text-muted">Kelola data mahasiswa dengan mudah</p>
            </div>
            <a href="{{ route('students.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus me-1" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Tambah Mahasiswa
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <form action="{{ route('students.index') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0" id="search-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search text-muted" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </span>
                        <input type="text" name="search" placeholder="Cari NIM / Nama / Jurusan / Angkatan"
                               value="{{ request('search') }}"
                               class="form-control border-start-0" style="height: 40px;" aria-label="Search" aria-describedby="search-icon">
                    </div>
                    <button type="submit" class="btn btn-primary ms-3">Search</button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <p class="card-text text-muted mb-2">Total Mahasiswa</p>
                        <h2 class="display-6 fw-bold text-primary">
                            {{ 
                                method_exists($students, 'total') 
                                ? $students->total() 
                                : $students->count() 
                            }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <p class="card-text text-muted mb-2">Hasil Pencarian</p>
                        <h2 class="display-6 fw-bold text-dark">
                            {{ $students->count() }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <p class="card-text text-muted mb-2">Status</p>
                        <h2 class="display-6 fw-bold text-success">
                            Aktif
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-lg my-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="text-muted small">ID</th>
                                <th scope="col" class="text-muted small">NIM</th>
                                <th scope="col" class="text-muted small">Nama</th>
                                <th scope="col" class="text-muted small">Jurusan</th>
                                <th scope="col" class="text-muted small">Angkatan</th>
                                <th scope="col" class="text-muted small">Email</th>
                                <th scope="col" class="text-muted small">Telepon</th>
                                <th scope="col" class="text-muted small">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $s)
                                <tr>
                                    <td>{{ $s->id }}</td>
                                    <td>{{ $s->nim }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $s->jurusan }}</td>
                                    <td>{{ $s->angkatan }}</td>
                                    <td>{{ $s->email }}</td>
                                    <td>{{ $s->telepon }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="{{ route('students.edit', $s->id) }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form action="{{ route('students.destroy', $s->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Tidak ada data mahasiswa yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            @if(method_exists($students, 'links'))
                {{ $students->appends(request()->except('page'))->links() }}
            @endif
        </div>
    </div>
</div>
@endsection