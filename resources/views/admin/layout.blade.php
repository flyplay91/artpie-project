<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KArtPie Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">

    <!-- Script -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/macy.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/app.js') }}"></script>
</head>

<body>
  <div id="adWrapper" class="position-relative @if (Route::currentRouteName() == 'admin-order.index') long-height @endif">
    <div class="bg-overlay position-absolute"></div>
    <div class="ad-header">
      <div class="ad-header-nav">
        <div class="ad-header-nav__inner wrapper flex">
          <a href="/" class="flex aic jcc"><img src="/images/logo.png"></a>
          <a href="/" class="active">그림보기</a>
        </div>
      </div>
      @yield('main-header')

      <div class="wrapper header-logo-nav flex aic">
        <div class="header__nav flex aic">
          <a href="/admin-gallery" class="@if(Route::currentRouteName() == 'admin-gallery.index')active @endif">그림</a>
          <a href="/admin-user" class="@if(Route::currentRouteName() == 'admin-user.index')active @endif">사용자</a>
          <a href="/admin-order" class="@if(Route::currentRouteName() == 'admin-order.index')active @endif">
            주문
            @if (!empty($processingOrderCount))
              <span>({{ $processingOrderCount }})</span>
            @endif
          </a>
          <a href="/admin-deposit" class="@if(Route::currentRouteName() == 'admin-deposit.index')active @endif">입금</a>
          <!-- <label class="sub-menu">
            Payments
            <ul>
              <li><a href="/admin-deposit">Deposit</a></li>
              <li><a href="/admin-widraw">Widraw</a></li>
              <li><a href="/admin-transaction">Transaction</a></li>
            </ul>
          </label>
          <a href="" class="">Tickets</a>
          <a href="" class="">Manage</a>
          <a href="" class="">Settings</a> -->
        </div>
      </div>
    </div>

    <div class="ad-body  <?php if((Request::path() == 'admin-gallery') || (Route::currentRouteName() == 'admin-gallery.edit') || Route::currentRouteName() == 'admin-gallery.create' || Request::path() == 'admin-order' || Request::path() == 'admin-user' || Request::path() == 'admin-deposit') { echo 'wrapper'; } else { echo 'mt-3'; } ?>">
      @yield('content')
    </div>

    <div class="ad-footer">
      <meta name="_token" content="{{ csrf_token() }}">
      <div class="popup-header position-absolute">
        
          <form action="{{ route('admin-header-data.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input form-control" id="headerImage" required>
                  <label class="custom-file-label" for="headerImage">Choose file</label>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Product Title</span>
                </div>
                <input type="text" name="title" class="input-header-title form-control" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Product Sub Title</span>
                </div>
                <input type="text" name="sub_title" class="input-header-subtitle form-control" required>
              </div>
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn btn-grey">Add</button>
              <a href="javascript:void(0)" class="btn-grey btn-update-cancel">Cancel</a>
            </div>
          </form>
          
      </div>
    </div>
  </div>
</body>
</html>