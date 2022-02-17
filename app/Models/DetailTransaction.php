<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
  use HasFactory;

  protected $fillable = [
    'transaction_id',
    'service_id',
    'address',
    'address_detail',
    'origin',
    'destination',
    'destination',
    'weight',
    'courier',
    'space',
    'start',
    'end',
    'extra',
    'voucher_code',
    'quantity',
    'subtotal'
  ];

  public function transaction(){
    return $this->belongsTo('App\Models\Transaction');
  }

  public function service(){
    return $this->belongsTo('App\Models\Layanan', 'service_id');
  }
}
