@extends('front.layouts.app')

@section('content')
<div class="hdrBg" style="background-image: url(/images/hero-bg.jpg)">
  <div class="hdrBgTint"></div>
  <div class="bHdr">
    <div class="bHdrTxt">
      <h1>이름있는 화가들의 그림, 더는 부자들만의것이 아닙니다.</h1>
      <span>그림도 소장하고 돈도 버십시오.</span>
    </div>

    <div class="sBoxW">
      <div class="sBox">
        <input type="text" name="s" placeholder="그림제목/화가이름" class="s">
        <img src="/images/search-icon.png">
      </div>
    </div>
  </div>
</div>

<div class="hdrItems" id="hdrItems">
  <div class="hdrItems-sidebar">
    <div class="hdrItems-sidebar__inner">
      <div class="hdrItem hdrItem--category">
        <ul class="boxCtnt">
          <li><a href="#">수채화</a></li>
          <li><a href="#">유화</a></li>
          <li><a href="#">펜화 & 연필화</a></li>
          <li><a href="#">기타</a></li>
        </ul>
      </div>

      <div class="hdrItem hdrItem--price-size">
        <div class="hdrItem--price boxCtnt">
          <span class="fTtl">가격</span>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="" tabindex="-1" checked="checked"> Any
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="1" tabindex="-1"> $0 to $25
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="2" tabindex="-1"> $25 to $50
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="3" tabindex="-1"> $50 to $100
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="4" tabindex="-1"> $100 to $200
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="5" tabindex="-1"> $200 to $500
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="6" tabindex="-1"> $500+
            <div class="chkBox2_box"></div>
          </label>
        </div>
        <div class="hdrItem--size boxCtnt">
          <span class="fTtl">크기</span>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="" tabindex="-1" checked="checked"> Any
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="1" tabindex="-1"> $0 to $25
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="2" tabindex="-1"> $25 to $50
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="3" tabindex="-1"> $50 to $100
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="4" tabindex="-1"> $100 to $200
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="5" tabindex="-1"> $200 to $500
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="6" tabindex="-1"> $500+
            <div class="chkBox2_box"></div>
          </label>
        </div>
      </div>

      <div class="boxBut flex aic jcc">
        <input id="SubmitFilter" type="submit" value="Apply" class="button padmore">
        <a href="#" class="button2sm">Reset</a>
      </div>
    </div>
  </div>

  @if (isset($gallerys))
    @foreach ($gallerys as $gallery)
      <div class="hdrItems-list">
        <div class="hdrItems-list__inner">
          <img src="/images/{{ $gallery->image }}">
        </div>
      </div>
    @endforeach
  @endif
</div>
@endsection