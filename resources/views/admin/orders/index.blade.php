@extends('admin.layout')

@section('content')

<div class="block-admin-orders mt-3">
  <h2>주문 정보</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">주문 번호</th>
        <th scope="col">그림 제목</th>
        <th scope="col">하수인 이름</th>
        <th scope="col">전자우편</th>
        <th scope="col">전화번호</th>
        <th scope="col">총 가격</th>
        <th scope="col">주소</th>
        <th scope="col">날자</th>
        <th scope="col">보기</th>
        <th scope="col">상태</th>
      </tr>
    </thead>
    <tbody>
      @if (!empty($orders))
        @foreach($orders as $order)
        <tr>
          <th scope="row">{{ $order->id }}</th>
          <td>{{ $order->gallery->title }}</td>
          <td>{{ $order->billing_name }}</td>
          <td>{{ $order->billing_email }}</td>
          <td>{{ $order->billing_phone }}</td>
          <td>¥ {{ number_format($order->total_price, 2, '.', '') }}</td>
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
                    <h2>{{ $order->gallery->title }}<span>({{ $order->gallery->category_id }})</span></h2>
                    <div class="order-items-info-item">
                      <label>크기: {{ $order->gallery->width }} * {{ $order->gallery->height }} {{ $order->gallery->unit }}</label>
                    </div>
                    <div class="order-items-info-item">
                      <label>가격: {{ $order->gallery->retail_price }} RMB</label>
                    </div>
                    <div class="order-items-info-item">
                      <label>작가: {{ $order->gallery->artist_id }}</label>
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
                  <label>Status</label>
                  <select class="browser-default custom-select" name="status">
                    <option value="completed" @if ($order->status == 'completed') selected @endif>Completed</option>
                    <option value="pending" @if ($order->status == 'pending') selected @endif>Pending</option>
                  </select>
                </div>
                <div class="btns-order-status text-right">
                  <button type="submit" class="btn-update-status btn-grey">Update</button>
                  <a href="javascript:void(0)" class="btn-cancel-status btn-grey">Cancel</a>
                </div>
              </form>
            </div>
          </td>
          <td style="text-transform: capitalize;">{{ $order->status }}</td>
        </tr>
        @endforeach
      @endif
    </tbody>
  </table>

  <div class="popup-order-items position-absolute">
    
  </div>
</div>

@endsection