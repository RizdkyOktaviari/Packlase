@extends('layouts.auth.app')
@section('titleAuth', 'Packclese - Register')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="p-5">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">{{ __('Register') }}</h1>
      </div>
      <form method="POST" action="{{ route('register') }}" class="user">
        @csrf
        <div class="form-group">
          <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="email" autofocus aria-describedby="emailHelp" placeholder="Enter Your Name...">
          @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group">
          <input id="address" type="text" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus aria-describedby="emailHelp" placeholder="Enter Your Address...">
          @error('address')
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
<div class="mt-5 text-muted text-center">
  Have an account? <a href="{{route('login')}}">Login Here</a>
</div>
<div class="simple-footer text-center">
  Copyright &copy; Packclese 2021
</div>
@endsection
