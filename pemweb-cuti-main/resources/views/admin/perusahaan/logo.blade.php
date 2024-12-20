@extends('layouts.admin')

@section('title', 'Edit Logo Perusahaan')

@section('content')
<h3>Edit Logo Perusahaan</h3>
<form method="post" action="{{ route('admin.perusahaan.logo') }}" enctype="multipart/form-data">
    @csrf
    @if ($logo['ada'])
        <div class="py-2">
            <img src="{{ route('admin.perusahaan.logo.img') }}">
        </div>
    @endif
    <div class="py-2">
        <label class="form-label">Upload File Logo</label>
        <input type="file" class="form-control" name="logo">
    </div>
    <div class="py-2">
        <button type="submit" class="btn btn-success"><i class="bi bi-send"></i> Simpan</button>
    </div>
</form>
@endsection

