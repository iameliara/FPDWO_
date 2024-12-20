@extends('layouts.admin')

@section('title', 'Edit Identitas Perusahaan')

@section('content')
<h3>Edit Identitas Perusahaan</h3>
<form method="post" action="{{ route('admin.perusahaan.identitas') }}">
    @csrf
    <div class="py-2">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" name="nama" value="{{ $identitas['nama'] }}">
    </div>
    <div class="py-2">
        <label class="form-label">Alamat</label>
        <textarea class="form-control" name="alamat" rows="5">{{ $identitas['alamat'] }}</textarea>
    </div>
    <div class="py-2">
        <label class="form-label">Telepon</label>
        <input type="text" class="form-control" name="telepon" value="{{ $identitas['telepon'] }}">
    </div>
    <div class="py-2">
        <button type="submit" class="btn btn-success"><i class="bi bi-send"></i> Simpan</button>
    </div>
</form>
@endsection

