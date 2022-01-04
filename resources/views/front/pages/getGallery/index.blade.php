@extends('front.layouts.app')

@section('content')

  @if (isset($gallery))
  <div class="get-gallery">
    <h3>{{ __('messages.purchase_painting') }}</h3>
    <div class="get-gallery__inner">
      <div class="get-gallery-image-info flex jcb">
        <div class="get-gallery-image">
          <img src="/images/{{ $gallery->image }}">
        </div>
        <div class="get-gallery-info">
          <label class="gallery-number">No. {{ sprintf("%07d", $gallery->id) }}</label>
          <h2>
            @if (session()->get('locale') == 'en')
              {{ $gallery->title }}
              <span>
                ({{ $category->cat_name }})
              </span>
            @elseif (session()->get('locale') == 'ch')
              {{ $gallery->title_ch }}
              <span>
                ({{ $category->cat_name_ch }})
              </span>
            @elseif (session()->get('locale') == 'ko')
              {{ $gallery->title_ko }}
              <span>
                ({{ $category->cat_name_ko }})
              </span>
            @else 
              {{ $gallery->title }}
              <span>
                ({{ $category->cat_name }})
              </span>
            @endif
            
          </h2>
          <div class="get-gallery-info-item">
            <label>{{ __('messages.dimension') }}: {{ $gallery->width }} * {{ $gallery->height }} {{ $gallery->unit }}</label>
          </div>
          <div class="get-gallery-info-item">
            <label>{{ __('messages.price') }}: {{ $gallery->retail_price }} RMB</label>
          </div>
          <div class="get-gallery-info-item">
            <label>{{ __('messages.artist') }}: 
              @if (session()->get('locale') == 'en')
                {{ $artist->art_name }}
              @elseif (session()->get('locale') == 'ch')
                {{ $artist->art_name_ch }}
              @elseif (session()->get('locale') == 'ko')
                {{ $artist->art_name_ko }}
              @else 
                {{ $artist->art_name }}
              @endif
              
            </label>
          </div>
        </div>
      </div>

      <div class="get-gallery-contact mt-3">
        @auth
          <input type="hidden" name="user_id" class="user-id" value="{{ Auth::user()->id }}">
        @endauth
        <input type="hidden" name="total_price" class="total-price" value="{{ $gallery->retail_price }}">
        <input type="hidden" class="gallery-id" value="{{ $gallery->id }}">
        <div class="form-group mb-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">{{ __('messages.email') }}*</span>
            </div>
            <input type="text" value="" name="billing_email" class="form-control billing-email" required>
          </div>
        </div>

        <div class="form-group mb-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">{{ __('messages.phone_nuber') }}*</span>
            </div>
            <input type="text" value="" name="billing_phone" class="form-control billing-phone" required>
          </div>
        </div>

        <div class="form-group mb-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">{{ __('messages.address') }}*</span>
            </div>
            <input type="text" value="" name="billing_address" class="form-control billing-address" required>
          </div>
        </div>

        <div class="form-group mb-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">{{ __('messages.recipient_name') }}*</span>
            </div>
            <input type="text" value="" name="billing_name" class="form-control billing-name" required>
          </div>
        </div>

        <div class="form-group mb-3">
          <label>{{ __('messages.recipient_description') }}</label>
          <textarea name="comment" rows="7" class="form-control billing-comment"></textarea>
        </div>

        <div class="agree-check-btns flex aic jcb">
          <div class="boxCtnt">
            <label class="chkBox2">
              <input type="checkbox" class="check-billing-info" name="check_billing_info"><a href="/contract"><i>{{ __('messages.agree_terms_use') }}</i>
              <div class="chkBox2_box"></div>
            </label>
          </div>

          <div class="btns-save-cancel text-right">
            <a href="javascript:void(0)" class="btn-grey btn-save">{{ __('messages.order_request') }}</a>
            <a href="/" class="btn-grey btn-cancel">{{ __('messages.cancel') }}</a>
          </div>
        </div>
      
      </div>
    </div>
  </div>
  @endif
@endsection