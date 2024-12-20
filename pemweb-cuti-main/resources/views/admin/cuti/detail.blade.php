@extends('layouts.admin')

@section('title', 'Detail Cuti Pegawai')

@section('content')
<nav class="navbar navbar-expand">
    <div class="container-fluid navbar-brand">DETAIL CUTI PEGAWAI</div>
</nav>
  <div class="pb-3" style="text-align:right">
      <span class="badge {{ $warna[$riwayat_cuti->status_cuti] }}" style="font-size:15px; height:30px; width:90px">{{$riwayat_cuti->status_cuti}}</span>
  </div>
  <div class="container-fluid p-3 border">
    <table class="table" style="margin-top:-10px">
      <tbody>
        <tr>
          <td style="width:160px; padding:12px">Nama Pegawai</td>
          <td style="width:12px; padding:12px">:</td>
          <th style="padding:12px">{{$riwayat_cuti->pegawai->nama}}</th>
        </tr>
        <tr>
          <td style="width:160px; padding:12px">ID Pegawai</td>
          <td style="width:12px; padding:12px">:</td>
          <th style="padding:12px">{{$riwayat_cuti->pegawai->no_induk}}</th>
        </tr>
        <tr>
          <td style="width:160px; padding:12px">NIK</td>
          <td style="width:12px; padding:12px">:</td>
          <th style="padding:12px">{{$riwayat_cuti->pegawai->nik}}</th>
        </tr>
        <tr>
          <td style="width:160px; padding:12px">Departemen</td>
          <td style="width:12px; padding:12px">:</td>
          <th style="padding:12px">{{$riwayat_cuti->pegawai->departemen->nama}}</th>
        </tr>
        <tr>
          <td style="width:160px; padding:12px">Alamat</td>
          <td style="width:12px; padding:12px">:</td>
          <th style="padding:12px">{{$riwayat_cuti->pegawai->alamat}}</th>
        </tr>
        <tr>
          <td style="width:160px; padding:12px">Jenis Cuti</td>
          <td style="width:12px; padding:12px">:</td>
          <th style="padding:12px">{{$riwayat_cuti->jenisCuti->nama}}</th>
        </tr>
        <tr>
          <td style="width:160px; padding:12px">Waktu Pengajuan</td>
          <td style="width:12px; padding:12px">:</td>
          <th style="padding:12px">{{$riwayat_cuti->created_at}}</th>
        </tr>
        <tr>
          <td style="width:160px; padding:12px">Awal Cuti</td>
          <td style="width:12px; padding:12px">:</td>
          <th style="padding:12px">{{$riwayat_cuti->tgl_awal_cuti}}</th>
        </tr>
        <tr>
          <td style="width:160px; padding:12px">Akhir Cuti</td>
          <td style="width:12px; padding:12px">:</td>
          <th style="padding:12px">{{$riwayat_cuti->tgl_akhir_cuti}}</th>
        </tr>
        <!-- <tr>
          <td style="width:160px; padding:12px">Cuti Tersisa</td>
          <td style="width:12px; padding:12px">:</td>
          <th style="padding:12px">Unknown</th>
        </tr> -->
      </tbody>
    </table>
      <div style="text-align:right">
        <a class="btn btn-primary btn-sm" href="{{ route('pegawai.cuti.status.buktipengajuan', ['cuti' => $riwayat_cuti->id]) }}" target="_blank">
          <i class="bi bi-download"></i>
           Surat Pengajuan
        </a>
        @if ($riwayat_cuti->status_cuti == 'approved')
          <a href="{{ route('pegawai.cuti.status.suratizin', ['cuti'=>$riwayat_cuti->id]) }}" download="">
            <button type="submit" class="btn btn-info btn-sm">
              <i class="bi bi-download"></i>
               Surat Izin Resmi
            </button>
          </a>
        @endif
      </div>
  </div>
  @if ($riwayat_cuti->status_cuti != 'approved')
    <div class="pt-3" style="text-align:right">
      <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reject-cuti">Reject</a>
      <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approve-cuti">Approve</a>
    </div>
  @endif
<div>
    <a class="btn btn-secondary nav-menu" href="{{ route('admin.cuti.list')}}" role="button">Back</a>
</div>
<div class="modal fade" id="approve-cuti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Setujui Pengajuan Cuti?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <a href="{{ route('admin.cuti.approve', ['cuti'=>$riwayat_cuti->id]) }}" type="button" class="btn btn-primary">Iya</a>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="reject-cuti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Tolak Pengajuan Cuti?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <a href="{{ route('admin.cuti.reject', ['cuti'=>$riwayat_cuti->id]) }}" type="button" class="btn btn-primary">Iya</a>
        </div>
      </div>
    </div>
  </div>
@endsection