<link rel="icon" type="image/x-icon" href="/images/favicon.png">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="{{ asset('css/front/app.css') }}" rel="stylesheet">



<div class="login-signup-form login-form">
  <h2 class="text-center">로그인</h2>
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="login-form__email form-group mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">전자우편*</span>
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
          <span class="input-group-text">암호*</span>
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
          <input type="checkbox" class="" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>정보를 기억
          <div class="chkBox2_box"></div>
        </label>
      </div>
      <a href="">암호를 잊었습니까?</a>
    </div>
  
    <div class="login-form__submit">
      <button type="submit" class="btn btn-grey">
        로그인
      </button>
    </div>
  </form>

  <p class="text-center mt-5">아직 계정이 없습니까? <a href="{{ route('register') }}">새로 등록</a></p>
</div>
