<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Layanan;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use App\Helpers\ResponseFormatter;

class JenisLaundry extends Component
{
    public $jenisLaundry;
    public $address;
    public $address2;
    public $weight;
    public $antar;
    public $voucher;
    public $discount;
    public $potongan;
    public $pesan;
    public $paymentMethod;
    public $harga;
    public $subtotal;
    public $total;

    public function mount()
    {
      $this->weight = 1;
      $this->paymentMethod = 0;
      $this->antar = 2000;
    }

    public function render()
    {
      if ($this->jenisLaundry != 0 && !empty($this->weight)) {
        $layananAll = Layanan::where('id', $this->jenisLaundry)->first();
        $this->harga = $layananAll->price;

        $this->subtotal = ($layananAll->price * $this->weight) + $this->antar;
        $this->potongan = $this->subtotal * $this->discount / 100;
        $this->total = $this->subtotal - $this->potongan;

      }else {
        $this->reset(['harga', 'total', 'subtotal', 'potongan', 'pesan', 'discount']);
      }

      $laundry = Layanan::where('jenisservice_id', 1)->get();

        return view('livewire.jenis-laundry', compact('laundry'));
    }

    public function reedeem($voucher)
    {
      try {
        $voucherAll = Voucher::where('status', 1)->where('voucher_code', $voucher)->first();

        if (time() > strtotime($voucherAll->expired)) {
          $this->pesan = "Kode Voucher kadaluarsa";
        }else {
          $this->discount = $voucherAll->discount;
          $this->pesan = "Kode Voucher berhasil digunakan";
          $this->voucher = $voucherAll->voucher_code;
        }

      } catch (\Exception $e) {
        $this->discount = 0;
        $this->pesan = "Kode Voucher tidak valid";
      }
    }

    public function resetbtn()
    {
      $this->reset('voucher');
      $this->reset('pesan');
      $this->discount = 0;
    }

    public function storeLaundry()
    {
      $this->validate([
        'jenisLaundry' => 'required',
        'weight' => 'required',
      ]);

      $transaksi = Transaction::create([
        'user_id' => Auth::user()->id,
        'total' => $this->total,
        'status' => "PROCESS",
        'payment_url' => "COD",
      ]);

      DetailTransaction::create([
        'transaction_id' => $transaksi->id,
        'service_id' => $this->jenisLaundry,
        'address' => $this->address,
        'address_detail' => $this->address2,
        'weight' => $this->weight,
        'voucher_code' => $this->potongan,
        'extra' => $this->antar,
        'subtotal' => $this->total,
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

        $transaksi = Transaction::with(['detailTransaction','user'])->find($transaksi->id);
        // $nameService = Layanan::find($this->jenisLaundry);

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
