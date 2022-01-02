<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>KoldArt</title>
  <link rel="icon" type="image/x-icon" href="/images/favicon.png">

  <!-- Styles -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="{{ asset('css/front/app.css') }}" rel="stylesheet">


  <!-- Script -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/front/app.js') }}"></script>
  
</head>

<body>
  <div id="mainWrapper">
    <div class="bg-overlay"><label>X</label></div>
    <div class="header">
      <div class="wrapper header-logo-nav flex aic jcb">
        <div class="header__logo flex aic">
          <a href="/" class="flex aic jcc"><img src="/images/logo.png"></a>
          <a href="/" class="active">그림구입</a>
          @auth
            @if (auth()->user()->isSuperAdmin())
              <a href="/admin-gallery">Admin Dashboard</a>
            @endif
          @endauth
        </div>
        <div class="header__nav">
          <div class="header__navInner flex aic">
            <div class="header-nav-dropdown language">
              <label>Korean</label>
              <ul>
                <li><a href="">Korean</a></li>
                <li><a href="">Chinese</a></li>
                <li><a href="">English</a></li>
              </ul>
            </div>

            @auth
            <div class="header-nav-dropdown my-profile">
              <label>Profile</label>
              <ul>
                <li><a href="">나의 갤러리</a></li>
                <li><a href="/setting">설정</a></li>
              </ul>
            </div>
            @endauth
            
            @guest
            <a href="{{ route('login') }}">{{ __('Login') }}</a>
              @if (Route::has('register'))
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
              @endif
            @else
              <a href="{{ route('logout') }}">
                {{ __('Logout') }}
              </a>
            @endguest
          </div>
        </div>
      </div>
    </div>

    <div class="body wrapper">
        @yield('content')
    </div>

    <div class="footer {{Request::path()}} <?php if((Request::path() == 'setting') || (Request::path() == 'contact-gallery') || (Request::path() == 'login') || (Request::path() == 'register') || (Request::path() == 'forget-password')) { echo 'fixed-footer'; } ?>">
      <div class="footer__inner wrapper flex aic jcb">
        <div class="footer-nav">
          <ul class="flex aic">
            <li><a href="#">홈페지공유</a></li>
            <li><a href="#">사용계약</a></li>
            <li><a href="#">개인정보보호</a></li>
            <li><a href="#">련계</a></li>
          </ul>
        </div>
        <div class="footer-copyright">
          Copyright@ 2021 ArtPie LLC
        </div>
      </div>
    </div>
  </div>
</body>
</html>