<form wire:submit.prevent="storeBersih" class="row">
  @csrf
  <div>
    @if (session()->has('pesan'))
      <div class="alert alert-success">
          {{ session('pesan') }}
      </div>
    @endif
  </div>
  <div class="col-md-12">
    <label for="">Masukkan alamat anda</label>
    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required wire:model="address">
    @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="fcol-md-12 mt-3">
    <label for="">Perjelas alamat (nomor rumah, ancer ancer dll. boleh kosong)</label>
    <input id="address2" type="text" class="form-control @error('address2') is-invalid @enderror" name="address2" value="{{ old('address2') }}" required wire:model="address2">
    @error('address2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="col-md-12 mt-3">
    <span>Luas Ruangan :</span> <small class="text-danger">*plus Rp.20.000/m<sup>2</small>
  </div>
  <div class="col-md-6">
    <label for="">Panjang (m)</label>
    <input id="space" type="number" class="form-control @error('space') is-invalid @enderror" name="space" value="{{ old('space') }}" required wire:model="space">
    @error('space')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>
  <div class="col-md-6">
    <label for="">Lebar (m)</label>
    <input id="space2" type="number" class="form-control @error('space2') is-invalid @enderror" name="space2" value="{{ old('space2') }}" required wire:model="space2">
    @error('space2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="col-md-12 mt-3">
    <label for="">Kode Voucher (jika ada)</label>
    <div wire:loading wire:target="reedeem('{{$voucher}}')" class="la-ball-clip-rotate-multiple la-dark la-sm">
        <div></div>
        <div></div>
    </div>
    <div class="input-group">
      <input id="voucher" type="text" class="form-control @error('voucher') is-invalid @enderror" name="voucher" value="{{ old('voucher') }}" wire:model="voucher" aria-describedby="button-addon4">
      <div class="input-group-append" id="button-addon4">
        <button class="btn btn-outline-danger" type="button" wire:click="resetbtn">Reset</button>
        <button class="btn btn-outline-primary" type="button" wire:click="reedeem('{{$voucher}}')">Reedeem</button>
      </div>
    </div>
    <small class="text-danger">{{$message}}</small>
  </div>

  <div class="form-group mt-3">
    <label for="">Pilih Metode Pembayaran</label>
    <div class="form-check">
      <input class="form-check-input radio1" type="radio" name="radioMetode" id="radioMetode1" value="0" checked wire:model="paymentMethod">
      <label class="form-check-label" for="radioMetode1">
        COD
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input radio2" type="radio" name="radioMetode" id="radioMetode2" value="1" wire:model="paymentMethod">
      <label class="form-check-label" for="radioMetode2">
        Midtrans Payment Gateway (Gopay / Bank Transfer)
      </label>
    </div>
  </div>

  <div class="col-md-12 mt-3">
    <hr>
    <h6 class="text-center">Detail transaksi</h6>
    <div class="table-responsive">
      <table class="table table-borderless table-sm" width="100%" cellspacing="0">
        <tr>
          <td width="50%">Luas ruangan</td>
          <td width="50%">@currency($luas) m<sup>2</td>
        </tr>
        <tr>
          <td width="50%">Harga</td>
          <td width="50%">@currency($subtotal)</td>
        </tr>
        <tr>
          <td width="50%">Diskon Voucher {{$discount}} %</td>
          <td width="50%">@currency($potongan)</td>
        </tr>
        <tr class="border-top">
          <th width="50%">Total</th>
          <th width="50%">@currency($total)</th>
        </tr>
      </table>
    </div>
  </div>

  <div class="col-md-12">
    <button type="submit" class="btn btn-primary btn-user btn-block">
      Proses Sekarang
    </button>
    <div wire:loading wire:target="storeBersih" class="la-ball-clip-rotate-multiple la-dark la-sm">
        <div></div>
        <div></div>
    </div>
  </div>
</form>
