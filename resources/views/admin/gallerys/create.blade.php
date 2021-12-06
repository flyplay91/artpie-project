@extends('admin.layout')
@section('content')
  <div class="create-gallery">
    <div class="create-gallery__image-desc">
      aaa
    </div>
    <form  action="{{ route('admin-gallery.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-12">
          <div class="input-group mb-3">
            <div class="custom-file">
              <input type="file" name="image" multiple class="custom-file-input form-control" id="customFile">
              <label class="custom-file-label" for="customFile">Select Images</label>
            </div>
          </div>
        </div>
        <div class="col-md-8">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
@endsection