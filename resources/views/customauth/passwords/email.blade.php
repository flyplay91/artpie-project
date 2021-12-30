@extends('front.layouts.app')

@section('content')

<div class="auth-form forgot-password">
  <h2 class="text-center">암호 재설정</h2>
     
  @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif
                
  <form method="POST" action="/forget-password">
    @csrf
    <div class="reset-password-form__email form-group mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">전자우편*</span>
        </div>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>
    </div>

    <div class="reset-password-form__submit mt-4 mb-3">
      <button type="submit" class="btn btn-grey">
      재설정
      </button>
    </div>
  </form>
  <p class="text-center"><a href="{{ route('login') }}">로그인에로 가기</a></p>
</div>

@endsection