<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Layanan;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Midtrans\Config;
use Midtrans\Snap;
use App\Helpers\ResponseFormatter;

class JenisPaket extends Component
{
  public $provinsi1;
  public $provinsi2;
  public array $listKota = [];
  public array $listKota2 = [];
  public $origin;
  public $destination;
  public $courier;
  public array $listLayananCourier = [];
  public $layananCourier;
  public $layananCourier2;
  public $idService;
  public $address;
  public $address2;
  public $weight;
  public $ongkir;
  public $voucher;
  public $paymentMethod;
  public $potongan;
  public $discount;
  public $harga;
  public $subtotal;
  public $total;
  public $message;

  public function mount()
  {
    $this->paymentMethod = 0;
  }

  public function render()
  {

    if ($this->provinsi1 == 0) {
      $this->origin = 0;
      $this->reset('listKota');
    }else {
      $this->listKota = RajaOngkir::kota()->dariProvinsi($this->provinsi1)->get();
    }

    if ($this->provinsi2 == 0) {
      $this->destination = 0;
      $this->reset('listKota2');
    }else {
      $this->listKota2 = RajaOngkir::kota()->dariProvinsi($this->provinsi2)->get();
    }

    if ($this->origin != 0 && $this->destination != 0 && !empty($this->courier) && $this->weight != 0) {
      $this->listLayananCourier = RajaOngkir::ongkosKirim([
        'origin'        => $this->origin,
        'destination'   => $this->destination,
        'weight'        => $this->weight,
        'courier'       => $this->courier
      ])->get();

      $this->listLayananCourier = $this->listLayananCourier[0]['costs'];

      if (!empty($this->layananCourier)) {
        $pisahString = explode(',', $this->layananCourier);
        $this->layananCourier2 = $pisahString[0];
        $this->ongkir = $pisahString[1];
      }else {
        $this->ongkir = 0;
      }

      $paket = Layanan::where('jenisservice_id', 3)->first();
      $this->harga = $paket->price;
      $this->idService = $paket->id;

      $this->subtotal = $this->harga + $this->ongkir;
      $this->potongan = $this->subtotal * $this->discount / 100;
      $this->total = $this->subtotal - $this->potongan;

    }

    $listProvinsi = RajaOngkir::provinsi()->all();

    return view('livewire.jenis-paket', compact('listProvinsi'));
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

  public function storePaket()
  {
    $this->validate([
      'address' => 'required',
    ]);

    $transaksi = Transaction::create([
      'user_id' => Auth::user()->id,
      'total' => $this->total,
      'status' => "PROCESS",
      'payment_url' => "COD",
    ]);

    $origins = RajaOngkir::kota()->dariProvinsi($this->provinsi1)->find($this->origin);
    $destinations = RajaOngkir::kota()->dariProvinsi($this->provinsi2)->find($this->destination);

    DetailTransaction::create([
      'transaction_id' => $transaksi->id,
      'service_id' => $this->idService,
      'address' => $this->address,
      'address_detail' => $this->address2,
      'origin' => $origins['type']." ".$origins['city_name'],
      'destination' => $destinations['type']." ".$destinations['city_name'],
      'weight' => $this->weight,
      'courier' => $this->courier." ".$this->layananCourier2,
      'extra' => $this->ongkir,
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
