@extends('admin.layout')
@section('content')

<!-- @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif -->

<div class="edit-gallery">
    <h2 class="p-title">Edit Item</h2>
    <div class="p-img-subtitle-des flex ais">
      <img src="/images/warnning-icon.png">
      <div class="p-subtitle-des">
        <h4>Edit required</h4>
        <p class="p-short-desc">This item is ready to be completed. It will appear on Artpie when this form is complete.</p>
      </div>
    </div>
    

    <div class="edit-image-form">
      <form class="form-save-gallery" action="{{ route('admin-gallery.update',$gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-12">
            <div class="block-change-image-des">
              <div class="input-group mb-3 td-img m-auto">
                <img src="/images/{{ $gallery->image }}">
              </div>

              <div class="input-group btns-change-add-images mb-3 flex aic jcb">
                <p>Incorrect image? Use the "Change Image" button to the right, or the "Delete Item" button at the bottom of the form.</p>
                <a href="javascript:void(0)" class="btn-change-image">Change Image</a>
                <a href="javascript:void(0)" class="btn-additional-images">Upload Additional Image</a>
              </div> 

              <div class="block-change-image">
                <input type="file" name="image" multiple class="custom-file-input form-control" id="customFile">
                <label class="custom-file-label" for="customFile">Select Images</label>
              </div>
            </div>

            <div class="block-change-gallery-data">
              <div class="change-gallery-data__inner m-auto">
                <div class="form-group mb-3">
                  <label>Artwork Title</label>
                  <input type="text" value="{{ $gallery->title }}" name="title" class="form-control" required>
                </div>

                <div class="flex aic jcb mb-3">
                  <div class="form-group w-30">
                    <label>Signed?</label>
                    <select class="browser-default custom-select" name="sign" required>
                      <option selected value="{{ $gallery->sign }}">{{ $gallery->sign }}</option>
                      <option value="signed">Signed</option>
                      <option value="unsigned">Unsigned</option>
                    </select>
                  </div>
                  <div class="form-group w-30">
                    <label>Framing</label>
                    <select class="browser-default custom-select" name="frame" required>
                      <option selected value="{{ $gallery->frame }}">{{ $gallery->frame }}</option>
                      <option value="framed">Framed</option>
                      <option value="unframed">Unframed</option>
                    </select>
                  </div>
                  <div class="form-group w-10">
                    <label>Width</label>
                    <input type="text" value="{{ $gallery->width }}" name="width" class="form-control" required>
                  </div>
                  <div class="form-group w-5">
                    <label></label>
                    X
                  </div>
                  <div class="form-group w-10">
                    <label>Height</label>
                    <input type="text" value="{{ $gallery->height }}" name="height" class="form-control" required>
                  </div>
                  <div class="form-group w-10">
                    <label for="usr">Unit</label>
                    <select class="browser-default custom-select" name="unit" required>
                      <option selected value="{{ $gallery->unit }}">{{ $gallery->unit }}</option>
                      <option value="cm">Cm</option>
                      <option value="m">Inch</option>
                    </select>
                  </div>
                </div>

                <div class="flex aic jcb mb-3">
                  <div class="form-group w-30">
                    <label>Actual Price</label>
                    <input type="text" value="{{ $gallery->actual_price }}" name="actual_price" class="form-control" required>
                  </div>
                  <div class="form-group w-30">
                    <label>Retail Price</label>
                    <input type="text" value="{{ $gallery->retail_price }}" name="retail_price" class="form-control">
                  </div>

                  <div class="boxCtnt">
                    <label class="chkBox2">
                      <input type="checkbox" class="checkbox-enable-pieces" name="check_enable_pieces" value="yes" checked="checked">Enable pieces
                      <div class="chkBox2_box"></div>
                    </label>
                  </div>
                  <div class="form-group w-20 piece-count active">
                    <label>Piece Count</label>
                    <input type="text" value="{{ $gallery->piece_coount }}" name="piece_count" class="form-control">
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label>Materials</label>
                  <input type="text" value="{{ $gallery->materials }}" name="materials" class="form-control">
                </div>

                <div class="form-group mb-3">
                  <label>Description</label>
                  <textarea name="description" rows="7" class="form-control" required>{{ $gallery->description }}</textarea>
                </div>

                <div class="form-group mb-3">
                  <label>Keywords</label>
                  <textarea name="keywords" rows="5" class="form-control" required>{{ $gallery->keywords }}</textarea>
                </div>

                <div class="form-group mb-3">
                  <label>Is this image safe for children and work?</label>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="safe_children" value="yes" @if ($gallery->safe_children == 'yes') checked="checked" @endif>Yes, this image is safe for children and work.
                  </label>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="safe_children" value="no"  @if ($gallery->safe_children == 'no') checked="checked" @endif>No, this image is not safe for children and work.
                  </label>
                </div>

                <div class="flex jcb aie mb-5">
                  <div class="form-group w-45">
                    <label>Category</label>
                    <select class="browser-default custom-select selectbox-categories" name="category_id" required>
                      @if (isset($categories))
                        @foreach ($categories as $category)
                        <option selected value="{{ $category->id }}">{{ $category->cat_name }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group w-45 position-relative">
                    <a href="javascript:void(0)" class="btn-add-category">Add New...</a>
                    <div class="flex aic insert-category position-absolute">
                      <input type="text" value="" name="category_name" class="form-control insert-cat-name">
                      <a href="javascript:void(0)" class="btn-insert-category">Add</a>
                    </div>
                  </div>
                </div>

                <div class="flex jcb aie mb-5">
                  <div class="form-group w-45">
                    <label>Artist</label>
                    <select class="browser-default custom-select selectbox-artists" name="artist_id" required>
                      @if (isset($artists))
                        @foreach ($artists as $artist)
                        <option selected value="{{ $artist->id }}">{{ $artist->art_name }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group w-45 position-relative">
                    <a href="javascript:void(0)" class="btn-add-artist">Add New...</a>
                    <div class="flex aic insert-artist position-absolute">
                      <input type="text" value="" name="art_name" class="form-control insert-artist-name">
                      <a href="javascript:void(0)" class="btn-insert-artist">Add</a>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputDate">Paint Date</label>
                  <input type="input" class="form-control date-picker" value="{{ $gallery->paint_date }}" name="paint_date" required>
                </div>

                <div class="form-group">
                  <label for="inputDate">Registered Date</label>
                  <input type="input" class="form-control date-picker" value="{{ $gallery->registered_date }}" name="registered_date" required>
                </div>

                <div class="form-group">
                  <label for="inputDate">Updated Date</label>
                  <input type="input" class="form-control date-picker" value="{{ $gallery->updated_date }}" name="updated_date" required>
                </div>


                <div class="form-group mb-3">
                  <label for="usr">Original</label>
                  <select class="browser-default custom-select" name="original">
                    <option selected value="{{ $gallery->original }}">{{ $gallery->original }}</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>
                </div>

              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-grey btn-save-gallery">Save Changes</button>
          
        </div>
      </form>

      <form class="form-delete-gallery" action="{{ route('admin-gallery.destroy',$gallery->id) }}" method="POST" enctype="multipart/form-data">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-grey btn-edit-del-coll">Delete</button>
      </form>

      <div class="btn-gallery-update-delete flex aic jca">
        <button type="submit" class="btn btn-grey btn-save-gallery-trigger">Save Changes</button>
        <button type="submit" class="btn btn-grey btn-delete-gallery-trigger">Delete item</button>
      </div>
    </div>
  </div>

@endsection