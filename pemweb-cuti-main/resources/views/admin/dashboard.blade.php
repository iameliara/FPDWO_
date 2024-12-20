@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="pb-4">
    <h3>Pengajuan Cuti</h3>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="shadow bg-warning p-3 m-3">
                <h3>{{ $statistik['pending'] }}</h3>
                <p>Pengajuan pending</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="shadow bg-success text-light p-3 m-3">
                <h3>{{ $statistik['approved'] }}</h3>
                <p>Pengajuan diterima</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="shadow bg-danger text-light p-3 m-3">
                <h3>{{ $statistik['rejected'] }}</h3>
                <p>Pengajuan ditolak</p>
            </div>
        </div>
    </div>
</div>
<div class="pb-4">
    <h3>Riwayat Cuti</h3>
    <div class="row">
        @foreach ($daftarJenisCuti as $jenisCuti)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="shadow bg-info p-3 m-3">
                    <h3>{{ $jenisCuti->jumlah }}</h3>
                    <p>Pengajuan {{ $jenisCuti->nama }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

