@extends('layouts.pegawai')

@section('title', 'Login Pegawai')

@section('content')
<div class="h-100 d-flex flex-row justify-content-center align-items-center">
    <form class="form-signin" class="text-center" method="post" action="{{ route('pegawai.login') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">Sign In Pegawai</h1>
        <label for="inputEmail" class="sr-only">NIK</label>
        <input type="text" id="inputEmail" class="form-control" name="nik" placeholder="Masukkan NIK anda" value="{{ old('nik') }}" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Masukkan password anda" required>
        <button class="btn btn-lg btn-primary btn-block mt-2" type="submit">Sign in</button>
    </form>
</div>
@endsection

