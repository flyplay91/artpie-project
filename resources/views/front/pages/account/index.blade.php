@extends('front.layouts.app')

@section('content')

  @if (isset($gallery))
  <div class="get-gallery">
    <h3>그림구매</h3>
    <div class="get-gallery__inner">
      <div class="get-gallery-image-info flex jcb">
        <div class="get-gallery-image">
          <img src="/images/{{ $gallery->image }}">
        </div>
        <div class="get-gallery-info">
          <label class="gallery-number">No. {{ sprintf("%07d", $gallery->id) }}</label>
          <h2>{{ $gallery->title }}<span>({{ $category->cat_name }})</span></h2>
          <div class="get-gallery-info-item">
            <label>크기: {{ $gallery->width }} * {{ $gallery->height }} {{ $gallery->unit }}</label>
          </div>
          <div class="get-gallery-info-item">
            <label>가격: {{ $gallery->retail_price }} USD</label>
          </div>
          <div class="get-gallery-info-item">
            <label>작가: {{ $artist->art_name }}</label>
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
              <span class="input-group-text">전자우편*</span>
            </div>
            <input type="text" value="" name="billing_email" class="form-control billing-email" required>
          </div>
        </div>

        <div class="form-group mb-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">전화번호*</span>
            </div>
            <input type="text" value="" name="billing_phone" class="form-control billing-phone" required>
          </div>
        </div>

        <div class="form-group mb-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">주소*</span>
            </div>
            <input type="text" value="" name="billing_address" class="form-control billing-address" required>
          </div>
        </div>

        <div class="form-group mb-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">수하인 이름*</span>
            </div>
            <input type="text" value="" name="billing_name" class="form-control billing-name" required>
          </div>
        </div>

        <div class="form-group mb-3">
          <label>설명(지불방법, 배송, 기타 요구사항을 기입하십시오.)</label>
          <textarea name="comment" rows="7" class="form-control billing-comment"></textarea>
        </div>

        <div class="agree-check-btns flex aic jcb">
          <div class="boxCtnt">
            <label class="chkBox2">
              <input type="checkbox" class="check-billing-info" name="check_billing_info"><a href="/contract"><i>사용계약(환불정책)</i></a>에 동의합니다.
              <div class="chkBox2_box"></div>
            </label>
          </div>

          <div class="btns-save-cancel text-right">
            <a href="javascript:void(0)" class="btn-grey btn-save">구입요청 보내기</a>
            <a href="javascript:void(0)" class="btn-grey btn-cancel">취소</a>
          </div>
        </div>
      
      </div>
    </div>
  </div>
  @endif
@endsection