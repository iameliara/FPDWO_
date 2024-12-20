@extends('layouts.pegawai')

@section('title', 'Status Cuti Pegawai')

@section('content')

<div class="container">
    <div class="row">
        <h4>Status Cuti Pegawai</h4><br><br>
        <span class="line"></span>
        <div class="form-group col-12 mb-3" style="text-align: left; line-height:25px">
            <div class="text-left">Waktu Pengajuan<span style="margin-left: 45px"></span>: <strong>{{$cuti->created_at}}</strong></div>
            <div class="text-left">NIK<span style="margin-left: 142px"></span>: <strong>{{$pegawai->nik}}</strong></div>
            <div class="text-left">Nama<span style="margin-left: 126px" class="tab"></span>: <strong>{{$pegawai->nama}}</strong></div>
            <div class="text-left">Departemen<span style="margin-left: 80px"></span>: <strong>{{$departemen->nama}}</strong></div>
        </div>
        <span class="line"></span>
        <p style="font-size:18px">Pengajuan cuti Anda sebagai berikut :</p>
        <div class="form-group col-md-6">
            <label for="awal-cuti">Tanggal Awal Cuti</label>
            <div class="input-group mb-auto">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="height: 100%"><i class="bi bi-calendar2"></i></span>
                </div>
                <input type="text" class="form-control" id="awal-cuti" name="tgl_awal_cuti"
                value="{{$cuti->tgl_awal_cuti}}" disabled style="font-size: 15px">
            </div>    
        </div>
        <div class="form-group col-md-6">
            <label for="awal-cuti">Tanggal Akhir Cuti</label>
            <div class="input-group mb-auto">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="height: 100%"><i class="bi bi-calendar2-check"></i></span>
                </div>
                <input type="text" class="form-control" id="akhir-cuti" name="tgl_akhir_cuti"
                value="{{$cuti->tgl_akhir_cuti}}" disabled style="font-size: 15px">
            </div>    
        </div>
        <div class="form-group col-md-12" id="alasan">
            <label for="awal-cuti">Alasan Cuti</label>
            <div class="input-group mb-auto">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="height: 100%"><i class="bi bi-file-text"></i></span>
                </div>
                <input type="text" class="form-control" id="alasan-cuti" disabled name="" value="{{$cuti->jenisCuti->nama}}">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="height: 100%"><i class="bi bi-file-text"></i></span>
                </div>
            </div>    
        </div>
        <div class="form-group col-md-12">
            <a href="{{ route('pegawai.cuti.status.buktipengajuan', ['cuti' => $cuti->id]) }}" target="_blank">
            <button type="submit" class="btn btn-primary" style="font-size:17px"><i class="bi bi-eye"></i>
                <span style="margin-left:6px"></span>Bukti Pengajuan</button>
            </a>
        </div>
        <h4><span class="badge {{ $warna[$cuti->status_cuti] }} mt-2 mb-0"
            style="font-size: 20px; height:38px;">{{$cuti->status_cuti}}</span></h4>
        @if ($cuti->status_cuti == 'approved')
            <a href="{{ route('pegawai.cuti.status.suratizin', ['cuti'=>$riwayat_cuti->id]) }}" download="">
                <button type="submit" class="btn btn-light btn-outline-dark " 
                style="font-size:15px; border:solid 2px black; border-radius: 15px"><i class="bi bi-download"></i>
                    <span style="margin-left:6px"></span>Download Surat Izin</button>

            </a>
        @endif
    </div>
</div>
@endsection

@push('header')

<style>
    .container{
        margin-top: 30px;
            border: solid 1px rgba(0, 0, 0, 0.267);
            padding: 40px;
            width: 480px;
            text-align: center;
            line-height: 2;
    }
    .line {
        display: inline-block;
        width: 100%;
        border-top: 0.2px solid rgba(0, 0, 0, 0.267);
        margin-bottom: 20px;
    }
    .form-group input{
        background-color: transparent;
        text-align: center;
    }
    #alasan {
        margin-bottom: 25px;
    }
</style>

@endpush

