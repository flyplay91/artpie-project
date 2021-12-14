@extends('admin.layout')
@section('content')
  <div class="create-gallery">
    <h2 class="p-title">Upload Images</h2>
    <div class="create-gallery__image-desc">
      <h2>그림을 올릴때 다음의 사항에 주의해주십시오.</h2>
      <ul>
        <li>A <b>high-quality image</b> is extremely important. The image you upload is exactly what will be printed.</li>
        <li>The image <b>must not show a watermark</b> or other details that should not be printed. In regards to no watermarks, your image will already be protected by ArtPie, so no watermarks are necessary.</li>
        <li>Image must be <b>high-resolution</b>, at least 1200 pixels in width or height, preferably higher, such as 3600 pixels in width or height. The higher the resolution, the more print sizes will be available, so upload your largest image. If your images are too small, <b>never resize your images larger</b>, as that will cause them to print blurry.</li>
        <li>If you ever edit your images on your computer, always save your images at maximum quality (no compressioin). Otherwise, the image quality will degrade, causing the image to print blurry and pixelated.</li>
        <li>Don't simply take a photo of your art. That is no suitable for creating professional prints. <b>Get your art professionally scanned or photographed</b> for creating prints. (If needed, contact a print shop in your area to ask who can photograph or scan your art for making prints.)</li>
        <li>Make sure that your image is <b>cropped tightly</b>, so that absolutely no background or anything else is showing around the edges. Especially do not submit images that show frames, borders, etc.</li>
        <li>Before uploading, view your images at full size to ensure that they are <b>not blurry or pixelated</b>. Also ensure that the colors are vibrant and closely match the art.</li>
        <li>You must be the <b>copyright owner</b> or have the proper permissions for any images you upload. (If you created the art then you are the copyright owner by default.)</li>
      </ul>
      
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
              <input type="file" name="image" multiple class="custom-file-input form-control" id="customFile" required>
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