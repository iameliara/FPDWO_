@extends('layouts.pegawai')

@section('title', 'Riwayat Cuti Pegawai')

@section('content')
<div class="container">
    <h4>Riwayat Cuti Pegawai</h4><br>
    <span class="line"></span>        
    <table class="table table-striped table-bordered" style="text-align: center; width:90%; ">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tgl Awal Cuti</th>
                <th scope="col">Tgl Akhir Cuti</th>
                <th scope="col">Alasan</th>
                <th scope="col">Status</th>
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayat_cuti as $cuti)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{$cuti->tgl_awal_cuti}}</td>
                <td>{{$cuti->tgl_akhir_cuti}}</td>
                <td>{{$cuti->jenisCuti->nama}}</td>
                <td>{{$cuti->status_cuti}}</td>
                <td><a class="nav-menu" href="{{ route('pegawai.cuti.status', ['cuti'=>$cuti->id]) }}"><i class="bi bi-eye"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('header')
<style>
  td a{
    text-decoration: none;
    color: black;
    opacity: 0.7;
  }
  td a:hover{
    color: black;
    opacity: 1;
  }
  .container{
    display: flex;    
    flex-direction: column;
    align-items: center;
    width: 800px;
    padding: 40px 0px 40px 0px;
    margin-top: 40px;
    line-height: 2;
    border: solid 1px rgba(0, 0, 0, 0.267);


}
.line {
    display: inline-block;
    width: 90%;
    border-top: 0.2px solid rgba(0, 0, 0, 0.267);
    margin-bottom: 20px;
}

</style>
@endpush('header')
