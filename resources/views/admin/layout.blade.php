<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Artpie Dashboard</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">

    <!-- Script -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b1eb609035.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{{ asset('js/admin/app.js') }}"></script>
</head>

<body>
  <div id="adWrapper">
    @if (Route::currentRouteName() == 'admin-gallery.index')
    <div class="ad-header">
      <div class="hdrBg" style="background-image: url(/images/hero-bg.jpg)">
        <div class="hdrBgTint"></div>
        <div class="bHdr">
          <div class="bHdrTxt">
            <h1>이름있는 화가들의 그림, 더는 부자들만의것이 아닙니다.</h1>
            <span>그림도 소장하고 돈도 버십시오.</span>
          </div>
        </div>
      </div>
      <div class="wrapper header-logo-nav flex aic">
        <div class="header__logo flex aic">
          <a href="/admin-gallerys" class="active">Gallery</a>
          <a href="" class="">Users</a>
          <a href="" class="">Payments</a>
          <a href="" class="">Tickets</a>
          <a href="" class="">Manage</a>
          <a href="" class="">Settings</a>
        </div>
      </div>
    </div>
    @endif

    <div class="ad-body wrapper">
      @yield('content')
    </div>
  </div>
</body>
</html>