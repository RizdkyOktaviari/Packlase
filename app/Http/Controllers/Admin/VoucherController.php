<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
  public function index()
  {
    $listVoucher = Voucher::all();

    return view('admin.voucher.index', compact('listVoucher'));
  }

  public function changeStatus(Request $Request)
  {
    Voucher::where('id', $Request->id)->update([
      'status' => $Request->status
    ]);
  }

  public function create()
  {
    return view('admin.voucher.create');
  }

  public function store(Request $Request)
  {
    $this->validate($Request,[
      'voucher_code' => 'required|unique:vouchers|max:20',
      'discount' => 'required|max:6',
    ]);

    Voucher::create([
      'voucher_code' => $Request->voucher_code,
      'discount' => $Request->discount,
      'status' => 1,
      'expired' => date('Y-m-d', strtotime($Request->expired)),
    ]);

    toastr()->success('voucher Berhasil Ditambahkan');
    return redirect()->route('index-voucher');
  }

  public function update(Request $Request, $id)
  {
    $this->validate($Request,[
      'voucher_code' => 'required|unique:vouchers|max:20',
      'discount' => 'required|max:6',
    ]);

    Voucher::where('id', $id)->update([
      'voucher_code' => $Request->voucher_code,
      'discount' => $Request->discount,
      'expired' => date('Y-m-d', strtotime($Request->expired)),
    ]);

    return redirect()->route('index-voucher');
  }

  public function delete($id)
  {
    $voucher = Voucher::find($id);
    $voucher->delete();

    return redirect()->route('index-voucher');
  }
}
