<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'user_id','total','status','payment_url'
  ];

  protected $dates = ['deleted_at'];

  public function detailTransaction(){
    return $this->hasMany('App\Models\DetailTransaction');
  }

  public function layanan(){
    return $this->belongsTo('App\Models\Layanan');
  }

  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  public function rating()
  {
    return $this->hasMany('App\Models\Rating');
  }

  public static function getReport($layanan, $date1, $date2)
  {
    $transactions = DB::table('transactions')
    ->select('transactions.*', 'detail_transactions.transaction_id', 'services.jenisservice_id', 'users.name', 'users.email')
    ->leftJoin('detail_transactions', 'detail_transactions.transaction_id', '=', 'transactions.id')
    ->leftJoin('services', 'detail_transactions.service_id', '=', 'services.id')
    ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
    ->where('services.jenisservice_id', '=', $layanan)
    ->where('transactions.deleted_at', '=', NULL)
    ->whereBetween('transactions.created_at', [date('Y-m-d H:i:s', strtotime($date1)), date('Y-m-d H:i:s', strtotime($date2))])
    ->orderBy('transactions.id', 'desc')
    ->get();

    return $transactions;
  }

  public static function getJenisTransaction($id)
  {
    $transactions = DB::table('transactions')
    ->select('transactions.*', 'detail_transactions.transaction_id', 'services.jenisservice_id', 'users.name')
    ->leftJoin('detail_transactions', 'detail_transactions.transaction_id', '=', 'transactions.id')
    ->leftJoin('services', 'detail_transactions.service_id', '=', 'services.id')
    ->leftJoin('users', 'transactions.user_id', '=', 'users.id')
    ->where('services.jenisservice_id', '=', $id)
    ->where('transactions.deleted_at', '=', NULL)
    ->orderBy('transactions.id', 'desc')
    ->get();

    return $transactions;
  }


}
