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

class JenisTitip extends Component
{
  public $jenisTitip;
  public $start;
  public $ends;
  public $waktuTitip;
  public $namaLayanan;
  public $address;
  public $address2;
  public $tambahanBox;
  public $quantity;
  public $voucher;
  public $potongan;
  public $paymentMethod;
  public $discount;
  public $harga;
  public $subtotal;
  public $total;
  public $message;
  public $messageTime;

  public function mount()
  {
    $this->message = "";
    $this->paymentMethod = 0;
  }

  public function render()
  {
    if ($this->jenisTitip != 0 && !empty($this->quantity)) {
      $titipAll = Layanan::where('id', $this->jenisTitip)->first();
      $this->namaLayanan = $titipAll->name;
      $this->harga = $titipAll->price;

      if ($this->quantity > 3) {
        $this->tambahanBox = $this->quantity - 3;
      }else {
        $this->tambahanBox = 0;
      }

      if (strpos(strtolower($this->namaLayanan), 'harian') !== false) {
        $this->waktuTitip = round(abs(strtotime($this->ends) - strtotime($this->start)) / 86400);
        if ($this->waktuTitip < 1) {
          $this->waktuTitip = 1;
        }
        
        $this->subtotal = $this->harga * $this->quantity * $this->waktuTitip;
        $this->messageTime = "Hari";

      }elseif (strpos(strtolower($this->namaLayanan), 'bulanan') !== false) {
        $this->waktuTitip = round(abs(strtotime($this->ends) - strtotime($this->start)) / 2629800);

        if ($this->waktuTitip < 1) {
          $this->waktuTitip = 1;
        }
        $this->subtotal = $this->harga * $this->quantity * $this->waktuTitip;
        $this->messageTime = "Bulan";

      }else {
        $this->waktuTitip = round(abs(strtotime($this->ends) - strtotime($this->start)) / 2629800);

        if ($this->waktuTitip < 1) {
          $this->waktuTitip = 1;
        }
        $this->subtotal = ($this->harga + ($this->tambahanBox * 20000)) * $this->waktuTitip;
        $this->messageTime = "Bulan";
      }

      $this->potongan = $this->subtotal * $this->discount / 100;
      $this->total = $this->subtotal - $this->potongan;
    }

    $titips = Layanan::where('jenisservice_id', 4)->get();

    return view('livewire.jenis-titip', compact('titips'));
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

  public function storeTitip()
  {
    $this->validate([
      'jenisTitip' => 'required',
      'quantity' => 'required',
      'start' => 'required',
      'ends' => 'required',
    ]);

    $transaksi = Transaction::create([
      'user_id' => Auth::user()->id,
      'total' => $this->total,
      'status' => "PROCESS",
      'payment_url' => "COD",
    ]);

    DetailTransaction::create([
      'transaction_id' => $transaksi->id,
      'service_id' => $this->jenisTitip,
      'address' => $this->address,
      'address_detail' => $this->address2,
      'start' => date('Y-m-d', strtotime($this->start)),
      'end' => date('Y-m-d', strtotime($this->ends)),
      'voucher_code' => $this->potongan,
      'quantity' => $this->quantity,
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
