<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>KArtPie</title>
  <link rel="icon" type="image/x-icon" href="/images/favicon.png">

  <!-- Styles -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/front/app.css') }}" rel="stylesheet">


  <!-- Script -->
  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/macy.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/front/app.js') }}"></script>
  
</head>

<body>
  <div id="mainWrapper">
    @auth
      <input type="hidden" class="auth-id" value="{{ Auth::user()->id }}">
    @endauth

    @if (session()->get('locale') == 'en')
      <input type="hidden" class="selected-lang" value="en">
    @elseif (session()->get('locale') == 'ch')
      <input type="hidden" class="selected-lang" value="ch">
    @elseif (session()->get('locale') == 'ko')
      <input type="hidden" class="selected-lang" value="ko">
    @else 
      <input type="hidden" class="selected-lang" value="en">
    @endif
    <div class="bg-overlay"><label>X</label></div>
    <div class="header">
      <div class="wrapper header-logo-nav flex aic jcb">
        <div class="header__logo flex aic">
          <a href="/" class="flex aic jcc"><img src="/images/logo.png"></a>
          <a href="/" class="active">{{ __('messages.purchase_painting') }}</a>
          @auth
            @if (auth()->user()->isSuperAdmin())
              <a href="/admin-gallery">{{ __('messages.admin_dashboard') }}</a>
            @endif
          @endauth
        </div>
        <div class="header__nav">
          <div class="header__navInner flex aic">
            <div class="header-nav-dropdown language">
              <select class="form-control changeLang">
                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                <option value="ch" {{ session()->get('locale') == 'ch' ? 'selected' : '' }}>Chinese</option>
                <option value="ko" {{ session()->get('locale') == 'ko' ? 'selected' : '' }}>Korean</option>
              </select>
            </div>

            @auth
            <div class="header-nav-dropdown my-profile">
              <label data-user-id="{{ auth()->user()->id }}">{{auth()->user()->name }}</label>
              <ul>
                <li><a href="/my-gallery">{{ __('messages.my_gallery') }}</a></li>
                <li><a href="/my-order">My Order</a></li>
                <li><a href="/setting">{{ __('messages.setting') }}</a></li>
              </ul>
            </div>
            @endauth
            
            @guest
            <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
              @if (Route::has('register'))
                <!-- <a href="{{ route('register') }}">{{ __('messages.register') }}</a> -->
              @endif
            @else
              <a href="{{ route('logout') }}">
                {{ __('messages.logout') }}
              </a>
            @endguest
          </div>
        </div>
      </div>
    </div>

    <div class="body wrapper @if (Request::path() == 'contact-gallery') position-relative @endif">
        @yield('content')
    </div>

    <div class="footer {{Request::path()}} <?php if((Request::path() == 'setting') || (Request::path() == 'contact-gallery') || (Request::path() == 'login') || (Request::path() == 'register') || (Request::path() == 'forget-password')  || (Request::path() == 'account/deposits')) { echo 'fixed-footer'; } ?>">
      <div class="footer__inner wrapper flex aic jcb">
      {{--
        <div class="footer-nav">
        
          <ul class="flex aic">
            <li><a href="#">{{ __('messages.terms_of_use') }}</a></li>
            <li><a href="#">{{ __('messages.privacy_policy') }}</a></li>
            <li><a href="#">{{ __('messages.contact_us') }}</a></li>
          </ul>
          
        </div>
        
        <div class="footer-copyright">
          Copyright@ 2022 Hunchun Longchao  Co., LTD
        </div>
      </div>
      --}}
    </div>
  </div>
</body>

<script type="text/javascript">
  
    var url = "{{ route('changeLang') }}";
  
    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });
  
</script>
</html>