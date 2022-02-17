@extends('layouts.admin.app')
@section('titles', 'List Transaksi')
@section('maincontent')
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">List Transaksi</h1>
  <p class="mb-4">Data Transaksi</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List Transaksi</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tanggal Order</th>
              <th>User</th>
              <th>Payment</th>
              <th>Status</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactions as $transaction)
            <tr>
              <td>{{$transaction->id}}</td>
              <td>{{date('d-M-y, H.i', strtotime($transaction->created_at))}}</td>
              <td>{{$transaction->name}}</td>
              <td>
                @if(strpos(strtolower($transaction->payment_url), 'http') !== false)
                <a href="{{$transaction->payment_url}}" target="_blank">Midtrans</a>
                @else
                {{$transaction->payment_url}}
                @endif
              </td>
              <td>{{$transaction->status}}</td>
              <td>@currency($transaction->total)</td>
              <td>
                <a href="{{route('detail-transaksi', ['id' => $transaction->id])}}" class="btn btn-m btn-primary"><i class="fas fa-info-circle"></i></a>
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

@foreach($transactions as $transaction2)
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
          <a href="{{route('trash-transaksi', ['id' => $transaction2->id])}}" class="btn btn-danger">Hapus</a>
        </div>
    </div>
  </div>
</div>
@endforeach
