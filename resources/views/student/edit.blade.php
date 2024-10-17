@extends('layouts.template')

@section('content')
<form action="{{ route('student.update', $student['id']) }}" method="POST" class="card p-5">
    @csrf
    @method('PATCH')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
@endif


    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama Siswa:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ $student['name'] }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="nis" class="col-sm-2 col-form-label">NIS:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nis" name="nis" value="{{ $student['nis'] }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="rombel" class="col-sm-2 col-form-label">Rombel:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="rombel" name="rombel" value="{{ $student['rombel'] }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="rayon" class="col-sm-2 col-form-label">Rayon:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="rayon" name="rayon" value="{{ $student['rayon'] }}">
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
</form>
@endsection
