
@extends('layouts.template')

@section('content')
@if (Session('failed'))
<div class="alert alert-danger">
{{ Session('failed') }}
</div>
@endif
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="jumbotron py-4 px-5" >
    <h1 class="display-4">
        Selamat Datang  {{ Auth::user()->name}}!
    </h1>
    <hr class="my-4">
    <p>Aplikasi ini digunakan untuk menyimpan data siswa. Aplikasi ini akan digunakan oleh admin untuk mengelola dan memeriksa data siswa dan juga mengelola siapa saja yang dapat mengakses aplikasi dengan menambahkan akun yang dapat mengakses. Terdapat juga pengguna yang membantu dalam pengelolaan data siswa.</p>


</div>


@endsection
