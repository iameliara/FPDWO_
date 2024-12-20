@extends('layouts.admin')

@section('title', 'Pengajuan Cuti Pegawai')

@section('content')
<nav class="navbar navbar-expand">
    <div class="container-fluid navbar-brand">PENGAJUAN CUTI PEGAWAI</div>
    <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</nav>
<div class="container table-responsive">
    <table class="table table-striped table-hover">
      <thead class="table-dark text-center">
          <th>#</th>
          <th>WAKTU PENGAJUAN</th>
          <th>NAMA</th>
          <th>DEPARTEMEN</th>
          <th>JENIS CUTI</th>
          <th>RENTANG CUTI</th>
          <th>STATUS</th>
          <th>LIHAT</th>
      </thead>
      <tbody class="text-center">
        @foreach ($riwayat_cuti as $riwayatCuti)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$riwayatCuti->created_at}}</td>
                <td>{{$riwayatCuti->pegawai->nama}}</td>
                <td>{{$riwayatCuti->pegawai->departemen->nama}}</td>
                <td>{{$riwayatCuti->jenisCuti->nama}}</td>
                <td>{{$riwayatCuti->tgl_awal_cuti}} s/d {{$riwayatCuti->tgl_akhir_cuti}}</td>
                <td>
                    <span class="badge {{ $warna[$riwayatCuti->status_cuti] }}" style="font-size:15px; height:30px; width:90px">{{$riwayatCuti->status_cuti}}</span>
                </td>
                <td>
                    <a class="nav-menu" href="{{ route('admin.cuti.detail', ['cuti'=>$riwayatCuti->id]) }}"><i class="bi bi-eye btn-outline-primary"></i></a>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
@endsection
