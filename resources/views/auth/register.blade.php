<link rel="icon" type="image/x-icon" href="/images/favicon.png">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="{{ asset('css/front/app.css') }}" rel="stylesheet">

<div class="login-signup-form register-form">
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

    <div class="register-form__submit">
      <button type="submit" class="btn btn-grey">
        등록
      </button>
    </div>
  </form>
</div>
