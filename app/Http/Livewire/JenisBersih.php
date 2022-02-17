<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Layanan;
use App\Models\Voucher;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use App\Helpers\ResponseFormatter;

class JenisBersih extends Component
{
  public $address;
  public $address2;
  public $space;
  public $space2;
  public $voucher;
  public $discount;
  public $potongan;
  public $harga;
  public $luas;
  public $tambahanLuas;
  public $paymentMethod;
  public $subtotal;
  public $total;
  public $message;
  public $idService;

  public function mount()
  {
    $this->space = 3;
    $this->space2 = 3;
    $this->message = "";
    $this->paymentMethod = 0;
  }

  public function render()
  {
    if (!empty($this->space) && !empty($this->space2)) {
      $this->luas = $this->space * $this->space2;
      if ($this->luas > 9) {
        $this->tambahanLuas = $this->luas - 9;
      }else {
        $this->tambahanLuas = 0;
      }

      $bersih = Layanan::where('jenisservice_id', 2)->first();
      $this->harga = $bersih->price;
      $this->idService = $bersih->id;

      $this->subtotal = $this->harga + ($this->tambahanLuas * 20000);
      $this->potongan = $this->subtotal * $this->discount / 100;
      $this->total = $this->subtotal - $this->potongan;
    }
    return view('livewire.jenis-bersih');
  }

  public function reedeem($voucher)
  {
    try {
      $voucherAll = Voucher::where('status', 1)->where('voucher_code', $voucher)->first();

      if (time() > strtotime($voucherAll->expired)) {
        $this->message = "Kode Voucher kadaluarsa";
      }else {
        $this->discount = $voucherAll->discount;
        $this->message = "Kode Voucher berhasil digunakan";
        $this->voucher = $voucherAll->voucher_code;
      }

    } catch (\Exception $e) {
      $this->discount = 0;
      $this->message = "Kode Voucher tidak valid";
    }
  }

  public function resetbtn()
  {
    $this->reset('voucher');
    $this->reset('message');
    $this->discount = 0;
  }

  public function storeBersih()
  {
    $this->validate([
      'address' => 'required',
      'space' => 'required',
      'space2' => 'required',
    ]);

    $transaksi = Transaction::create([
      'user_id' => Auth::user()->id,
      'total' => $this->total,
      'status' => "PROCESS",
      'payment_url' => "COD",
    ]);

    DetailTransaction::create([
      'transaction_id' => $transaksi->id,
      'service_id' => $this->idService,
      'address' => $this->address,
      'address_detail' => $this->address2,
      'space' => $this->luas,
      'voucher_code' => $this->potongan,
      'subtotal' => $this->subtotal,
    ]);

    Voucher::where('voucher_code', $this->voucher)->update([
      'status' => 0
    ]);

    if ($this->paymentMethod == 1) {
      // Konfigurasi midtrans
      Config::$serverKey = config('services.midtrans.serverKey');
      Config::$isProduction = config('services.midtrans.isProduction');
      Config::$isSanitized = config('services.midtrans.isSanitized');
      Config::$is3ds = config('services.midtrans.is3ds');

      $transaksi = Transaction::with('user')->find($transaksi->id);

      $midtrans = array(
        'transaction_details' => array(
        'order_id' =>  $transaksi->id,
        'gross_amount' => (int) $transaksi->total,
      ),
      'customer_details' => array(
        'first_name'    => $transaksi->user->name,
        'email'         => $transaksi->user->email,
        'phone'         => $transaksi->user->phoneNumber,
      ),
        'enabled_payments' => array('gopay','bank_transfer'),
        'vtweb' => array(),
      );

      try {
        // Ambil halaman payment midtrans
        $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

        $transaksi->payment_url = $paymentUrl;
        $transaksi->save();

        // Redirect ke halaman midtrans
        return redirect($paymentUrl);
        // ResponseFormatter::success($transaksi,'Transaksi berhasil');
      }
      catch (Exception $e) {
          return ResponseFormatter::error($e->getMessage(),'Transaksi Gagal');
      }
    }else {
      return redirect()->route('riwayat-transaksi');
    }
  }
}
