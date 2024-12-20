@extends('layouts.main')

@section('menutitle', 'PEGAWAI')

@section('sidebar')
@guest('pegawai')
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'pegawai.login') active @endif" href="{{ route('pegawai.login') }}"><i class="bi bi-box-arrow-in-right me-2"></i> Login</a></li>    
@endguest
@auth('pegawai')
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'pegawai.dashboard') active @endif" href="{{ route('pegawai.dashboard') }}"><i class="bi bi-grid me-2"></i> Dashboard</a></li>
    <li class="nav-item"><span class="nav-link disabled">CUTI</span></li>
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'pegawai.cuti.ajukan') active @endif" href="{{ route('pegawai.cuti.ajukan') }}"><i class="bi bi-send me-2"></i> Ajukan Cuti</a></li>
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'pegawai.cuti.riwayat') active @endif" href="{{ route('pegawai.cuti.riwayat') }}"><i class="bi bi-clock-history me-2"></i> Riwayat Cuti</a></li>
    <li class="nav-item"><span class="nav-link disabled">SESI</span></li>
    <li class="nav-item"><a class="nav-link link-light" href="{{ route('pegawai.logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
@endauth
@endsection

