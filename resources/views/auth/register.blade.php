@extends('front.layouts.app')

@section('content')

<div class="auth-form register-form">
  <h2 class="text-center">새로 등록</h2>
  <form method="POST" action="{{ route('register') }}">
      @csrf

    <div class="register-form__name form-group mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">이름*</span>
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
          <span class="input-group-text">전자우편*</span>
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
          <span class="input-group-text">암호*</span>
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
          <span class="input-group-text">암호확인*</span>
        </div>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
      </div>
    </div>

    <div class="register-form__submit mt-4 mb-3">
      <button type="submit" class="btn btn-grey">
        등록
      </button>
    </div>
  </form>

  <p class="text-center">이미 계정이 있습니까? <a href="{{ route('login') }}">로그인</a></p>
</div>
@endsection