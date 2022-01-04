@extends('front.layouts.app')

@section('content')
@if (isset($headerdata))
<div class="hdrBg" style="background-image: url('/images/<?php echo $headerdata->image ?>')">
  <div class="hdrBgTint"></div>
  <div class="bHdr">
    <div class="bHdrTxt">
      <h1>{{ $headerdata->title }}</h1>
      <span>{{ $headerdata->sub_title }}</span>
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

<div class="hdrItems flex jcb">
  <div class="hdrItems-sidebar W-20">
    <div class="hdrItems-sidebar__inner">
      <div class="filterItems hdrItem--category boxCtnt">
        @if (isset($categories))
          <span class="fTtl">{{ __('messages.category') }}</span>
          <label class="chkBox2">
            <input type="checkbox" class="checkbox-filter checkbox-any-filter" value="any" checked="checked"> Any
            <div class="chkBox2_box"></div>
          </label>
          @foreach ($categories as $category)
            <label class="chkBox2">
              <input type="checkbox" class="checkbox-filter checkbox-some-filter" value="{{ $category->id }}">
              @if (session()->get('locale') == 'en')
                {{ $category->cat_name }}
              @elseif (session()->get('locale') == 'ch')
                {{ $category->cat_name_ch }}
              @elseif (session()->get('locale') == 'ko')
                {{ $category->cat_name_ko }}
              @else 
                {{ $category->cat_name }}
              @endif
              <div class="chkBox2_box"></div>
            </label>
          @endforeach
        @endif
      </div>

      <div class="hdrItem--price-size">
        <div class="filterItems hdrItem--price boxCtnt">
          <span class="fTtl">{{ __('messages.price') }}</span>
          <label class="chkBox2">
            <input type="checkbox" class="checkbox-filter checkbox-any-filter" value="any" checked="checked"> Any
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" class="checkbox-filter checkbox-some-filter" value="1000_5000">1000 ~ 5000
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" class="checkbox-filter checkbox-some-filter" value="5001_10000">5001 ~ 10000
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" class="checkbox-filter checkbox-some-filter" value="10001_50000">10001 ~ 50000
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" class="checkbox-filter checkbox-some-filter" value="50001_max">50001 ~
            <div class="chkBox2_box"></div>
          </label>
        </div>
      </div>

    </div>
  </div>

  @auth
    <input type="hidden" class="logged-user" value="1">
  @else
    <input type="hidden" class="logged-user" value="0">
  @endauth

  <div id="hdrItems" class="w-75">
    
    @if (isset($gallerys))
      @foreach ($gallerys as $gallery)
        @if ($gallery->all_checked == 'true')
          <div class="hdrItems-list">
            <div class="hdrItems-list__inner position-relative">
              <div class="hdrItems-list__tooltip position-absolute">
                <label>
                  @if (session()->get('locale') == 'en')
                    {{ $gallery->title }}
                  @elseif (session()->get('locale') == 'ch')
                    {{ $gallery->title_ch }}
                  @elseif (session()->get('locale') == 'ko')
                    {{ $gallery->title_ko }}
                  @else 
                    {{ $gallery->title }}
                  @endif
                </label>
                @if (isset($artists))
                  @foreach ($artists as $artist)
                    @if ($artist->id == $gallery->artist_id)
                      <span>
                        @if (session()->get('locale') == 'en')
                          {{ $artist->art_name }}
                        @elseif (session()->get('locale') == 'ch')
                          {{ $artist->art_name_ch }}
                        @elseif (session()->get('locale') == 'ko')
                          {{ $artist->art_name_ko }}
                        @else 
                          {{ $artist->art_name }}
                        @endif
                      </span>
                    @endif
                  @endforeach
                @endif
              </div>
              <a class="image-gallery" href="javascript:void(0)" data-id="{{ $gallery->id }}" data-artist-id="{{ $gallery->artist_id }}">
                <div class="hdrItems-list__inner-overlay"></div>
                <img src="/images/{{ $gallery->image }}">
              </a>
            </div>
          </div>
        @endif
      @endforeach
    @endif
  </div>

  <div class="popup-gallery-data position-fixed" data-user-id="{{ Auth::id() }}">
    <div class="popup-gallery-data__inner flex jcb"></div>
  </div>
</div>

@endsection