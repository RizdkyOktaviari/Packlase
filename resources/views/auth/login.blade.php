@extends('layouts.auth.app')
@section('titleAuth', 'Packclese - Login')
@section('content')
<!-- Nested Row within Card Body -->
<div class="row">
  <div class="col-lg-12">
    <div class="p-5">
      <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">{{ __('Login') }}</h1>
      </div>
      <form method="POST" action="{{ route('login') }}" class="user">
        @csrf
        <div class="form-group">
          <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp" placeholder="Enter Email Address...">

          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox small">
            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="custom-control-label" for="remember">
                {{ __('Remember Me') }}
            </label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block" >
            {{ __('Login') }}
        </button>

      <a href="{{ url('auth/google') }}"class="btn btn-primary btn-user btn-block"> Google <i class="fab fa-google"></i>

        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
      </form>
    </div>
  </div>
</div>
<div class="mt-5 text-muted text-center">
  Don't have an account? <a href="{{route('register')}}">Create One</a>
</div>
<div class="simple-footer text-center">
  Copyright &copy; Packclese 2021
</div>
@endsection
