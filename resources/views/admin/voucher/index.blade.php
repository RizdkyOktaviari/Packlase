@extends('layouts.admin.app')
@section('titles', 'Admin - List Voucher')
@section('style')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
@section('maincontent')
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Voucher / Pengguna</h1>
  <p class="mb-4">Data user</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List Voucher</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Kode Voucher</th>
              <th>Diskon</th>
              <th>Tgl Kadaluarsa</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($listVoucher as $listVouchers)
            <tr>
              <td>{{$listVouchers->id}}</td>
              <td>{{$listVouchers->voucher_code}}</td>
              <td>{{$listVouchers->discount}} %</td>
              <td>{{date('d M y', strtotime($listVouchers->expired))}}</td>
              <td>
                <input class="toggle-voucher" data-id="{{$listVouchers->id}}" type="checkbox" {{$listVouchers->status ? 'checked' : ''}}  data-toggle="toggle" data-on="Aktif" data-off="Non-Aktif" data-onstyle="primary" data-offstyle="danger">
              </td>
              <td>
                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit{{$loop->iteration}}"> <i class="fas fa-edit"></i> </a>
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

@foreach($listVoucher as $listVouchers2)
<div class="modal fade" id="modalEdit{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('update-voucher', ['id' => $listVouchers2->id])}}">
        <div class="modal-body">
          {{csrf_field()}}

          <div class="form-group">
            <label for="name">Kode Voucher</label>
            <input type="text" name="voucher_code" class="form-control @error('voucher_code') is-invalid @enderror" value="{{ $listVouchers2->voucher_code }}" placeholder="Kode Voucher">
              @error('voucher_code')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group">
            <label for="diskon">Diskon (%)</label>
            <input type="text" name="discount" class="form-control @error('discount') is-invalid @enderror" value="{{ $listVouchers2->discount }}" placeholder="Diskon">
              @error('discount')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group">
            <label for="expired">Tanggal Kadaluarsa</label>
            <input type="date" name="expired" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
          <a href="{{route('delete-transaksi', ['id' => $listVouchers2->id])}}" class="btn btn-danger">Hapus</a>
        </div>
    </div>
  </div>
</div>
@endforeach

@section('script')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.toggle-voucher').change(function(){
      let status = $(this).prop('checked') == true ? 1 : 0;
      let id = $(this).attr('data-id');
      console.log(status);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        type : 'GET',
        url : '{{route('ubahStatus')}}',
        data : {
          id : id,
          status : status
        },
        success : function(data){
        }
      });
    });
  });
</script>
@endsection
