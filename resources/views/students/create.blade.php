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
            linear-gradient(rgba(255, 255, 255, 0.04), rgba(255,255,255,0.04)),
            url('http://localhost/student-management/public/images/bahlul.jpg');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>
<div class="container page-bg py-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <h2 class="fw-bold mb-4 text-center">Tambah Mahasiswa</h2>

                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf

                        @include('students.form')

                        <div class="text-center">
                            <button class="btn btn-success px-4 mt-3">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
