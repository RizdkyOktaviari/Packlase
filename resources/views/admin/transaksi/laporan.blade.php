<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-900 text-center">Laporan Transaksi</h1>
      <p class="mb-4 text-center">Tanggal : {{date('d-m-Y H:i', strtotime($date1))}} sampai {{date('d-m-Y H:i', strtotime($date2))}}</p>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead class="thead-dark text-center">
                <tr>
                  <th>ID Order</th>
                  <th>Tanggal Order</th>
                  <th>Nama Customer</th>
                  <th>Email Customer</th>
                  <th>Metode Pembayaran</th>
                  <th>Status Transaksi</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach($transactions as $transaction)
                <tr>
                  <td>{{$transaction->id}}</td>
                  <td>{{date('d-m-y H:i', strtotime($transaction->created_at))}}</td>
                  <td>{{$transaction->user->name}}</td>
                  <td>{{$transaction->user->email}}</td>
                  <td>{{$transaction->payment_url}}</td>
                  <td>{{$transaction->status}}</td>
                  <td>@currency($transaction->total)</td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="6" class="font-weight-bold text-center">TOTAL</td>
                  <td class="font-weight-bold text-center">@currency($total)</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
