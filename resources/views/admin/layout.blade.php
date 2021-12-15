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
  <div id="adWrapper" class="position-relative">
    <div class="bg-overlay position-absolute"></div>
    <div class="ad-header">
      @yield('main-header')

      <div class="wrapper header-logo-nav flex aic">
        <div class="header__nav flex aic">
          <a href="/admin-gallery" class="active">Gallery</a>
          <a href="/admin-user" class="">Users</a>
          <label class="sub-menu">
            Payments
            <ul>
              <li><a href="/admin-deposit">Deposit</a></li>
              <li><a href="/admin-widraw">Widraw</a></li>
              <li><a href="/admin-transaction">Transaction</a></li>
            </ul>
          </label>
          <a href="" class="">Tickets</a>
          <a href="" class="">Manage</a>
          <a href="" class="">Settings</a>
        </div>
      </div>
    </div>

    <div class="ad-body <?php if(Route::currentRouteName() == 'admin-gallery.index') { echo 'wrapper'; } else { echo 'mt-3'; } ?>">
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