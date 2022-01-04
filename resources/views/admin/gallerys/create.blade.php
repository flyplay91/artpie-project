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
  <div class="create-gallery">
    <h2 class="p-title">이미지 추가</h2>
    <div class="create-gallery__image-desc">
      <h2>그림을 올릴때 다음의 사항에 주의해주십시오.</h2>
      <ul>
        <li><b>고품질</b> 이미지는 매우 중요합니다. 업로드한 이미지가 정확히 인쇄됩니다. 이미지에 워터마크 또는 인쇄해서는 안 되는 기타 세부 정보가 표시되어서는 안 됩니다.</li>
        <li>워터마크가 없는 것과 관련하여 이미지는 이미 KArtPie에 의해 보호되므로 워터마크가 필요하지 않습니다.</li>
        <li>이미지는 너비 또는 높이가 1200픽셀 이상, 바람직하게는 너비 또는 높이가 3600픽셀 이상인 고해상도 이미지여야 합니다. 해상도가 높을수록 더 많은 인쇄 크기를 사용할 수 있으므로 가장 큰 이미지를 업로드하세요.</li>
        <li>이미지가 너무 작은 경우 흐리게 인쇄될 수 있으므로 이미지의 크기를 크게 조정하지 마십시오. 컴퓨터에서 이미지를 편집하는 경우 항상 최대 품질(압축 없음)로 이미지를 저장하십시오. 그렇지 않으면 이미지 품질이 저하되어 이미지가 흐릿하게 인쇄되고 픽셀화됩니다.</li>
        <li>단순히 작품 사진을 찍지 마십시오. 전문적인 인쇄물을 만드는 데 적합하지 않습니다. 인쇄물을 만들기 위해 전문적으로 예술을 스캔하거나 사진을 찍습니다. (필요한 경우 해당 지역의 인쇄소에 연락하여 인화 작업을 위해 사진을 촬영하거나 스캔할 수 있는 사람을 문의하십시오.) 배경이나 다른 것이 가장자리 주위에 전혀 표시되지 않도록 이미지가 단단히 잘렸는지 확인하십시오. 특히 테두리, 테두리 등이 표시된 이미지는 제출하지 마십시오.</li>
        <li>업로드하기 전에 이미지를 전체 크기로 보고 흐리거나 픽셀화되지 않았는지 확인하세요. 또한 색상이 생생하고 예술과 밀접하게 일치하는지 확인하십시오. 업로드하는 모든 이미지에 대해 저작권 소유자이거나 적절한 권한이 있어야 합니다. (아트를 만든 경우 기본적으로 귀하가 저작권 소유자입니다.)</li>
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
              <input type="file" name="image" multiple class="custom-file-input form-control" id="uploadImage" required>
              <label class="custom-file-label" for="uploadImage">Select Images</label>
            </div>
          </div>
        </div>
        <div class="col-md-8">
            <button type="submit" class="btn btn-upload-image btn-grey">Submit</button>
        </div>
      </div>
    </form>
  </div>
@endsection