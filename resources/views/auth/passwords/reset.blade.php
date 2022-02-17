@extends('layouts.auth.app')
@section('titleAuth', 'Packclese - Reset Password')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="p-5">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">{{ __('Reset Password') }}</h1>
      </div>
      <form method="POST" action="{{ route('password.update') }}" class="user">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <div class="form-group">
              <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address">
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>

          <div class="form-group">
            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
          </div>
          <button type="submit" class="btn btn-primary btn-user btn-block">
            {{ __('Reset Password') }}
          </button>
      </form>
    </div>
  </div>
</div>
@endsection
