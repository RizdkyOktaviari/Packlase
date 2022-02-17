<form wire:submit.prevent="storeTitip">
  @csrf
  <div>
    @if (session()->has('pesan'))
      <div class="alert alert-success">
          {{ session('pesan') }}
      </div>
    @endif
  </div>
  <div class="form-group">
    <label for="">Pilih Layanan Titip Barang</label>
      <select wire:model="jenisTitip" class="form-control @error('jenisTitip') is-invalid @enderror" name="jenisTitip" required>
        <option value="0">-- Pilih Layanan Titip Barang --</option>
          @foreach($titips as $titip)
            <option value="{{$titip->id}}">{{$titip->name}}</option>
          @endforeach
      </select>
      @error('jenisTitip')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>

  <div class="form-group mt-3">
    <label for="">Jumlah Box / Motor</label><small class="text-danger"> *minimal 3 box</small>
    <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required wire:model="quantity">
    @error('quantity')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="form-group mt-3">
    <label for="">Tanggal mulai titip</label>
    <input id="start" type="date" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" wire:model="start" required>
    @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>
  <div class="form-group mt-3">
    <label for="">Tanggal akhir titip</label>
    <input id="ends" type="date" class="form-control @error('ends') is-invalid @enderror" name="ends" value="{{ old('ends') }}" wire:model="ends" required>
    @error('address')
        <span class="invalid-feedback" role="ends">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="form-group mt-3">
    <label for="">Masukkan alamat anda</label>
    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" wire:model="address">
  </div>

  <div class="form-group mt-3">
    <label for="">Perjelas alamat (nomor rumah, ancer ancer dll. boleh kosong)</label>
    <input id="address2" type="text" class="form-control @error('address2') is-invalid @enderror" name="address2" value="{{ old('address2') }}" wire:model="address2">
  </div>

  <div class="form-group mt-3">
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

  <hr>
  <h6 class="text-center">Detail transaksi</h6>
  <div class="table-responsive">
    <table class="table table-borderless table-sm" width="100%" cellspacing="0">
      <tr>
        <td width="50%">Layanan {{$namaLayanan}}</td>
        <td width="50%">@currency($harga)</td>
      </tr>
      <tr>
        <td width="50%">Jumlah Box / Motor</td>
        <td width="50%">{{$quantity}}</td>
      </tr>
      <tr>
        <td width="50%">Waktu Titip</td>
        <td width="50%">{{$waktuTitip}} {{$messageTime}}</td>
      </tr>
      <tr>
        <td width="50%">Subtotal</td>
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
  <div class="form-group">
    <button type="submit" class="btn btn-primary btn-user btn-block">
      Proses Sekarang
    </button>
    <div wire:loading wire:target="storeTitip" class="la-ball-clip-rotate-multiple la-dark la-sm">
        <div></div>
        <div></div>
    </div>
  </div>
</form>
