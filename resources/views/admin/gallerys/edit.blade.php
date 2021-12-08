@extends('admin.layout')
@section('content')

<div class="edit-gallery">
    <h2>Edit Item</h2>
    <h4>Edit required</h4>
    <p>This item is ready to be completed. It will appear on Artpie when this form is complete.</p>

    <div class="edit-image-form">
      <form  action="{{ route('admin-gallery.update',$gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-12">
            <div class="input-group mb-3 td-img">
              <img src="/images/{{ $gallery->image }}">
            </div>

            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" name="image" multiple class="custom-file-input form-control" id="customFile">
                <label class="custom-file-label" for="customFile">Select Images</label>
              </div>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Title</span>
              </div>
              <input type="text" value="{{ $gallery->title }}" name="title" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Size</span>
              </div>
              <input type="text" value="{{ $gallery->size }}" name="size" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Price</span>
              </div>
              <input type="text" value="{{ $gallery->price }}" name="price" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Category</span>
              </div>
              <input type="text" value="{{ $gallery->category }}" name="category" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Artist Id</span>
              </div>
              <input type="text" value="{{ $gallery->artist_id }}" name="artist_id" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Pieces Number</span>
              </div>
              <input type="text" value="{{ $gallery->pieces_number }}" name="pieces_number" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Paint Date</span>
              </div>
              <input type="text" value="{{ $gallery->paint_date }}" name="paint_date" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Registered Date</span>
              </div>
              <input type="text" value="{{ $gallery->registered_date }}" name="registered_date" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Updated Date</span>
              </div>
              <input type="text" value="{{ $gallery->updated_date }}" name="updated_date" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Frame</span>
              </div>
              <input type="text" value="{{ $gallery->frame }}" name="frame" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">description</span>
              </div>
              <textarea name="description" class="form-control" required>{{ $gallery->description }}</textarea>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Keywords</span>
              </div>
              <input type="text" value="{{ $gallery->keywords }}" name="keywords" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Original</span>
              </div>
              <input type="text" value="{{ $gallery->original }}" name="original" class="form-control" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Signed</span>
              </div>
              <input type="text" value="{{ $gallery->signed }}" name="signed" class="form-control" required>
            </div>

          </div>
          <div class="col-md-8">
              <button type="submit" class="btn btn-grey">Submit</button>
          </div>
        </div>


      </form>
    </div>
  </div>

@endsection