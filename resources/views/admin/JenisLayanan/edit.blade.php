@extends('layouts.admin.app')
@section('titles', 'Edit Jenis Layanan '.$JenisLayanan->jenis)
@section('maincontent')

<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Edit Jenis Layanan</h1>
  <p class="mb-4">Data Jenis Layanan {{$JenisLayanan->jenis}}</p>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Edit Jenis Layanan</h6>
    </div>
    <div class="card-body">
      <form action="{{route('Update-JenisLayanan', ['id'=> $JenisLayanan->id])}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
          <label for="jenis">Nama Jenis Layanan</label>
          <input type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror" value="{{$JenisLayanan->jenis}}">
          @error('jenis')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="jenis">Deskripsi</label>
          <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="8" cols="80">{{$JenisLayanan->description}}</textarea>
          @error('description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="picturePath">Gambar / Foto</label>
          <input type="file" name="picturePath" class="form-control @error('picturePath') is-invalid @enderror">
          @error('picturePath')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <div class="text-left">
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
