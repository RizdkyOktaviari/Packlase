@extends('layouts.admin.app')
@section('titles', 'Admin - List User')
@section('maincontent')
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">User / Pengguna</h1>
  <p class="mb-4">Data user</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List User / Pengguna</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Nomor HP</th>
              <th>Email</th>
              <th>Roles</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($listUser as $listUsers)
            <tr>
              <td><img class="img-profile rounded-circle"  src="{{asset('storage/'.$listUsers->profile_photo_path)}}" alt="{{$listUsers->name}}" width="50" height="50"></td>
              <td>{{$listUsers->name}}</td>
              <td>{{$listUsers->address}}</td>
              <td>{{$listUsers->phoneNumber}}</td>
              <td><a href="mailto:{{$listUsers->email}}" target="_blank">{{$listUsers->email}}</td>
              <td>{{$listUsers->roles}}</td>
              <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $loop->iteration }}"> <i class="fas fa-trash"></i> </a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@foreach($listUser as $listUsers2)
<div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          Apakah kamu yakin untuk menghapusnya ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="{{route('delete-user', ['id' => $listUsers2->id])}}" class="btn btn-danger">Hapus</a>
        </div>
    </div>
  </div>
</div>
@endforeach
