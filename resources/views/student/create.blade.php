@extends('layouts.template')

@section('content')
<main class="main">
    <div class="container mt-5">
        <form action="{{ route('student.store') }}" method="POST" class="card p-5">
            @csrf

            @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
        </ul>
    @endif

    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nis" class="col-sm-2 col-form-label">NIS :</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="nis" name="nis" value="{{ old('nis') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="rombel" name="rombel" value="{{ old('rombel') }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="rayon" class="col-sm-2 col-form-label">Rayon :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="rayon" name="rayon" value="{{ old('rayon') }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>

</form>


</div>
</main>
@endsection
