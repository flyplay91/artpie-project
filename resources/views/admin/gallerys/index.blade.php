@extends('admin.layout')
@section('content')

<div class="ad-gallerys">
  <div class="ad-gallery__collection">
    <div class="gallery-coll-form flex aic">
      <div class="block-add-coll">
        <button type="button" class="btn btn-primary btn-add-coll">Add Collection</button>
        
        <form class="flex aic" action="{{ route('admin-collection.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="text" value="" name="coll_name" class="form-control" required>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
      
      <div class="coll-btns flex aic">
        <div class="block-coll__edit">
          <button type="button" class="btn btn-danger btn-edit-del-coll">Edit Collection</button>
          <form class="flex aic" action="" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="text" value="" name="coll_name" class="form-control edit-coll-name" required>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
        <div class="block-coll__delete">
          <form class="flex aic" action="" method="POST" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger btn-edit-del-coll">Delete Collection</button>
          </form>
        </div>
      </div>
      
    </div>
  </div>
    <div class="ad-gallerys__lists flex">
      <div class="ad-gallerys-sidebar">
        <label>Collection</label>
        <div class="boxCtnt">
          @if (isset($collections))
            @foreach ($collections as $collection)
              <label class="chkBox2">
                <!-- <input type="checkbox" class="" name="f_p" value="" tabindex="-1"  @if (session('success') && (session('success') == $collection->coll_name))  checked="checked" @endif >{{ $collection->coll_name }} -->
                <input type="checkbox" class="" name="f_p" value="{{ $collection->coll_name }}" data-id="{{ $collection->id }}" tabindex="-1">{{ $collection->coll_name }}
                <div class="chkBox2_box"></div>
              </label>
            @endforeach
          @endif
        </div>
      </div>
    
      <div class="ad-gallerys-items" id="adGallerysItems">
        <div class="hdrItems-list hdrItems-list--addmore">
          <div class="hdrItems-list__inner flex aic jcc" style="height: 200px">
            <a class="btn-gallery-create" href="{{ route('admin-gallery.create') }}">Add More Items</a>
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
  </div>
</div>

@endsection