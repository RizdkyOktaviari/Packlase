<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\JenisLayanan;
use App\Models\Layanan;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class JenisLayananController extends Controller
{
  public function all()
  {
    $jenisLayanan = JenisLayanan::query()->paginate(6);

    if ($jenisLayanan) {
      return ResponseFormatter::success(
          $jenisLayanan,
          'Data produk berhasil diambil'
      );
    }else {
      return ResponseFormatter::error(
        null,
        'Data produk tidak ada',
        404
      );
    }
  }

  public function dataService(Request $request)
  {

    $laundry = Layanan::where('jenisservice_id', $request->input('id'))->paginate();

    if ($laundry) {
      return ResponseFormatter::success(
          $laundry,
          'Data berhasil diambil'
      );
    }else {
      return ResponseFormatter::error(
        null,
        'Data produk tidak ada',
        404
      );
    }
  }

  public function dataProvinsi()
  {
    $listProvinsi = RajaOngkir::provinsi()->all();
    if (!empty($listProvinsi)) {
      return ResponseFormatter::success([
        'page' => 1,
        'data' => $listProvinsi
      ], 'Data berhasil diambil'
      );
    }else {
      return ResponseFormatter::error(
        null,
        'Data produk tidak ada',
        404
      );
    }
  }

  public function dataKota(Request $request)
  {
    $listKota = RajaOngkir::kota()->dariProvinsi($request->id)->get();
    if (!empty($listKota)) {
      return ResponseFormatter::success([
        'page' => 1,
        'data' => $listKota
      ], 'Data berhasil diambil'
      );
    }else {
      return ResponseFormatter::error(
        null,
        'Data produk tidak ada',
        404
      );
    }
  }

  public function hitungOngkir(Request $request)
  {
    $listLayananCourier = RajaOngkir::ongkosKirim([
      'origin'        => $request->input('origin'),
      'destination'   => $request->input('destination'),
      'weight'        => $request->input('weight'),
      'courier'       => strtolower($request->input('courier'))
    ])->get();

    if (!empty($listLayananCourier)) {
      return ResponseFormatter::success([
        'page' => 1,
        'data' => $listLayananCourier
      ], 'Data berhasil diambil'
      );
    }else {
      return ResponseFormatter::error(
        null,
        'Data produk tidak ada',
        404
      );
    }
  }
}
