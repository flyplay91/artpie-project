@extends('admin.layout')
@section('content')

<div class="ad-gallerys">
  <div class="ad-gallery__collection">
    <div class="gallery-coll-form flex aic">
      <div>
        <label>Collection</label>
        <input type="submit" value="Add Collection">
      </div>
      <div class="flex aic">
        <span>리똘똘이 판 그림</span>
        <div class="coll-btns">
          <input type="submit" value="Edit">
          <input type="submit" value="Delete">
        </div>
      </div>
    </div>
  </div>
    <div class="ad-gallerys__lists flex">
      <div class="ad-gallerys-sidebar">
        <div class="boxCtnt">
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="" tabindex="-1" checked="checked">리똘똘이 판 그림
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="1" tabindex="-1">단동에 있는 그림
            <div class="chkBox2_box"></div>
          </label>
          <label class="chkBox2">
            <input type="checkbox" name="f_p" value="2" tabindex="-1">단동에 있는 그림
            <div class="chkBox2_box"></div>
          </label>
        </div>
      </div>
    
      <div class="ad-gallerys-items" id="adGallerysItems">
        <div class="hdrItems-list">
          <div class="hdrItems-list__inner flex aic jcc" style="height: 200px">
          <a class="btn-gallery-create" href="{{ route('admin-gallery.create') }}">Add More Items</a>
          </div>
        </div>
        @foreach ($gallerys as $gallery)
        <div class="hdrItems-list">
          <div class="hdrItems-list__inner">
            <img src="/images/{{ $gallery->image }}">
          </div>
        </div>
        @endforeach
    </div>
  </div>
</div>

@endsection