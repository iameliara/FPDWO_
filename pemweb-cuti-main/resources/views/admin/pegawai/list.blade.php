@extends('layouts.admin')

@section('title', 'List Pegawai')

@section('content')
<nav class="navbar navbar-expand">
    <div class="container-fluid navbar-brand">LIST PEGAWAI</div>
    <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</nav>
<div class="container table-responsive">
    <table class="table table-striped">
      <thead class="table-dark text-center">
          <th>Nomor</th>
          <th>NAMA</th>
          <th>NIK</th>
          <th>NO INDUK</th>
          <th>JENIS KELAMIN</th>
          <th>ALAMAT</th>
          <th>DEPARTEMEN</th>
          <th>TINDAKAN</th>
      </thead>
      <tbody class="text-center">
        @foreach ($pegawai as $p)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$p->nama}}</td>
            <td>{{$p->nik}}</td>
            <td>{{$p->no_induk}}</td>
            <td>{{$p->jenis_kelamin}}</td>
            <td>{{$p->alamat}}</td>
            <td>{{$p->departemen->nama}}</td>
            <td>
                <i class="bi bi-trash btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#hapus-member{{$p->id}}"></i>
                <i class="bi bi-pencil btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#edit-member{{$p->id}}"></i>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>

@foreach ($pegawai as $p)
<div class="modal fade" id="hapus-member{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Kick Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('admin.pegawai.hapus', ['pegawai' => $p->id])}}" method="GET">
          @csrf
        <div class="modal-body">
          YAKIN???
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">YAKIN BOSS</button>
        </div>
      </form>
      </div>
    </div>
</div>
@endforeach

  @foreach ($pegawai as $p)
  <div class="modal fade" id="edit-member{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row g-3 align-middle" method="POST" action="{{route('admin.pegawai.edit', ['pegawai' => $p->id])}}">
              @csrf
                <div class="form-floating col-12" style="margin-top: 5px;">
                    <input name="nama" type="text" class="form-control " id="nama" placeholder="NAMA" value="{{$p->nama}}">
                    <label for="nama">Nama</label>
                </div>
                    <div class="form-floating col-12 mb-3">
                          <input name="no_induk" type="text" class="form-control" id="no_induk" placeholder="no_induk" value="{{$p->no_induk}}">
                          <label for="no_induk">Nomor Induk</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input name="nik" type="text" class="form-control" id="nik" placeholder="NIK" value="{{$p->nik}}">
                        <label for="nik">NIK</label>
                    </div>
                    <div class="form-floating mb-1">
                      <select name="jenis_kelamin" class="form-select" id="jkelamin" aria-label="JenisKelamin" >
                        <option value="L" 
                        @if($p->jenis_kelamin=='L')
                            selected
                        @endif>Laki-Laki</option>
                        <option value="P" 
                        @if($p->jenis_kelamin=='P')
                            selected
                        @endif>Perempuan</option>
                        {{$p->jenis_kelamin}}
                      </select>
                      <div class="col-12 mb-3">
                        <div class="form-floating">
                            <select name="departemen" class="form-select" id="departemen" aria-label="JenisKelamin">
                              @foreach ($departemen as $dp)
                              <option value="{{$dp->id}}" 
                                @if ($dp->id == $p->id_departemen)
                                  selected
                                @endif>{{$dp->nama}}</option>    
                              @endforeach
                            </select>
                            <label for="floatingSelect">Departemen</label>
                        </div>
                      </div>
                    <div class="col-12 mb-3">
                      <div class="form-floating">
                          <input name="password" type="password" class="form-control" id="password" placeholder="password(kosongi apabila tidak ingin mengganti)">
                          <label for="password">Password</label>
                      </div>
                  </div>
                <div class="form-floating col-12">
                    <input name="alamat" type="text" class="form-control" id="alamat" placeholder="ALAMAT" value="{{$p->alamat}}">
                    <label for="alamat">Alamat</label>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach


@endsection

