@extends('layout')

@section('content')
<div class="container">
    <h1>Edit Mahasiswa</h1>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('students.form')

        <button class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
