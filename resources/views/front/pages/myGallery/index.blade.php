@extends('front.layouts.app')

@section('content')
@if (isset($headerdata))
<div class="hdrBg mygallery-hero" style="background-image: url('/images/<?php echo $headerdata->image ?>')">
  <div class="bHdr">
    <div class="mygallery-price-info-btns flex jcb">
      <div class="mygallery-price-info flex">
        <div class="mygallery-price-label text-right">
          <label>사용가능한 금액:</label>
          <label>투자한 금액:</label>
          <label>현재 가치:</label>
          <label>예상 수입금액:</label>
        </div>
        <div class="mygallery-price-value text-left">
          <label>10000 (USD)</label>
          <label>20000 (USD)</label>
          <label>20123 (USD)</label>
          <label>21000 (USD)</label>
        </div>
      </div>
      <div class="mygallery-price-btns">
        <a href="" class="btn-grey">출금</a>
        <a href="" class="btn-grey">입금</a>
      </div>
    </div>

    <div class="sBoxW">
      <div class="sBox gallery-search">
        <input type="text" name="s" placeholder="{{ __('messages.title_painter') }}" class="s">
        <a href="javascript:void(0)"><img src="/images/search-icon.png"></a>
      </div>
    </div>
  </div>
</div>
@endif

<div class="page-title">
  <h3>{{ Auth::user()->name }} / {{ __('messages.my_gallery') }}</h3>
</div>

<div class="mygallery-lists">
  @if (!empty($gallerys))
    @foreach ($gallerys as $gallery)
      @php
        $srcPath = public_path().'/images/'.$gallery->image;
        $filename = pathinfo($srcPath, PATHINFO_FILENAME);
        $ext = pathinfo($srcPath, PATHINFO_EXTENSION);
        $targetWidth = 400;
        $filenameResized = $filename . '_resized_'.$targetWidth.'x.'.$ext;
      @endphp
      <div class="mygallery-list flex">
        <div class="mygallery-list__image">
          <a href="javascript:void(0)" class="image-gallery" data-id="{{ $gallery->id }}">
            <img src="/images/{{ $filenameResized }}" />
          </a>
        </div>

        <div class="mygallery-list__info">
          <label class="gallery-number">No. {{ sprintf("%07d", $gallery->id) }}</label>
          <h3>
            @if (session()->get('locale') == 'en')
              {{ $gallery->title }}
              <span>(
                @foreach ($categories as $category)
                  @if ($gallery->category_id == $category->id)
                    {{ $category->cat_name }}
                  @endif
                @endforeach
                )</span>
            @elseif (session()->get('locale') == 'ch')
              {{ $gallery->title_ch }}
              <span>(
                @foreach ($categories as $category)
                  @if ($gallery->category_id == $category->id)
                    {{ $category->cat_name_ch }}
                  @endif
                @endforeach
                )</span>
            @elseif (session()->get('locale') == 'ko')
              {{ $gallery->title_ko }}
              <span>(
                @foreach ($categories as $category)
                  @if ($gallery->category_id == $category->id)
                    {{ $category->cat_name_ko }}
                  @endif
                @endforeach
                )</span>
            @else
              {{ $gallery->title }}
              <span>(
                @foreach ($categories as $category)
                  @if ($gallery->category_id == $category->id)
                    {{ $category->cat_name }}
                  @endif
                @endforeach
                )</span>
            @endif
          </h3>

          <div class="mygallery-total-price">
            <label>가격:</label>
            <span>{{ $gallery->retail_price }} (USD)</span>
          </div>
         
          <div class="mygallery-status">
            <label>작가:</label>
            <span>
              @foreach ($artists as $artist)
                @if ($gallery->artist_id == $artist->id)
                  @if (session()->get('locale') == 'en')
                    {{ $artist->art_name }}
                  @elseif (session()->get('locale') == 'ch')
                  {{ $artist->art_name_ch }}
                  @elseif (session()->get('locale') == 'ko')
                  {{ $artist->art_name_ko }}
                  @else
                    {{ $gallery->title }}
                  @endif
                @endif
              @endforeach
            </span>
          </div>

          <div class="mygallery-status">
            <label>상태:</label>
            <span>
              @foreach ($orders as $order)
                @if ($gallery->id == $order->gallery_id)
                  @if ($order->status == 'processing')
                    구매요청중
                  @elseif ($order->status == 'waiting')
                    지불대기중
                  @elseif ($order->status == 'sending')
                    배송중
                  @elseif ($order->status == 'completed')
                    완료
                  @endif      
                @endif
              @endforeach
            </span>
          </div>
        </div>
      </div>
    @endforeach

    <div class="popup-gallery-data position-fixed" data-user-id="{{ Auth::id() }}">
      <div class="popup-gallery-data__inner flex jcb"></div>
    </div>
  @endif
</div>

@endsection