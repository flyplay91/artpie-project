@extends('admin.layout')

@section('content')

<div class="block-admin-orders mt-3">
  <h2>주문 정보</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">그림 제목</th>
        <th scope="col">수하인 이름</th>
        <th scope="col">전자우편</th>
        <th scope="col">전화번호</th>
        <th scope="col">총 가격 (USD)</th>
        <th scope="col">주소</th>
        <th scope="col">날자</th>
        <th scope="col">보기</th>
        <th scope="col">상태</th>
      </tr>
    </thead>
    <tbody>
      @if (!empty($orders))
        @php
          $i = 1;
        @endphp
        @foreach($orders as $order)
        <tr>
          <th scope="row">{{ $i++ }}</th>
          <td>{{ $order->gallery->title }}</td>
          <td>{{ $order->billing_name }}</td>
          <td>{{ $order->billing_email }}</td>
          <td>{{ $order->billing_phone }}</td>
          <td>{{ number_format($order->total_price, 2, '.', '') }}</td>
          <td>{{ $order->billing_address }}</td>
          <td>{{ $order->updated_at }}</td>
          <td><a href="javascript:void(0)" data-order-id="{{ $order->id }}" class="btn-view-items btn-grey">View</a></td>
          <td class="order-item-info" style="display: none;">
            <div class="order-items__inner">
              <div class="order-items-image-info flex jcb">
                <div class="order-items-image">
                  <img src="/images/{{ $order->gallery->image }}">
                </div>
                <div class="order-items-info">
                    <label class="order-items-gallery-number">No. {{ sprintf("%07d", $order->gallery->id) }}</label>
                    <h2>{{ $order->gallery->title_ko }}<span>({{ $order->gallery->category->cat_name_ko }})</span></h2>
                    <div class="order-items-info-item">
                      <label>크기: {{ $order->gallery->width }} * {{ $order->gallery->height }} {{ $order->gallery->unit }}</label>
                    </div>
                    <div class="order-items-info-item">
                      <label>가격: {{ $order->gallery->retail_price }} USD</label>
                    </div>
                    <div class="order-items-info-item">
                      <label>작가: {{ $order->gallery->artist_name_ko }}</label>
                    </div>
                  <h2></h2>
                </div>
              </div>

              <div class="order-items-contact mt-3">
                <div class="form-group mb-1">
                  <label>전자우편: {{ $order->billing_email }}</label>
                  <span></span>
                </div>

                <div class="form-group mb-1">
                  <label>전화번호: {{ $order->billing_phone }}</label>
                  <span></span>
                </div>

                <div class="form-group mb-1">
                  <label>주소: {{ $order->billing_address }}</label>
                  <span></span>
                </div>

                <div class="form-group mb-1">
                  <label>수하인 이름: {{ $order->billing_name }}</label>
                  <span></span>
                </div>

                <div class="form-group mb-1">
                  <label>설명: {{ $order->comment }}</label>
                  <span></span>
                </div>
              </div>

              <form action="{{ route('admin-order.update',$order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="update-status mt-3">
                  <label>상태</label>
                  <select class="browser-default custom-select" name="status">
                    <option value="processing" @if ($order->status == 'processing') selected @endif>처리중</option>
                    <option value="waiting" @if ($order->status == 'waiting') selected @endif>지불대기중</option>
                    <option value="sending" @if ($order->status == 'sending') selected @endif>배송중</option>
                    <option value="completed" @if ($order->status == 'completed') selected @endif>완료</option>
                    <option value="cancel" @if ($order->status == 'cancel') selected @endif>주문취소</option>
                  </select>
                </div>
                <div class="btns-order-status text-right">
                  <button type="submit" class="btn-update-status btn-grey">변경</button>
                  <a href="javascript:void(0)" class="btn-cancel-status btn-grey">취소</a>
                </div>
              </form>
            </div>
          </td>
          <td style="text-transform: capitalize;">
            @if ($order->status == 'processing')
              처리중
            @elseif ($order->status == 'waiting')
              지불대기중
            @elseif ($order->status == 'sending')
            배송중
            @elseif ($order->status == 'completed')
              완료
            @elsif ($order->status == 'cancel')
              주문취소
            @endif
          </td>
        </tr>
        @endforeach
      @endif
    </tbody>
  </table>

  <div class="popup-order-items position-absolute">
    
  </div>
</div>

@endsection