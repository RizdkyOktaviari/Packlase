@extends('layouts.admin.app')
@section('titles', 'Tambah Layanan')
@section('maincontent')

  <div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Layanan</h1>
    <p class="mb-4">Packclese</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tambah Layanan</h6>
      </div>
      <div class="card-body">
        <form action="{{route('Store-Layanan')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}

          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Layanan">
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group">
            <label for="jenisservice_id">Layanan</label>
              <select class="form-control @error('jenisservice_id') is-invalid @enderror" name="jenisservice_id">
                <option disabled selected>Jenis Layanan</option>
                  @foreach($JenisLayanan as $JenisLayanans)
                    <option value="{{$JenisLayanans->id}}">{{$JenisLayanans->jenis}}</option>
                  @endforeach
              </select>
              @error('jenisservice_id')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Harga Layanan">
              @error('price')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group">
            <p><label for="content">Deskripsi</label></p>
            <textarea id="editor" name="description" rows="8" cols="40" placeholder="Tambah Deskripsi" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
              @error('description')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group increment">
            <label for="">Photo</label>
            <div class="input-group">
              <input type="file" name="picturePath[]" class="form-control">
              <div class="input-group-append">
                <button type="button" class="btn btn-outline-primary btn-add"><i class="fas fa-plus-square"></i></button>
              </div>
            </div>
          </div>
          @if ($errors->has('picturePath'))
            <ul class="alert alert-danger">
              @foreach ($errors->get('picturePath') as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
          <div class="clone invisible">
            <div class="input-group mt-2">
              <input type="file" name="picturePath[]" class="form-control">
              <div class="input-group-append">
                <button type="button" class="btn btn-outline-danger btn-remove"><i class="fas fa-minus-square"></i></button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="text-left">
              <button type="submit" class="btn btn-success">Create</button>
            </div>
          </div>
        </form>
          </div>
      </div>
  </div>
@endsection

@section('script')
<script>
  CKEDITOR.replace('editor');
</script>
<script type="text/javascript">
  window.action = "submit"
  $(document).ready(function () {
    $(".btn-add").click(function () {
      let markup = jQuery(".invisible").html();
      $(".increment").append(markup);
    });
    $("body").on("click", ".btn-remove", function () {
      $(this).parents(".input-group").remove();
    })
  })
</script>
@endsection
