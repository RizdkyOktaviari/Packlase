@extends('layouts.admin.app')
@section('titles', 'Detail Transaksi')
@section('maincontent')
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Detail Transaksi</h1>
  <p class="mb-4">Data Detail Transaksi</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi</h6>
      <div class="d-none d-sm-inline-block">
        <a class="btn btn-sm btn-primary shadow-sm cetak" href="#"><i class="fas fa-chart-line fa-sm text-white-50"></i> Cetak Detail Transaksi</a>
        <a class="btn btn-sm btn-primary shadow-sm" href="#"  data-toggle="modal" data-target="#status"><i class="fas fa-chart-line fa-sm text-white-50"></i> Ubah Status</a>
      </div>
    </div>
    <div class="card-body" id="card">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <tr>
            <th class="table-primary text-dark" width="35%">ID Transaksi</th>
            <td width="65%">{{$detailTransactions->transaction_id}}</td>
          </tr>
          <tr>
            <th class="table-primary text-dark" width="35%">Tanggal Transaksi</th>
            <td width="65%">{{date('l, d M Y - H.i', strtotime($detailTransactions->created_at))}}</td>
          </tr>
          <tr>
            <th class="table-primary text-dark">Nama Customer</th>
            <td>{{$transaction->user->name}}</td>
          </tr>
          <tr>
            <th class="table-primary text-dark">Alamat Customer</th>
            <td>{{$detailTransactions->address . ", " . $detailTransactions->address_detail}}</td>
          </tr>
          <tr>
            <th class="table-primary text-dark">Telepon</th>
            <td>{{$transaction->user->phoneNumber}}</td>
          </tr>
          <tr>
            <th class="table-primary text-dark">Metode Pembayaran</th>
            <td>
              @if(strpos(strtolower($transaction->payment_url), 'http') !== false)
              <a href="{{$transaction->payment_url}}" target="_blank">Midtrans</a>
              @else
              {{$transaction->payment_url}}
              @endif
            </td>
          </tr>
          <tr>
            <th class="table-primary text-dark">Status</th>
            <td class="show-status">{{$transaction->status}}</td>
          </tr>
        </table>
      </div>
      <div class="table-responsive mt-3">
        <table class="table table-bordered text-center" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>Paket Titip</th>
              <th>Tanggal Titip</th>
              <th>Tanggal Ambil</th>
              <th>Harga Layanan</th>
              <th>Quantity</th>
              <th>Diskon</th>
              <th>Sub Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$detailTransactions->service->name}}</td>
              <td>{{date('d M y', strtotime($detailTransactions->start))}}</td>
              <td>{{date('d M y', strtotime($detailTransactions->end))}}</td>
              <td>@currency($detailTransactions->service->price)</td>
              <td>{{$detailTransactions->quantity}}</td>
              <td class="text-danger">@currency($detailTransactions->voucher_code)</td>
              <td>@currency($transaction->total)</td>
            </tr>
            <tr>
              <td colspan="6" class="text-dark font-weight-bold">TOTAL</td>
              <td class="text-dark font-weight-bold">@currency($transaction->total)</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="status" tabindex="-1" aria-labelledby="status" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="status">Ubah Status Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="updateStatus">
        <div class="modal-body">
          <div class="form-group">
            <label for="layanan">Status</label>
            <select class="form-control statuss">
              <option value="PROCESS">PROCESS</option>
              <option value="PENDING">PENDING</option>
              <option value="SUCCESS">SUCCESS</option>
              <option value="CANCELED">CANCELED</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" name="action">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js" integrity="sha512-mPA/BA22QPGx1iuaMpZdSsXVsHUTr9OisxHDtdsYj73eDGWG2bTSTLTUOb4TG40JvUyjoTcLF+2srfRchwbodg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.updateStatus').submit(function(e){
      e.preventDefault();
      let id = {{$detailTransactions->transaction_id}};
      let status = $('.statuss').val();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': '{{csrf_token()}}'
        },
        type : 'POST',
        url : '{{route('status-transaksi')}}',
        data : {
          id : id,
          status : status
        },
        success : function(status){
          $('.show-status').text(status);
          $('#status').modal('hide');
        }
      });
    });

    $('.cetak').click(function(){
      var mode = 'iframe'; //popup
      var close = mode == "popup";
      var options = { mode : mode, popClose : close};
      $("#card").printArea( options );
    });
  });
</script>
@endsection
