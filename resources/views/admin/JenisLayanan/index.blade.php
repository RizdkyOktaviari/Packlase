@extends('layouts.admin.app')
@section('titles', 'Admin - List Jenis Layanan')
@section('maincontent')
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">List Layanan</h1>
  <p class="mb-4">Data Jenis Layanan</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List Layanan</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Gambar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($JenisLayanan as $JenisLayanan)
            <tr>
              <td>{{$JenisLayanan->id}}</td>
              <td>{{$JenisLayanan->jenis}}</td>
              <td>{{Str::limit($JenisLayanan->description, '50')}}</td>
              <td><img class="img-profile" src="{{asset($JenisLayanan->picturePath)}}" alt="{{$JenisLayanan->jenis}}" width="50" height="50"></td>
              <td>
                <a href="{{route('Edit-JenisLayanan', ['id' => $JenisLayanan->id])}}" class="btn btn-m btn-warning"> <i class="fas fa-edit"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
