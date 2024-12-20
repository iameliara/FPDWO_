@extends('layouts.admin')

@section('title', 'Tambah Pegawai')

@section('content')
    
<h1 class="display-6">Tambah/Edit Pegawai</h1>
<form class="row g-3 align-middle" style="margin-top: 30px;" action="{{route('admin.pegawai.tambah')}}" method="POST">
    @csrf
    <div class="card">
    <div class="form-floating col-12 mb-3" style="margin-top: 5px;">
        <input name="nama" type="text" class="form-control" id="nama" placeholder="NAMA">
        <label for="nama">Nama</label>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <div class="form-floating">
                <input name="nik" type="text" class="form-control" id="nik" placeholder="NIK">
                <label for="nik">NIK</label>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <div class="form-floating">
                <input name="no_induk" type="text" class="form-control" id="no_induk" placeholder="no_induk">
                <label for="no_induk">Nomor Induk</label>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="form-floating">
                <select name="jenis_kelamin" class="form-select" id="jkelamin" aria-label="JenisKelamin">
                  <option selected>-</option>
                  <option value="L">Laki-Laki</option>
                  <option value="P">Perempuan</option>
                </select>
                <label for="floatingSelect">Jenis Kelamin</label>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="form-floating">
                <select name="departemen" class="form-select" id="jkelamin" aria-label="JenisKelamin">
                  <option selected>-</option>
                  @foreach ($departemen as $dp)
                  <option value="{{$dp->id}}">{{$dp->nama}}</option>    
                  @endforeach
                </select>
                <label for="floatingSelect">Departemen</label>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="password" placeholder="password">
                <label for="password">Password</label>
            </div>
        </div>
    </div>
    <div class="form-floating col-12 mb-3">
        <input name="alamat" type="text" class="form-control" id="alamat" placeholder="ALAMAT">
        <label for="alamat">Alamat</label>
    </div>
</div>
<br>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection


