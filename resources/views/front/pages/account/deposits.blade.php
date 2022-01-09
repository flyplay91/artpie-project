@extends('front.layouts.app')

@section('content')
  <div class="account-deposits-page">
    <div class="container">
      <div class="block-admin-deposit">
        <h2>{{ __('messages.deposit_funds') }}</h2>
        <form class="deposit-form" method="post" action="{{ route('process-deposit') }}">
          @csrf

          <div class="deposit-form__inner flex aic jcb">
            <img src="/images/wechat-icon.png" />
          
            <div class="deposit-form-price flex aic jcb">
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ __('messages.price_2') }} (USD)</span>
                </div>
                <input type="number" name="amount" class="form-control">
              </div>
              <button class="btn btn-grey" type="submit">{{ __('messages.send_request') }}</button>
            </div>
        </div>

        <div class="text-right">
          <a href="/my-gallery" class="btn btn-grey">{{ __('messages.cancel') }}</a>
        </div>
      </div>

      
    </div>
  </div>
@endsection