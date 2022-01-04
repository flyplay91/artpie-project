@extends('admin.layout')
@section('main-header')


  <div class="hdrBg position-relative" data-id="<?php if(!empty($headerData)) { echo $headerData->id;} ?>" style="background-image: url('<?php if(!empty($headerData)) { echo '/images/' . $headerData->image; } ?>')">
    <div class="hdrBgTint"></div>
    <div class="bHdr">
      <div class="bHdrTxt">
        @if (!empty($headerData))
        <h1>{{ $headerData->title }}</h1>
        <span>{{ $headerData->sub_title }}</span>
        @endif
      </div>
    </div>
    
    <a href="javascript:void(0)" class="btn-grey btn-add-header position-absolute">추가</a>
    <a href="javascript:void(0)" class="btn-grey btn-edit-header position-absolute">변경</a>
  </div>

@endsection

@section('content')

<div class="ad-gallerys ">
  <div class="ad-gallerys__lists flex">
    <div class="ad-gallerys-sidebar">

      <div class="block-add-coll">
        <button type="button" class="btn btn-grey btn-add-coll">종류추가</button>
        
        <form class="flex aic" action="{{ route('admin-collection.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="text" value="" name="coll_name" class="form-control" required>
          <button type="submit" class="btn btn-grey">추가</button>
        </form>
      </div>

      <div class="boxCtnt">
        @if (isset($collections))
          <label class="chkBox2">
            @if (!session('success'))
            <input type="checkbox" class="checkbox-filter-coll checkbox-all-colls" data-id="any" checked="checked">Any
            @else
              @if ((session('success') == 'any'))
              <input type="checkbox" class="checkbox-filter-coll checkbox-all-colls" data-id="any" checked="checked">Any
              @else
              <input type="checkbox" class="checkbox-filter-coll checkbox-all-colls" data-id="any">Any
              @endif
            @endif

            <div class="chkBox2_box"></div>
          </label>
          @foreach ($collections as $collection)
            <label class="chkBox2">
              <input type="checkbox" class="checkbox-filter-coll checkbox-coll" value="{{ $collection->coll_name }}" data-id="{{ $collection->id }}" tabindex="-1" @if (session('success') && (session('success') == $collection->id))  checked="checked" @endif>{{ $collection->coll_name }}
              <div class="chkBox2_box"></div>
            </label>
          @endforeach
        @endif
      </div>
    </div>
    
    <div class="ad-gallerys-items">
      <div class="coll-btns flex aic">
        <label class="selected-coll-name"></label>
        <div class="block-coll__edit">
          <button type="button" class="btn btn-grey btn-edit-del-coll">변경</button>
          <form class="flex aic" action="" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="text" value="" name="coll_name" class="form-control edit-coll-name" required>
            <button type="submit" class="btn btn-grey">Update</button>
          </form>
        </div>
        <div class="block-coll__delete">
          <form class="flex aic" action="" method="POST" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-grey btn-edit-del-coll">삭제</button>
          </form>
        </div>
      </div>

      <div id="adGallerysItems">
        <div class="hdrItems-list hdrItems-list--addmore">
          <div class="hdrItems-list__inner flex aic jcc" style="height: 200px">
            <a class="btn-gallery-create" href="">그림추가</a>
          </div>
        </div>

        @if (isset($gallerys))
          @foreach ($gallerys as $gallery)
            <div class="hdrItems-list">
              <div class="hdrItems-list__inner @if ($gallery->all_checked == 'false') required @endif">
                <a href="{{ route('admin-gallery.edit',$gallery->id) }}">
                  @if ($gallery->all_checked == 'false')
                    <div class="hdrItems-list__inner-overlay"><label>편집요청</label></div>
                  @endif
                  <img src="/images/{{ $gallery->image }}">
                </a>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</div>

@endsection