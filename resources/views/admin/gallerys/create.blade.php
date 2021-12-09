@extends('admin.layout')
@section('content')
  <div class="create-gallery">
    <div class="create-gallery__image-desc">
      그림을 올릴때 다음의 사항에 주의해주십시오.
    </div>
    <form  action="{{ route('admin-gallery.store') }}" method="POST" enctype="multipart/form-data">
      <?php 
        $current_url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        if (isset($_SERVER['QUERY_STRING'])) {
          $param = explode ("?", $current_url)[1]; ?>
          <input type="hidden" value="<?php echo $param ?>" name="coll_id">
        <?php
        }
        
      ?>
      
      
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
            <button type="submit" class="btn btn-grey">Submit</button>
        </div>
      </div>
    </form>
  </div>
@endsection