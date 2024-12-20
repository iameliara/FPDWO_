@extends('layouts.main')

@section('menutitle', 'ADMIN')

@section('sidebar')
@guest('admin')
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'admin.login') active @endif" href="{{ route('admin.login') }}"><i class="bi bi-box-arrow-in-right me-2"></i> Login</a></li>    
@endguest
@auth('admin')
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'admin.dashboard') active @endif" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid me-2"></i> Dashboard</a></li>
    <li class="nav-item"><span class="nav-link disabled">MANAJEMEN PEGAWAI</span></li>
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'admin.pegawai.tambah') active @endif" href="{{ route('admin.pegawai.tambah') }}"><i class="bi bi-person-plus me-2"></i> Tambah Pegawai</a></li>
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'admin.pegawai.list') active @endif" href="{{ route('admin.pegawai.list') }}"><i class="bi bi-people me-2"></i> List Pegawai</a></li>
    <li class="nav-item"><span class="nav-link disabled">MANAJEMEN CUTI</span></li>
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'admin.cuti.buat') active @endif" href="{{ route('admin.cuti.buat') }}"><i class="bi bi-plus-lg me-2"></i> Tambah Pengajuan</a></li>
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'admin.cuti.list') active @endif" href="{{ route('admin.cuti.list') }}"><i class="bi bi-list-ul me-2"></i> List Pengajuan</a></li>
    <li class="nav-item"><span class="nav-link disabled">MANAJEMEN PERUSAHAAN</span></li>
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'admin.perusahaan.identitas') active @endif" href="{{ route('admin.perusahaan.identitas') }}"><i class="bi bi-building me-2"></i> Identitas Perusahaan</a></li>
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'admin.perusahaan.logo') active @endif" href="{{ route('admin.perusahaan.logo') }}"><i class="bi bi-image me-2"></i> Logo Perusahaan</a></li>
    <li class="nav-item"><a class="nav-link link-light nav-menu @if (Route::currentRouteName() === 'admin.perusahaan.pejabat') active @endif" href="{{ route('admin.perusahaan.pejabat') }}"><i class="bi bi-person me-2"></i> Pejabat Perusahaan</a></li>
    <li class="nav-item"><span class="nav-link disabled">SESI</span></li>
    <li class="nav-item"><a class="nav-link link-light" href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
@endauth
@endsection

