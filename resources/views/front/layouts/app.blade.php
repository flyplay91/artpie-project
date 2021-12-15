<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Artpie Front</title>

    <!-- Styles -->
    <link href="{{ asset('css/front/app.css') }}" rel="stylesheet">

    <!-- Script -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/front/app.js') }}"></script>
</head>

<body>
    <div id="mainWrapper">
        <div class="bg-overlay"><label>X</label></div>
        <div class="header">
            <div class="wrapper header-logo-nav flex aic jcb">
                <div class="header__logo flex aic">
                    <a href="/" class="flex aic jcc"><img src="/images/artpal.png"></a>
                    <a href="#" class="active">그림구입</a>
                </div>
                <div class="header__nav flex aic">
                    <ul>
                        <li class="active">Korean</li>
                        <li>Chinese</li>
                        <li>English</li>
                    </ul>
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

        <div class="body wrapper">
            @yield('content')
        </div>

        <div class="footer">
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