@extends('front.layouts.app')

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
@section('content')

<div class="checkout-page">
  <div class="checkout-page__address">
    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="user_id" value="{{ $user->id }}">
      
      
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

      <div class="checkout-gallery-info">
        <div class="checkout-gallery-info__inner">
          @if (isset($gallerys))
            @foreach ($gallerys as $gallery)
              <div class="checkout-gallery-item flex aic jcb">
                <input type="hidden" name="gallery_id[]" value="{{ $gallery->id }}">
                <input type="hidden" name="image[]" value="{{ $gallery->image }}">
                <input type="hidden" name="title[]" value="{{ $gallery->title }}">
                <input type="hidden" name="price[]" value="{{ number_format($gallery->actual_price, 2) }}">
                

                <div class="checkout-gallery-image">
                  <img src="/images/{{ $gallery->image }}">
                </div>
                <div class="checkout-gallery-title w-20">
                  <label>{{ $gallery->title }}</label>
                </div>
                <div class="checkout-gallery-price flex aic">
                  <span>¥</span><label>{{ number_format($gallery->actual_price, 2) }}</label>
                </div>
                <div class="checkout-gallery-qty flex aic">
                  <span class="btn-minus-qty"><img src="/images/minus-icon.png"></span>
                  <input type="text" name="qty[]" value="1">
                  <span class="btn-plus-qty"><img src="/images/plus-icon.png"></span>
                </div>
                <div class="checkout-gallery-subtotal-price flex aic">
                  <span>¥</span><label>{{ number_format($gallery->actual_price, 2) }}</label>
                </div>
              </div>
            @endforeach
          @endif
        </div>
        <input type="hidden" name="total_price" value="" class="total-price-value">

        <div class="checkout-gallery-total-price flex aic jce">
          <strong>Total: </strong>
          <span> ¥</span>
          <label></label>
        </div>
        
      </div>

      <div class="checkout-btn text-right">
        <button type="submit" class="btn-grey btn-update-user">Checkout</button>
      </div>
    </form>
  </div>
</div>
@endsection