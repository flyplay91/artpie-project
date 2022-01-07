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
          <img src="/images/{{ $filenameResized }}">
        </div>

        <div class="mygallery-list__info">
          <h3>
            @if (session()->get('locale') == 'en')
              {{ $gallery->title }}
            @elseif (session()->get('locale') == 'ch')
              {{ $gallery->title_ch }}
            @elseif (session()->get('locale') == 'ko')
              {{ $gallery->title_ko }}
            @else
              {{ $gallery->title }}
            @endif
          </h3>
          <div class="mygallery-status">
            <label>상태:</label>
            <span>
              
            </span>
          </div>
          <div class="mygallery-total-price">
            <label>가격:</label>
            <span>20000 (USD)</span>
          </div>
          <div class="mygallery-pieces">
            <label>소유개수:</label>
            <span>1000개 (20000개중)</span>
          </div>
          <div class="mygallery-price">
            <label>구입한 금액:</label>
            <span>1000 (USD)</span>
          </div>
          <div class="mygallery-current-value">
            <label>현재 가치:</label>
            <span>1500 (USD) (수익률 150%)</span>
          </div>
          <div class="mygallery-current-value">
            <label>희망판매가격:</label>
            <span>2000 (USD)</span>
          </div>
        </div>
      </div>
    @endforeach
  @endif
</div>

@endsection