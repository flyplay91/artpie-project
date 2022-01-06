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
    
    @php
      $srcPath = public_path().'/images/'.$gallery->image;

      $filename = pathinfo($srcPath, PATHINFO_FILENAME);
      $ext = pathinfo($srcPath, PATHINFO_EXTENSION);
      $targetWidth = 800;
      $filenameResized = $filename . '_resized_'.$targetWidth.'x.'.$ext;
      
    @endphp

    <div class="edit-image-form">
      <form class="form-save-gallery" action="{{ route('admin-gallery.update',$gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-12">
            <div class="block-change-image-des">
              <div class="input-group mb-3 td-img m-auto">
                <img src="/images/{{ $filenameResized }}">
              </div>

              {{--
              <div class="input-group btns-change-add-images flex aic jcb">
                <a href="javascript:void(0)" class="btn-change-image">Change Image</a>
                <a href="javascript:void(0)" class="btn-additional-images">Upload Additional Image</a>
              </div> 

              <div class="block-change-image">
                <input type="file" name="image" multiple class="custom-file-input form-control" id="customFile">
                <label class="custom-file-label" for="customFile">Select Images</label>
              </div>
              --}}
            </div>

            <div class="block-change-gallery-data">
              <div class="change-gallery-data__inner m-auto">
                <div class="form-group mb-3">
                  <label>No. {{ sprintf("%07d", $gallery->id) }}</label>
                </div>

                <div class="form-group mb-3">
                  <label>그림 제목</label>
                  <input type="text" value="{{ $gallery->title_ko }}" placeholder="제목(조선어)" name="title_ko" class="form-control mb-2">
                  <input type="text" value="{{ $gallery->title_ch }}" placeholder="제목(중어)" name="title_ch" class="form-control mb-2">
                  <input type="text" value="{{ $gallery->title }}" placeholder="제목(영어)" name="title" class="form-control">
                </div>

                <div class="flex aic jcb mb-3">
                  <div class="form-group w-30">
                    <label>서명?</label>
                    <select class="browser-default custom-select" name="sign">
                      <option value="signed" @if ($gallery->sign == 'signed') selected @endif>예</option>
                      <option value="unsigned" @if ($gallery->sign == 'unsigned') selected @endif>아니</option>
                    </select>
                  </div>
                  <div class="form-group w-30">
                    <label>액틀?</label>
                    <select class="browser-default custom-select" name="frame">
                      <option value="framed" @if ($gallery->frame == 'framed') selected @endif>예</option>
                      <option value="unframed" @if ($gallery->frame == 'unframed') selected @endif>아니</option>
                    </select>
                  </div>
                  <div class="form-group w-10">
                    <label>너비</label>
                    <input type="text" value="{{ $gallery->width }}" name="width" class="form-control">
                  </div>
                  <div class="form-group w-5">
                    <label>X</label>
                  </div>
                  <div class="form-group w-10">
                    <label>높이</label>
                    <input type="text" value="{{ $gallery->height }}" name="height" class="form-control">
                  </div>
                  
                  <div class="form-group w-10">
                    <label for="usr">단위</label>
                    <select class="browser-default custom-select" name="unit">
                      <option selected value="{{ $gallery->unit ? $gallery->unit : 'cm' }}">{{ $gallery->unit ? $gallery->unit : 'cm' }}</option>
                      
                    </select>
                  </div>
                </div>

                <div class="flex aic jcb mb-3">
                  <div class="form-group w-30">
                    <label>구입가격(USD)</label>
                    <input type="text" value="{{ $gallery->actual_price }}" name="actual_price" class="form-control">
                  </div>
                  <div class="form-group w-30">
                    <label>판매가격(USD)</label>
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
                  <textarea name="description_ko" rows="7" placeholder="설명(조선어)" class="form-control mb-2">{{ $gallery->description_ko }}</textarea>
                  <textarea name="description_ch" rows="7" placeholder="설명(중어)" class="form-control mb-2">{{ $gallery->description_ch }}</textarea>
                  <textarea name="description" rows="7" placeholder="설명(영어)" class="form-control">{{ $gallery->description }}</textarea>
                </div>

                <div class="form-group mb-3">
                  <label>검색어</label>
                  <textarea name="keywords" rows="5" class="form-control">{{ $gallery->keywords }}</textarea>
                </div>

                <div class="form-group mb-3">
                  <label class="safe-children-label">이 그림은 어린이들이 봐도 됩니까?</label>
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
                        <option @if ($gallery->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->cat_name_ko }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group w-45">
                    <a href="javascript:void(0)" class="btn-add-category">분류 추가</a>
                    <a href="javascript:void(0)" class="btn-edit-category">분류 수정</a>
                    <a href="javascript:void(0)" class="btn-delete-category">분류 삭제</a>
                    <div class="flex aic flex-column insert-category position-absolute">
                      <input type="text" value="" placeholder="분류(영어)" class="form-control insert-cat-name-en mb-2">
                      <input type="text" value="" placeholder="분류(중어)" class="form-control insert-cat-name-ch mb-2">
                      <input type="text" value="" placeholder="분류(조선어)" class="form-control insert-cat-name-ko mb-2">
                      <div class="btn-category-insert-cancel flex aie jce">
                        <a href="javascript:void(0)" class="btn-insert-category mr-2">추가</a>
                        <a href="javascript:void(0)" class="btn-cancel-category">취소</a>
                      </div>
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
                        <option @if ($gallery->artist_id == $artist->id) selected @endif value="{{ $artist->id }}" data-name-en="{{ $artist->art_name }}" data-name-ko="{{ $artist->art_name_ko }}" data-name-ch="{{ $artist->art_name_ch }}">{{ $artist->art_name_ko }}</option>
                        @endforeach
                      @endif
                    </select>

                    <input type="hidden" name="artist_name" value="{{$artist->artist_name}}" class="input-artist-name">
                    <input type="hidden" name="artist_name_ch" value="{{$artist->artist_name_ch}}" class="input-artist-name-ch">
                    <input type="hidden" name="artist_name_ko" value="{{$artist->artist_name_ko}}" class="input-artist-name-ko">
                        
                  </div>
                  <div class="form-group w-45 position-relative">
                    <a href="javascript:void(0)" class="btn-add-artist">창작가 추가</a>
                    <a href="javascript:void(0)" class="btn-edit-artist">창작가 수정</a>
                    <a href="javascript:void(0)" class="btn-delete-artist">창작가 삭제</a>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputDate">창작 날자</label>
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
      <div class="mb-3">
        <input type="text" value="" placeholder="창작가 이름(영어)" name="art_name" class="form-control insert-artist-name mb-2">
        <textarea name="art_description" rows="5" value="" placeholder="창작가 경력(영어)" class="form-control insert-artist-description"></textarea>
      </div>
      <div class="mb-3">
        <input type="text" value="" placeholder="창작가 이름(중어)" name="art_name_ch" class="form-control insert-artist-name-ch mb-2">
        <textarea name="art_description_ch" rows="5" value="" placeholder="창작가 경력(중어)" class="form-control insert-artist-description-ch"></textarea>
      </div>
      <div class="mb-3">
        <input type="text" value="" placeholder="창작가 이름(조선어)" name="art_name_ko" class="form-control insert-artist-name-ko mb-2">
        <textarea name="art_description_ko" rows="5" value="" placeholder="창작가 경력(조선어)" class="form-control insert-artist-description-ko"></textarea>
      </div>
      <div class="btns-insert-cancel-artist flex aic jce mt-3">
        <a href="javascript:void(0)" class="btn-grey btn-insert-artist">추가</a>
        <a href="javascript:void(0)" class="btn-grey btn-cancel-artist">취소</a>
      </div>
    </div>

    <div class="popup-update-category-artist position-absolute">
      
    </div>
  </div>

@endsection