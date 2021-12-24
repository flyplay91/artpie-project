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
    <h2 class="p-title">그림 편집</h2>
    @if ($gallery->all_checked == 'false')
    <div class="p-img-subtitle-des flex ais">
      <img src="/images/warnning-icon.png">
      <div class="p-subtitle-des">
        <!-- <h4>Edit required</h4> -->
        <p class="p-short-desc">아래의 항목들을 채워야 사용자가 이 그림을 볼수 있습니다.</p>
      </div>
    </div>
    @endif
    

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

              <div class="input-group btns-change-add-images mt-3 mb-3 flex aic jcb">
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
                  <label>No. {{ sprintf("%07d", $gallery->id) }}</label>
                </div>

                <div class="form-group mb-3">
                  <label>그림 제목</label>
                  <input type="text" value="{{ $gallery->title }}" name="title" class="form-control">
                </div>

                <div class="flex aic jcb mb-3">
                  <div class="form-group w-30">
                    <label>서명?</label>
                    <select class="browser-default custom-select" name="sign">
                      <option selected value="{{ $gallery->sign }}">{{ $gallery->sign }}</option>
                      <option value="signed">예</option>
                      <option value="unsigned">아니</option>
                    </select>
                  </div>
                  <div class="form-group w-30">
                    <label>액틀?</label>
                    <select class="browser-default custom-select" name="frame">
                      <option selected value="{{ $gallery->frame }}">{{ $gallery->frame }}</option>
                      <option value="framed">예</option>
                      <option value="unframed">아니</option>
                    </select>
                  </div>
                  <div class="form-group w-10">
                    <label>길이</label>
                    <input type="text" value="{{ $gallery->width }}" name="width" class="form-control">
                  </div>
                  <div class="form-group w-5">
                    <label>X</label>
                  </div>
                  <div class="form-group w-10">
                    <label>너비</label>
                    <input type="text" value="{{ $gallery->height }}" name="height" class="form-control">
                  </div>
                  
                  <div class="form-group w-10">
                    <label for="usr">단위</label>
                    <select class="browser-default custom-select" name="unit">
                      <option selected value="{{ $gallery->unit ? $gallery->unit : 'cm' }}">{{ $gallery->unit ? $gallery->unit : 'Cm' }}</option>
                      
                    </select>
                  </div>
                </div>

                <div class="flex aic jcb mb-3">
                  <div class="form-group w-30">
                    <label>실지 가격</label>
                    <input type="text" value="{{ $gallery->actual_price }}" name="actual_price" class="form-control">
                  </div>
                  <div class="form-group w-30">
                    <label>초기 가격</label>
                    <input type="text" value="{{ $gallery->retail_price }}" name="retail_price" class="form-control">
                  </div>

                  <div class="boxCtnt">
                    <label class="chkBox2">
                      <input type="checkbox" class="checkbox-enable-pieces" name="check_enable_pieces" value="{{ $gallery->check_enable_pieces ? $gallery->check_enable_pieces : 'no' }}" @if ($gallery->check_enable_pieces == 'yes') checked="checked" @endif>쪼각 설정
                      <div class="chkBox2_box"></div>
                    </label>
                  </div>
                  
                  <div class="form-group w-20 piece-count @if ($gallery->check_enable_pieces == 'yes') active @endif">
                    <label>쪼각 개수</label>
                    <input type="text" value="{{ $gallery->piece_count }}" name="piece_count" class="form-control">
                  </div>
                  
                </div>

                <div class="form-group mb-3">
                  <label>재료</label>
                  <input type="text" value="{{ $gallery->materials }}" name="materials" class="form-control">
                </div>

                <div class="form-group mb-3">
                  <label>설명</label>
                  <textarea name="description" rows="7" class="form-control">{{ $gallery->description }}</textarea>
                </div>

                <div class="form-group mb-3">
                  <label>검색어</label>
                  <textarea name="keywords" rows="5" class="form-control">{{ $gallery->keywords }}</textarea>
                </div>

                <div class="form-group mb-3">
                  <label>이 그림은 어린이들이 봐도 됩니까?</label>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="safe_children" value="yes" @if ($gallery->safe_children == 'yes') checked="checked" @endif>예, 봐도 됩니다.
                  </label>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="safe_children" value="no"  @if ($gallery->safe_children == 'no') checked="checked" @endif>아니, 보여주면 안됩니다
                  </label>
                </div>

                <div class="flex jcb aie mb-5">
                  <div class="form-group w-45">
                    <label>분류</label>
                    <select class="browser-default custom-select selectbox-categories" name="category_id">
                      <option value="0">분류 선택</option>
                      @if (isset($categories))
                        @foreach ($categories as $category)
                        <option @if ($gallery->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->cat_name }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group w-45 position-relative">
                    <a href="javascript:void(0)" class="btn-add-category">새 분류 추가...</a>
                    <div class="flex aic insert-category position-absolute">
                      <input type="text" value="" name="category_name" class="form-control insert-cat-name">
                      <a href="javascript:void(0)" class="btn-insert-category">추가</a>
                    </div>
                  </div>
                </div>

                <div class="flex jcb aie mb-5">
                  <div class="form-group w-45">
                    <label>창작가</label>
                    <select class="browser-default custom-select selectbox-artists" name="artist_id">
                      <option value="0">창작가 선택</option>
                      @if (isset($artists))
                        @foreach ($artists as $artist)
                        <option @if ($gallery->artist_id == $artist->id) selected @endif value="{{ $artist->id }}">{{ $artist->art_name }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group w-45 position-relative">
                    <a href="javascript:void(0)" class="btn-add-artist">새 창작가 추가...</a>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputDate">출판 날자</label>
                  <input type="text" class="form-control" value="{{ $gallery->paint_date }}" name="paint_date">
                </div>

                <div class="form-group">
                  <label for="inputDate">등록 날자</label>
                  <input type="input" class="form-control date-picker" value="{{ $gallery->registered_date ? $gallery->registered_date : (Carbon\Carbon::now()->format('m/d/Y')) }}" name="registered_date">
                </div>

                <div class="form-group">
                  <label for="inputDate">갱신 날자</label>
                  <input type="input" class="form-control date-picker" value="{{ $gallery->updated_date ? $gallery->updated_date : (Carbon\Carbon::now()->format('m/d/Y')) }}" name="updated_date">
                </div>


                <div class="form-group mb-3">
                  <label for="usr">원본</label>
                  <select class="browser-default custom-select" name="original">
                    <option selected value="{{ $gallery->original ? $gallery->original : 'yes' }}">{{ $gallery->original ? $gallery->original : 'Yes' }}</option>
                    <option value="yes">예</option>
                    <option value="no">아니</option>
                  </select>
                </div>

              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-grey btn-save-gallery">변경</button>
          
        </div>
      </form>

      <form class="form-delete-gallery" action="{{ route('admin-gallery.destroy',$gallery->id) }}" method="POST" enctype="multipart/form-data">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-grey btn-delete-gallery">삭제</button>
      </form>

      <div class="btn-gallery-update-delete flex aic jce">
        <button type="submit" class="btn btn-grey btn-save-gallery-trigger">변경</button>
        <button type="submit" class="btn btn-grey btn-delete-gallery-trigger">삭제</button>
        <a href="/admin-gallery" class="btn-grey">취소</a>
      </div>

    </div>

    <div class="popup-insert-artist flex flex-column insert-artist position-absolute">
        <div class="input-group insert-artist-input">
          <div class="input-group-prepend">
            <span class="input-group-text">창작가 이름</span>
          </div>
          <input type="text" value="" name="art_name" class="form-control insert-artist-name">
        </div>

        <div class="input-group insert-artist-textarea">
          <div class="input-group-prepend">
            <span class="input-group-text">창작가 경력</span>
          </div>
          <textarea name="art_description" value="" class="form-control insert-artist-description"></textarea>
        </div>
        <div class="btns-insert-cancel-artist flex aic jce">
          <a href="javascript:void(0)" class="btn-grey btn-insert-artist">추가</a>
          <a href="javascript:void(0)" class="btn-grey btn-cancel-artist">취소</a>
        </div>
        
    </div>
  </div>

@endsection