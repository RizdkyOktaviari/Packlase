<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionReportJenis implements FromCollection, WithHeadings, WithMapping
{

  protected $layanan;
  protected $date1;
  protected $date2;

  public function __construct($layanan, $date1, $date2)
  {
    $this->layanan = $layanan;
    $this->date1 = $date1;
    $this->date2 = $date2;
  }

  public function collection()
  {
    return DB::table('transactions')
    ->select('transactions.*', 'detail_transactions.transaction_id', 'services.jenisservice_id', 'users.name', 'users.email')
    ->leftJoin('detail_transactions', 'detail_transactions.transaction_id', '=', 'transactions.id')
    ->leftJoin('services', 'detail_transactions.service_id', '=', 'services.id')
    ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
    ->where('services.jenisservice_id', '=', $this->layanan)
    ->where('transactions.deleted_at', '=', NULL)
    ->whereBetween('transactions.created_at', [date('Y-m-d H:i:s', strtotime($this->date1)), date('Y-m-d H:i:s', strtotime($this->date2))])
    ->orderBy('transactions.id', 'desc')
    ->get();
  }

  public function map($transaction) : array
  {
    return [
      $transaction->id,
      $transaction->name,
      $transaction->payment_url,
      $transaction->status,
      $transaction->total,
      Carbon::parse($transaction->created_at)->toFormattedDateString(),
      Carbon::parse($transaction->updated_at)->toFormattedDateString(),
    ];
  }

  public function headings(): array
  {
    return [
      "ID",
      "Nama Customer",
      "Pembayaran",
      "Status",
      "Total",
      "created_at",
      "updated_at"
    ];
  }
}
