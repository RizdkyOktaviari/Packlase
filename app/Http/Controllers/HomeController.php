<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $earningLaundry = DB::table('detail_transactions')
    ->leftJoin('services', 'detail_transactions.service_id', '=', 'services.id')
    ->where('services.jenisservice_id', '=', '1')
    ->count('detail_transactions.id');


    $earningBersih = DB::table('detail_transactions')
    ->leftJoin('services', 'detail_transactions.service_id', '=', 'services.id')
    ->where('services.jenisservice_id', '=', '2')
    ->count('detail_transactions.id');

    $earningPaket = DB::table('detail_transactions')
    ->leftJoin('services', 'detail_transactions.service_id', '=', 'services.id')
    ->where('services.jenisservice_id', '=', '3')
    ->count('detail_transactions.id');

    $earningTitip = DB::table('detail_transactions')
    ->leftJoin('services', 'detail_transactions.service_id', '=', 'services.id')
    ->where('services.jenisservice_id', '=', '4')
    ->count('detail_transactions.id');

    $earning = Transaction::get()->groupBy(function($d) {
      return Carbon::parse($d->created_at)->format('m-Y');
    });

    $earning2 = Transaction::get()->groupBy(function($d) {
      return Carbon::parse($d->created_at)->format('Y');
    });

    if (isset($earning2[Carbon::now()->format('Y')])) {
      $earningAnual = $earning2[Carbon::now()->format('Y')]->sum('total');
    }else {
      $earningAnual = 0;
    }

    $earningTotal = Transaction::sum('total');
    $totalOrder = Transaction::count('id');
    $userWeekly = User::where('created_at','>=',Carbon::today()->subDays(7))->count();

    if (isset($earning[Carbon::now()->format('m-Y')])) {
      $earningMonthly = $earning[Carbon::now()->format('m-Y')]->sum('total');
    }else {
      $earningMonthly = 0;
    }

    if (isset($earning["01-".Carbon::now()->format('Y')])) {
      $jan = $earning["01-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $jan = 0;
    }

    if (isset($earning["02-".Carbon::now()->format('Y')])) {
      $feb = $earning["02-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $feb = 0;
    }

    if (isset($earning["03-".Carbon::now()->format('Y')])) {
      $mar = $earning["03-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $mar = 0;
    }

    if (isset($earning["04-".Carbon::now()->format('Y')])) {
      $apr = $earning["04-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $apr = 0;
    }

    if (isset($earning["05-".Carbon::now()->format('Y')])) {
      $may = $earning["05-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $may = 0;
    }

    if (isset($earning["06-".Carbon::now()->format('Y')])) {
      $jun = $earning["06-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $jun = 0;
    }

    if (isset($earning["07-".Carbon::now()->format('Y')])) {
      $jul = $earning["07-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $jul = 0;
    }

    if (isset($earning["08-".Carbon::now()->format('Y')])) {
      $aug = $earning["08-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $aug = 0;
    }

    if (isset($earning["09-".Carbon::now()->format('Y')])) {
      $sep = $earning["09-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $sep = 0;
    }


    if (isset($earning["10-".Carbon::now()->format('Y')])) {
      $oct = $earning["10-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $oct = 0;
    }

    if (isset($earning["11-".Carbon::now()->format('Y')])) {
      $nov = $earning["11-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $nov = 0;
    }

    if (isset($earning["12-".Carbon::now()->format('Y')])) {
      $dec = $earning["12-".Carbon::now()->format('Y')]->sum('total');
    }else{
      $dec = 0;
    }

    $monthly = [$jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec];
    $earningSource = [$earningLaundry, $earningBersih, $earningPaket, $earningTitip];


    return view('admin.home', compact(
      'earningMonthly',
      'earningTotal',
      'userWeekly',
      'totalOrder',
      'monthly',
      'earningAnual',
      'earningSource'
    ));
  }
}
