@extends('front.layouts.app')

@section('content')



<div class="auth-form login-form">
  <h2 class="text-center">{{ __('messages.login') }}</h2>
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="login-form__email form-group mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">{{ __('messages.email') }}*</span>
        </div>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
      </div>

      @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="login-form__password form-group mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">{{ __('messages.password') }}*</span>
        </div>
        <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="login-form__save-forget flex aic jcb">
      <div class="boxCtnt form-check">
        <label class="chkBox2">
          <input type="checkbox" class="" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('messages.remember_me') }}
          <div class="chkBox2_box"></div>
        </label>
      </div>
      <!-- <a href="/forget-password">{{ __('messages.forgot_password') }}?</a> -->
    </div>
  
    <div class="login-form__submit mt-4 mb-3">
      <button type="submit" class="btn btn-grey">
        {{ __('messages.login') }}
      </button>
    </div>
  </form>

  <p class="text-center">{{ __('messages.no_account') }}? <a href="{{ route('register') }}">{{ __('messages.register') }}</a></p>
</div>
@endsection