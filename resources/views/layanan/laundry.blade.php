@extends('layouts.layanan.app')
@section('layananContent')
<!-- Page Content-->
<div class="container px-4 px-lg-5">
  <!-- Call to Action-->
  <div class="card text-white bg-secondary my-5 py-4 text-center">
      <div class="card-body"><p class="text-white m-0">This call to action card is a great place to showcase some important information or display a clever tagline!</p></div>
  </div>
    <!-- Content Row-->
  <div class="row">
    <div class="col-lg-6">
      gambar
    </div>
    <div class="col-lg-6">
      <div class="p-5">
        <div class="text-center">
          <h1 class="h4 text-gray-900 mb-4">Laundry</h1>
        </div>
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="form-group">
            <select class="form-control @error('jenisservice_id') is-invalid @enderror" name="jenisservice_id">
              <option disabled selected>Jenis Laundry</option>
                @foreach($laundry as $laundrys)
                  <option value="{{$laundrys->id}}" clas>{{$laundrys->name}}</option>
                @endforeach
            </select>
            @error('jenisservice_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <input id="weight" type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" required autofocus placeholder="Input perkiraan berat (Kg)...">
            @error('weight')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <input id="phonenumber" type="number" class="form-control form-control-user @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') }}" required autocomplete="phonenumber" autofocus aria-describedby="emailHelp" placeholder="Enter Your Phone Number...">
            @error('phonenumber')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp" placeholder="Enter Your Email Address...">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus aria-describedby="emailHelp" placeholder="Enter Your password ...">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Your password ...">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Register') }}
            </button>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
