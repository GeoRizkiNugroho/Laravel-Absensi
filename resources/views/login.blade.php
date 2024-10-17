@extends('layouts.template')

@section('content')

@if (Session::get('failed'))
<div class="alert alert-danger">
    {{ Session::get('failed') }}
</div>
@endif
@if (Session::get('logout'))
<div class="alert alert-primary">
{{ Session::get('logout') }}
</div>
@endif
@if (Session::get('canAcces'))
    <div class="alert alert-danger">{{Session::get('canAcces')}}</div>
@endif
        <form action="{{ route('login.auth') }}" class="card p-5" method="POST">
            @csrf

            <p class="title">Welcome!</p>
            <form class="form">
              <input type="email" name="email" id="email" class="input" placeholder="Email" style="margin-bottom: 20px">
              @error('email')
              <small class="text-danger">{{$message}}</small>
              @enderror
              <input type="password" name="password" id="password" class="input" placeholder="Password" style="margin-bottom: 80px">
              @error('password')
              <small class="text-danger">{{$message}}</small>
              @enderror
              <button type="submit"class="form-btn">Log in</button>
            </form>

    </form>
<br>

@endsection

