@extends('layouts.admin.app')
@section('titles', 'Tambah Voucher')
@section('maincontent')

  <div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Voucher</h1>
    <p class="mb-4">Packclese</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tambah Voucher</h6>
      </div>
      <div class="card-body">
        <form action="{{route('store-voucher')}}" method="post">
          {{csrf_field()}}

          <div class="form-group">
            <label for="name">Kode Voucher</label>
            <input type="text" name="voucher_code" class="form-control @error('voucher_code') is-invalid @enderror" value="{{ old('voucher_code') }}" placeholder="Kode Voucher">
              @error('voucher_code')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group">
            <label for="diskon">Diskon (%)</label>
            <input type="text" name="discount" class="form-control @error('discount') is-invalid @enderror" value="{{ old('discount') }}" placeholder="Diskon">
              @error('discount')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group">
            <label for="expired">Tanggal Kadaluarsa</label>
            <input type="date" name="expired" class="form-control">
          </div>

          <div class="form-group">
            <div class="text-left">
              <button type="submit" class="btn btn-success">Create</button>
            </div>
          </div>
        </form>
          </div>
      </div>
  </div>
@endsection
