@extends('layouts.app')


@section('content')
<div class="container mx-auto px-4 py-6">

    {{-- Search Bar Global --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <form action="{{ route('students.search') }}" method="GET" class="w-1/3">
            <input type="text" name="keyword" class="border px-3 py-2 w-full rounded"
                   placeholder="Cari mahasiswa...">
        </form>
    </div>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white shadow rounded p-4 text-center">
            <h3 class="text-sm text-gray-500">Total Mahasiswa</h3>
            <p class="text-3xl font-bold">{{ $totalMahasiswa }}</p>
        </div>

        <div class="bg-white shadow rounded p-4 text-center">
            <h3 class="text-sm text-gray-500">Total Jurusan</h3>
            <p class="text-3xl font-bold">{{ $totalJurusan }}</p>
        </div>

        <div class="bg-white shadow rounded p-4 text-center">
            <h3 class="text-sm text-gray-500">Angkatan Aktif</h3>
            <p class="text-3xl font-bold">{{ count($angkatanAktif) }}</p>
        </div>

        <div class="bg-white shadow rounded p-4 text-center">
            <h3 class="text-sm text-gray-500">Mahasiswa Baru ({{ date('Y') }})</h3>
            <p class="text-3xl font-bold">{{ $mahasiswaBaru }}</p>
        </div>
    </div>

    {{-- Grafik Bagian --}}
    <div class="grid grid-cols-3 gap-6">
        
        {{-- Grafik Bar: Jumlah Mahasiswa per Jurusan --}}
        <div class="bg-white p-4 shadow rounded">
            <h3 class="font-bold mb-2">Mahasiswa per Jurusan</h3>
            <canvas id="jurusanChart"></canvas>
        </div>

        {{-- Grafik Pie: Komposisi Angkatan --}}
        <div class="bg-white p-4 shadow rounded">
            <h3 class="font-bold mb-2">Komposisi Angkatan</h3>
            <canvas id="angkatanPie"></canvas>
        </div>

        {{-- Grafik Line: Pendaftaran per Bulan --}}
        <div class="bg-white p-4 shadow rounded">
            <h3 class="font-bold mb-2">Pendaftaran per Bulan</h3>
            <canvas id="pendaftaranLine"></canvas>
        </div>

    </div>

    {{-- Menu Navigasi Cepat --}}
    <div class="mt-10">
        <h3 class="font-bold text-xl mb-3">Navigasi Cepat</h3>
        <div class="grid grid-cols-4 gap-4">
            <a href="{{ route('students.create') }}" class="bg-blue-500 text-white p-4 rounded shadow">
                ➕ Tambah Mahasiswa
            </a>

            <a href="{{ route('students.index') }}" class="bg-green-500 text-white p-4 rounded shadow">
                📋 Lihat Mahasiswa
            </a>

            <a href="#" class="bg-yellow-500 text-white p-4 rounded shadow">
                📚 Kelola Jurusan
            </a>

            <a href="{{ route('students.search') }}" class="bg-purple-500 text-white p-4 rounded shadow">
                🔍 Cari Mahasiswa
            </a>
        </div>
    </div>

    

</div>
@endsection
