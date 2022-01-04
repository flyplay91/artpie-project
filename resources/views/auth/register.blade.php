@extends('front.layouts.app')

@section('content')

<div class="auth-form register-form">
  <h2 class="text-center">{{ __('messages.register') }}</h2>
  <form method="POST" action="{{ route('register') }}">
      @csrf

    <div class="register-form__name form-group mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">{{ __('messages.name') }}*</span>
        </div>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="register-form__email form-group mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">{{ __('messages.email') }}*</span>
        </div>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="register-form__password form-group mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">{{ __('messages.password') }}*</span>
        </div>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="register-form__confirm-password form-group mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">{{ __('messages.confirm_password') }}*</span>
        </div>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
      </div>
    </div>

    <div class="register-form__submit mt-4 mb-3">
      <button type="submit" class="btn btn-grey">
      {{ __('messages.register') }}
      </button>
    </div>
  </form>

  <p class="text-center">{{ __('messages.already_account') }}? <a href="{{ route('login') }}">{{ __('messages.login') }}</a></p>
</div>
@endsection