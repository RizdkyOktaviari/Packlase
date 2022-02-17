@extends('layouts.admin.app')
@section('titles', 'List Layanan')
@section('maincontent')
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">List Layanan</h1>
  <p class="mb-4">Data Layanan</p>
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
              <th>Nama</th>
              <th>JenisLayanan</th>
              <th>Deskripsi</th>
              <th>Price</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($Layanan as $Layanans)
            <tr>
              <td>{{$Layanans->name}}</td>
              <td>{{$Layanans->jenisServices->jenis}}</td>
              <td>{!!Str::limit($Layanans->description, '50')!!}</td>
              <td>{{$Layanans->price}}</td>
              <td>
                <a href="{{route('Edit-Layanan', ['id' => $Layanans->id])}}" class="btn btn-m btn-warning"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$loop->iteration}}"> <i class="fas fa-trash"></i> </a>
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

@foreach($Layanan as $Layanans2)
<div class="modal fade" id="exampleModal{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a href="{{route('Trash-Layanan', ['id' => $Layanans2->id])}}" class="btn btn-danger">Hapus</a>
        </div>
    </div>
  </div>
</div>
@endforeach
