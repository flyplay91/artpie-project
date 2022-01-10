@extends('front.layouts.app')

@section('content')
  <div class="account-deposits-page">
    
    <h2>{{ __('messages.deposit_funds') }}</h2>
    <form class="deposit-form" method="post" action="{{ route('process-deposit') }}">
      @csrf

      <div class="deposit-form__inner flex aie jcb">
        <img src="/images/WeChat Image_20220104184111_resized_400x.jpg">
        
        <div class="deposit-form-price flex-column flex aic jcb">
          
          <div class="flex jcb w-100 mt-2">
            <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text">{{ __('messages.price_2') }} (USD)</span>
              </div>
              <input type="number" name="amount" class="form-control">
            </div>
            <button class="btn btn-grey" type="submit">{{ __('messages.send_request') }}</button>
          </div>
            
          <div class="w-100 mt-3 text-right">
            <a href="/my-gallery" class="btn btn-grey">{{ __('messages.cancel') }}</a>
          </div>
        </div>
        
      </div>
    </form>

  </div>
@endsection