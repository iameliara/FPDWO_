@extends('layouts.admin')

@section('title', 'Edit Pejabat Perusahaan')

@section('content')
<h3>Edit Pejabat Perusahaan</h3>
<form method="post" action="{{ route('admin.perusahaan.pejabat') }}">
    @csrf
    <div class="py-2">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" name="nama" value="{{ $pejabat['nama'] }}">
    </div>
    <div class="py-2">
        <label class="form-label">Jabatan</label>
        <input type="text" class="form-control" name="jabatan" value="{{ $pejabat['jabatan'] }}">
    </div>
    <div class="py-2">
        <button type="submit" class="btn btn-success"><i class="bi bi-send"></i> Simpan</button>
    </div>
</form>
@endsection

