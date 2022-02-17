<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionReport implements FromCollection, WithHeadings, WithMapping
{

  protected $layanan;
  protected $date1;
  protected $date2;

  public function __construct($date1, $date2)
  {
    $this->date1 = $date1;
    $this->date2 = $date2;
  }

  public function collection()
  {
    return Transaction::whereBetween('created_at', [date('Y-m-d H:i:s', strtotime($this->date1)), date('Y-m-d H:i:s', strtotime($this->date2))])->get();
  }

  public function map($transaction) : array
  {
    return [
      $transaction->id,
      $transaction->user->name,
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
