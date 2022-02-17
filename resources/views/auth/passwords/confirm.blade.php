@extends('layouts.auth.app')
@section('titleAuth', 'Packclese - Confirm Password')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="p-5">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">{{ __('Confirm Password') }}</h1>
      </div>
      <p class="text-muted">{{ __('Please confirm your password before continuing.') }}</p>
      <form method="POST" action="{{ route('password.confirm') }}" class="user">
          @csrf
          <div class="form-group">
            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary btn-user btn-block">
              {{ __('Confirm Password') }}
          </button>

          @if (Route::has('password.request'))
              <a class="btn btn-link" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
              </a>
          @endif
      </form>
    </div>
  </div>
</div>
@endsection
