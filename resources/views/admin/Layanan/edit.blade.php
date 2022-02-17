@extends('layouts.admin.app')
@section('titles', 'Edit Layanan '.$Layanan->name)
@section('style')
<style media="screen">
  .image-area {
    position: relative;
    width: 35%;
    height: 35%;
    background: #333;
  }
  .image-area img{
    max-width: 100%;
    height: auto;
  }
  .remove-image {
    display: none;
    position: absolute;
    top: -10px;
    right: -10px;
    border-radius: 10em;
    padding: 2px 6px 3px;
    text-decoration: none;
    font: 700 21px/20px sans-serif;
    background: #555;
    border: 3px solid #fff;
    color: #FFF;
    box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
    text-shadow: 0 1px 2px rgba(0,0,0,0.5);
    -webkit-transition: background 0.5s;
    transition: background 0.5s;
  }
  .remove-image:hover {
    background: #E54E4E;
    padding: 3px 7px 5px;
    top: -11px;
    right: -11px;
  }
  .remove-image:active {
    background: #E54E4E;
    top: -10px;
    right: -11px;
  }
</style>
@endsection
@section('maincontent')
  <div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Layanan</h1>
    <p class="mb-4">Packclese</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit Layanan</h6>
      </div>
      <div class="card-body">
        <form action="{{route('Update-Layanan',['id' => $Layanan->id])}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}

          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$Layanan->name}}" placeholder="Tambah Nama">
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group">
            <label for="jenisservice_id">Layanan</label>
              <select class="form-control @error('jenisservice_id') is-invalid @enderror" name="jenisservice_id" >
                <option disabled selected>Jenis Layanan</option>
                  @foreach($JenisLayanan as $JenisLayanans)
                    @if($Layanan->jenisservice_id == $JenisLayanans->id)
                    <option value="{{$JenisLayanans->id}}" selected>{{$JenisLayanans->jenis}}</option>
                    @else
                    <option value="{{$JenisLayanans->id}}">{{$JenisLayanans->jenis}}</option>
                    @endif
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
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{$Layanan->price}}" placeholder="Harga Layanan">
              @error('price')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group">
            <p><label for="content">Deskripsi</label></p>
            <textarea id="editor" name="description" rows="8" cols="40" placeholder="Tambah Deskripsi" class="form-control @error('description') is-invalid @enderror">{{$Layanan->description}}</textarea>
              @error('description')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-row">
            <label for="">List Gambar</label>
            @foreach($service_photos as $service_photo)
            <div class="form-group col-sm-3">
              <div class="image-area">
                <img src="{{asset($service_photo->picturePath)}}"  alt="Preview">
                <a class="remove-image" href="" style="display: inline;" data-id="{{$service_photo->id}}" data-name="{{$service_photo->picturePath}}">&#215;</a>
              </div>
            </div>
            @endforeach

          </div>

          <div class="form-group increment">
            <label for="">Tambah Gambar</label>
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
              <button type="submit" class="btn btn-success">Update</button>
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
      let markup = $(".invisible").html();
      $(".increment").append(markup);
    });
    $("body").on("click", ".btn-remove", function () {
      $(this).parents(".input-group").remove();
    })
  })
</script>

<script type="text/javascript">
  $('.remove-image').on('click', function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');
    let name = $(this).attr('data-name');
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        type : 'DELETE',
        url : '{{route('delete-image')}}',
        data : {
          id : id,
          name : name
        },
        success : function(response){
          if(response){
            $(this).parents('.image-area').slideUp().remove();
            toastr.success('Gambar Berhasil Dihapus');
          }
        }.bind(this)
    });
  });
</script>
@endsection
