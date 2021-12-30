@extends('front.layouts.app')

@section('content')

<!-- @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif -->
<div class="setting-page" data-user-id="{{Auth::id()}}">
  <h2 class="user-name">My Account - {{ $user->name }}</h2>
  <div class="user-info">
    <div class="user-info__inner">
      <div class="user-info__name flex aic">
        <label>Name: </label>
        <span>{{ $user->name }}</span>
      </div>
      <div class="user-info__email flex aic">
        <label>Email: </label>
        <span>{{ $user->email }}</span>
      </div>
      <div class="user-info__address flex aic">
        <label>Address 1: </label>
        @if (isset($user->address_1))
        <span>{{ $user->address_1 }}</span>
        @endif
      </div>
      @if (isset($user->address_2))
        <div class="user-info__address flex aic">
          <label>Address 2: </label>
          <span>{{ $user->address_2 }}</span>
        </div>
      @endif
      @if (isset($user->address_3))
        <div class="user-info__address flex aic">
          <label>Address 3: </label>
          <span>{{ $user->address_3 }}</span>
        </div>
      @endif
      @if (isset($user->address_4))
        <div class="user-info__address flex aic">
          <label>Address 4: </label>
          <span>{{ $user->address_4 }}</span>
        </div>
      @endif
      @if (isset($user->address_5))
        <div class="user-info__address flex aic">
          <label>Address 5: </label>
          <span>{{ $user->address_5 }}</span>
        </div>
      @endif
    </div>

    <div class="update-user-info-password flex aic jca">
      <a href="javascript:void(0)" class="btn-grey btn-user-info">Update Information</a>
      <a href="javascript:void(0)" class="btn-grey btn-update-password">Update Password</a>
      <a href="javascript:void(0)" class="btn-grey btn-close-account">Close Account</a>
    </div>
  </div>

  <div class="popup-user popup-user--info">
    
    <form action="{{ route('update-user-info.update',Auth::id()) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="update-user-name input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Name</span>
        </div>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
      </div>
        
      <div class="update-user-email input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Email</span>
        </div>
        <input type="text" name="email" value="{{ $user->email }}" class="form-control">
      </div>

      <div class="update-user-address update-user-address--1 input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Address 1</span>
        </div>
        <input type="text" name="address_1" value="<?php if (isset($user->address_1)) { echo $user->address_1; } ?>" class="form-control" required>
      </div>

      @if (isset($user->address_2))
      <div class="update-user-address update-user-address--2 input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Address 2</span>
        </div>
        <input type="text" name="address_2" value="{{ $user->address_2 }}" class="form-control" required>
      </div>
      @endif

      @if (isset($user->address_3))
      <div class="update-user-address update-user-address--3 input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Address 3</span>
        </div>
        <input type="text" name="address_3" value="{{ $user->address_3 }}" class="form-control" required>
      </div>
      @endif

      @if (isset($user->address_4))
      <div class="update-user-address update-user-address--4 input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Address 4</span>
        </div>
        <input type="text" name="address_4" value="{{ $user->address_4 }}" class="form-control" required>
      </div>
      @endif

      @if (isset($user->address_5))
      <div class="update-user-address update-user-address--5 input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Address 5</span>
        </div>
        <input type="text" name="address_5" value="{{ $user->address_5 }}" class="form-control" required>
      </div>
      @endif

      <div class="circle-plus">
        <img src="/images/circle-plus-icon.png">
      </div>

      <button type="submit" class="btn-grey btn-update-user">Save Changes</button>
    </form>
    
  </div>

  <div class="popup-user popup-user--password">
    <form method="POST" action="{{ route('change.password') }}">
      @csrf 

        @foreach ($errors->all() as $error)
          <p class="text-danger">{{ $error }}</p>
        @endforeach 

      <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

          <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
          </div>
      </div>

      <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

          <div class="col-md-6">
              <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
          </div>
      </div>

      <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

          <div class="col-md-6">
              <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
          </div>
      </div>

      <div class="form-group row mb-0">
          <div class="col-md-8 offset-md-4">
              <button type="submit" class="btn btn-grey">
                  Update Password
              </button>
          </div>
      </div>
    </form>
  </div>

  <div class="popup-user popup-user--close">
    <form action="{{ route('update-user-info.destroy',Auth::id()) }}" method="POST" enctype="multipart/form-data">
      @method('DELETE')
      @csrf
      <p>Are you sure?</p>
      <button type="submit" class="btn-grey btn-delete-user">Delete</button>
    </form>
  </div>

</div>
@endsection