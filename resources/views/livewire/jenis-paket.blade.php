<form wire:submit.prevent="storePaket" class="row">
  @csrf
  <div>
    @if (session()->has('pesan'))
      <div class="alert alert-success">
          {{ session('pesan') }}
      </div>
    @endif
  </div>

  <div class="col-md-6 mt-3">
    <label for="">Pilih Provinsi Asal</label>
      <select wire:model="provinsi1" class="form-control" name="provinsi1" required>
        <option value="0">-- Pilih Provinsi --</option>
          @foreach($listProvinsi as $key => $provinsi)
            <option value="{{$provinsi['province_id']}}">{{$provinsi['province']}}</option>
          @endforeach
      </select>
  </div>

  <div class="col-md-6 mt-3">
    <label for="">Pilih Kota Asal</label>
    <div wire:loading wire:target="provinsi1" class="la-ball-clip-rotate-multiple la-dark la-sm">
        <div></div>
        <div></div>
    </div>
      <select wire:model="origin" class="form-control" name="origin" required>
        @if(count($listKota) == 0)
          <option value="0">-- Pilih Kota --</option>
        @endif
        @foreach($listKota as $key => $kota)
          <option value="{{$kota['city_id']}}">{{$kota['type']." ".$kota['city_name']}}</option>
        @endforeach
      </select>
  </div>

  <div class="col-md-6 mt-3">
    <label for="">Pilih Provinsi Tujuan</label>
      <select wire:model="provinsi2" class="form-control" name="provinsi2" required>
        <option value="0">-- Pilih Provinsi --</option>
          @foreach($listProvinsi as $key => $provinsi2)
            <option value="{{$provinsi2['province_id']}}">{{$provinsi2['province']}}</option>
          @endforeach
      </select>
  </div>

  <div class="col-md-6 mt-3">
    <label for="">Pilih Kota Tujuan</label>
    <div wire:loading wire:target="provinsi2" class="la-ball-clip-rotate-multiple la-dark la-sm">
        <div></div>
        <div></div>
    </div>
      <select wire:model="destination" class="form-control" name="destination" required>
        @if(count($listKota2) == 0)
          <option value="0">-- Pilih Kota --</option>
        @endif
        @foreach($listKota2 as $key => $kota2)
          <option value="{{$kota2['city_id']}}">{{$kota2['type']." ".$kota2['city_name']}}</option>
        @endforeach
      </select>
  </div>

  <div class="col-md-12 mt-3">
    <label for="">Pilih Kurir</label>
      <select wire:model="courier" class="form-control" name="courier" required>
        <option value="">-- Pilih Kurir --</option>
        <option value="pos">Pos Indonesia</option>
        <option value="jne">JNE</option>
        <option value="tiki">TIKI</option>
      </select>
  </div>


  <div class="col-md-12 mt-3">
    <label for="">Berat (gram)</label>
    <input id="weight" type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" required wire:model="weight">
    @error('weight')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="col-md-12 mt-3">
    <label for="">Pilih Layanan Kurir {{strtoupper($courier)}}</label>
    <div wire:loading wire:target="weight" class="la-ball-clip-rotate-multiple la-dark la-sm">
        <div></div>
        <div></div>
    </div>
    <div wire:loading wire:target="courier" class="la-ball-clip-rotate-multiple la-dark la-sm">
        <div></div>
        <div></div>
    </div>
      <select wire:model="layananCourier" class="form-control" name="layananCourier" required>
        @if(!empty($listLayananCourier))
        @foreach($listLayananCourier as $layananCourir)
          <option value="{{$layananCourir['service']}},{{$layananCourir['cost'][0]['value']}}">{{strtoupper($courier)}} - {{$layananCourir['service']}} - Estimasi {{$layananCourir['cost'][0]['etd']}} Hari -  Rp. {{$layananCourir['cost'][0]['value']}} </option>
        @endforeach
        @else
        <option value="pilih,0">-- Pilih Layanan --</option>
        @endif
      </select>
  </div>

  <div class="col-md-12 mt-3">
    <label for="address">Masukkan Alamat Tujuan dengan lengkap</label>
    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" wire:model="address" required>
    @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>

  <div class="col-md-12 mt-3">
    <label for="">Perjelas alamat (nomor rumah, ancer ancer dll, boleh kosong)</label>
    <input id="address2" type="text" class="form-control @error('address2') is-invalid @enderror" name="address2" value="{{ old('address2') }}" wire:model="address2" >
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

  <hr class="mt-3">
  <div class="col-md-12">
    <h6 class="text-center">Detail transaksi</h6>
    <div class="table-responsive">
      <table class="table table-borderless table-sm" width="100%" cellspacing="0">
        <tr>
          <td width="50%">Ongkir</td>
          <td width="50%">
            @currency($ongkir)
            <div wire:loading wire:target="layananCourier" class="la-ball-clip-rotate-multiple la-dark la-sm">
                <div></div>
                <div></div>
            </div>
          </td>
        </tr>
        <tr>
          <td width="50%">Biaya Layanan</td>
          <td width="50%">@currency($harga)</td>
        </tr>
        <tr>
          <td width="50%">Sub Total</td>
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
    <div wire:loading wire:target="storePaket" class="la-ball-clip-rotate-multiple la-dark la-sm">
        <div></div>
        <div></div>
    </div>
  </div>
</form>
