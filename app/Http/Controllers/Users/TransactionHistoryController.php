<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Rating;

class TransactionHistoryController extends Controller
{
  protected $listeners = ['refreshProducts' => '$refresh'];

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $transactions = Transaction::where('user_id', Auth::user()->id)->get();

    return view('user.riwayat-transaksi', compact('transactions'));
  }

  public function detail($id)
  {
    $transaction = Transaction::where('id', $id)->first();
    $detailTransactions = DetailTransaction::where('transaction_id', $id)->first();
    $rates = Rating::where('user_id', Auth::user()->id)->where('transaction_id', $id)->get();

    if ($detailTransactions->service->jenisservice_id == 1) {
      return view('user.detailLaundry', compact(['transaction', 'detailTransactions', 'rates']));
    }elseif ($detailTransactions->service->jenisservice_id == 2) {
      return view('user.detailBersih', compact(['transaction', 'detailTransactions', 'rates']));
    }elseif ($detailTransactions->service->jenisservice_id == 3) {
      // dd($rates);
      return view('user.detailPaket', compact(['transaction', 'detailTransactions', 'rates']));
    }elseif ($detailTransactions->service->jenisservice_id == 4) {
      return view('user.detailTitip', compact(['transaction', 'detailTransactions', 'rates']));
    }
  }

  public function rateLayanan(Request $request){

    $this->validate($request,[
      'rate' => 'required',
    ]);

    if ($request->idRate != 0) {
      Rating::where('id', $request->idRate)->update([
        'rate' => $request->rate,
      ]);

      $rate = $request->rate;
      return $rate;
    }else {
      $Rating = Rating::create([
        'user_id' => Auth::user()->id,
        'jenisservice_id' => $request->id,
        'rate' => $request->rate,
        'transaction_id' => $request->transactionId,
      ]);

      return array($Rating);
    }
  }
}
