@extends('layouts.auth.app')
@section('titleAuth', 'Packclese - Reset Password')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="p-5">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">{{ __('Reset Password') }}</h1>
      </div>
      @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
      @endif
      <p class="text-muted">We will send a link to reset your password</p>
      <form method="POST" action="{{ route('password.email') }}" class="user">
          @csrf
          <div class="form-group">
            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Send Password Reset Link') }}
            </button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
