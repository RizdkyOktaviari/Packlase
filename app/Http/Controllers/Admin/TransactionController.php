<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Exports\TransactionReport;
use App\Exports\TransactionReportJenis;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
  public function index()
  {
    $transactions = Transaction::all();

    return view('admin.transaksi.index', compact('transactions'));
  }

  public function detail($id)
  {
    $transaction = Transaction::where('id', $id)->first();
    $detailTransactions = DetailTransaction::where('transaction_id', $id)->first();

    if ($detailTransactions->service->jenisservice_id == 1) {
      return view('admin.transaksi.detailLaundry', compact(['transaction', 'detailTransactions']));
    }elseif ($detailTransactions->service->jenisservice_id == 2) {
      return view('admin.transaksi.detailBersih', compact(['transaction', 'detailTransactions']));
    }elseif ($detailTransactions->service->jenisservice_id == 3) {
      return view('admin.transaksi.detailPaket', compact(['transaction', 'detailTransactions']));
    }elseif ($detailTransactions->service->jenisservice_id == 4) {
      return view('admin.transaksi.detailTitip', compact(['transaction', 'detailTransactions']));
    }
  }

  public function jenisTransaction($id)
  {
    $transactions = Transaction::getJenisTransaction($id);

    return view('admin.transaksi.jenisTransaksi', compact('transactions'));
  }

  public function report(Request $Request)
  {
    $this->validate($Request,[
      'date1' => 'required',
      'date2' => 'required',
      'layanan' => 'required',
    ]);

    $date1 = $Request->date1;
    $date2 = $Request->date2;
    $jenisService = JenisLayanan::where('id', $Request->layanan)->first();

    if ($Request->action == "excel") {
      if ($Request->layanan == 0) {
        return Excel::download(new TransactionReport($date1, $date2), 'Laporan dari ' . $date1 . ' sampai ' . $date2 . '.xlsx');
      }else {
        return Excel::download(new TransactionReportJenis($Request->layanan, $date1, $date2), 'Laporan Layanan '.$jenisService->jenis.' dari ' . $date1 . ' sampai ' . $date2 . '.xlsx');
      }
    }else {
      if ($Request->layanan == 0) {
        $transactions = Transaction::whereBetween('created_at', [date('Y-m-d H:i:s', strtotime($Request->date1)), date('Y-m-d H:i:s', strtotime($Request->date2))])->get();

        $total = Transaction::whereBetween('created_at', [date('Y-m-d H:i:s', strtotime($Request->date1)), date('Y-m-d H:i:s', strtotime($Request->date2))])->sum('total');

        $pdf = PDF::loadview('admin.transaksi.laporan',[
          'transactions' => $transactions,
          'date1' => $date1,
          'date2' => $date2,
          'total' => $total,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan transaksi tanggal ' . $date1 . " sampai " . $date2);

      }else {
        $transactions = Transaction::getReport($Request->layanan, $date1, $date2);
        $total = Transaction::getReport($Request->layanan, $date1, $date2)->sum('total');

        $pdf = PDF::loadview('admin.transaksi.laporanLayanan',[
          'transactions' => $transactions,
          'date1' => $date1,
          'date2' => $date2,
          'jenisService' => $jenisService->jenis,
          'total' => $total,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan transaksi '.$jenisService->jenis . " tanggal " . $date1 . " sampai " . $date2);
      }
    }
  }

  public function status(Request $Request)
  {
    $this->validate($Request,[
      'id' => 'required',
      'status' => 'required',
    ]);

    Transaction::where('id', $Request->id)->update([
      'status' => $Request->status
    ]);
    $status = $Request->status;
    return $status;
  }

  public function trash($id)
  {
    $transaction = Transaction::find($id);
    $transaction->delete();
    toastr()->success('Data Berhasil Dihapus');
    return redirect()->route('index-transaksi');
  }

  public function trashed()
  {
    $transactions = Transaction::onlyTrashed()->get();
    return view('admin.transaksi.trashed', compact('transactions'));
  }

  public function restore($id)
  {
    $transaction = Transaction::withTrashed()->where('id',$id)->first();
    $transaction->restore();
    toastr()->success('Data Berhasil Dipulihkan');
    return redirect()->route('index-transaksi');
  }

  public function delete($id)
  {
    $transaction = Transaction::withTrashed()->where('id',$id)->first();
    $transaction->forceDelete();
    toastr()->success('Data Berhasil Dihapus Permanen');
    return redirect()->route('index-transaksi');
  }
}
