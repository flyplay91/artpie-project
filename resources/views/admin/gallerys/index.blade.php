@extends('admin.layout')
@section('content')

<div class="ad-gallerys ">
  <div class="ad-gallerys__lists flex">
    <div class="ad-gallerys-sidebar">

      <div class="block-add-coll">
        <button type="button" class="btn btn-grey btn-add-coll">Add Collection</button>
        
        <form class="flex aic" action="{{ route('admin-collection.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="text" value="" name="coll_name" class="form-control" required>
          <button type="submit" class="btn btn-grey">Add</button>
        </form>
      </div>

      <div class="boxCtnt">
        @if (isset($collections))
          <label class="chkBox2">
            <input type="checkbox" class="checkbox-all-colls" name="" value="check_all_colls" data-id="" checked="checked">모든 선택
            <div class="chkBox2_box"></div>
          </label>
          @foreach ($collections as $collection)
            <label class="chkBox2">
              <!-- <input type="checkbox" class="" name="f_p" value="" tabindex="-1"  @if (session('success') && (session('success') == $collection->coll_name))  checked="checked" @endif >{{ $collection->coll_name }} -->
              <input type="checkbox" class="checkbox-coll" name="f_p" value="{{ $collection->coll_name }}" data-id="{{ $collection->id }}" tabindex="-1" checked="checked">{{ $collection->coll_name }}
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
          <button type="button" class="btn btn-grey btn-edit-del-coll">Edit</button>
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
            <button type="submit" class="btn btn-grey btn-edit-del-coll">Delete</button>
          </form>
        </div>
      </div>

      <div id="adGallerysItems">
        <div class="hdrItems-list hdrItems-list--addmore">
          <div class="hdrItems-list__inner flex aic jcc" style="height: 200px">
            <a class="btn-gallery-create" href="">Add More Items</a>
          </div>
        </div>

        @if (isset($gallerys))
          @foreach ($gallerys as $gallery)
            <div class="hdrItems-list">
              <div class="hdrItems-list__inner">
                <a href="{{ route('admin-gallery.edit',$gallery->id) }}">
                  <div class="hdrItems-list__inner-overlay"><label>Edit required</label></div>
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