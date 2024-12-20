@extends('layouts.admin')

@section('title', 'Login Admin')

@section('content')
<div class="h-100 d-flex flex-row justify-content-center align-items-center">
    <form class="form-signin" class="text-center" method="post" action="{{ route('admin.login') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">Sign In Admin</h1>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Masukkan email anda" value="{{ old('email') }}" required>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password"placeholder="Masukkan password anda" required>
        <button class="btn btn-lg btn-primary btn-block mt-2" type="submit">Sign in</button>
    </form>
</div>
@endsection

