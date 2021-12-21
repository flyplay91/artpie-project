@extends('admin.layout')

@section('content')

<div class="block-admin-orders mt-3">
  <h2>Orders</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Full Name</th>
        <th scope="col">Email</th>
        <th scope="col">Total Price</th>
        <th scope="col">Address 1</th>
        <th scope="col"> Address 2</th>
        <th scope="col">Address 3</th>
        <th scope="col">Address 4</th>
        <th scope="col">Address 5</th>
        <th scope="col">Date</th>
        <th scope="col">Items</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @if (isset($orders))
        @foreach($orders as $order)
        <tr>
          <th scope="row">{{ $order->id }}</th>
          <td>{{ $order->user_name }}</td>
          <td>{{ $order->user_email }}</td>
          <td>¥ {{ number_format($order->total_price, 2, '.', '') }}</td>
          <td>{{ $order->address_1 }}</td>
          <td>{{ $order->address_2 }}</td>
          <td>{{ $order->address_3 }}</td>
          <td>{{ $order->address_4 }}</td>
          <td>{{ $order->address_5 }}</td>
          <td>{{ $order->updated_at }}</td>
          <td><a href="javascript:void(0)" data-order-id="{{ $order->id }}" class="btn-view-items btn-grey">View</a></td>
          <td class="td-order-item">
            <div class="order-items">
              @foreach($orderLineItems as $orderItem)
                @if ($orderItem->order_id == $order->id )
                <div class="order-item flex aic jcb">
                  <div class="order-item__image w-20">
                    <img src="/images/{{ $orderItem->image }}">
                  </div>
                  <div class="order-item__title">
                    {{ $orderItem->title }}
                  </div>
                  <div class="order-item__qty">
                    {{ $orderItem->qty }}
                  </div>
                  <div class="order-item__price">
                    ¥ {{ number_format($orderItem->price, 2, '.', '') }}
                  </div>
                </div>
                @endif
              @endforeach
              <form action="{{ route('admin-order.update',$order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="update-status mt-3">
                  <label>Status</label>
                  <select class="browser-default custom-select" name="status">
                    <option selected>{{ $order->status }}</option>
                    <option value="competed">completed</option>
                    <option value="pending">pending</option>
                  </select>
                </div>
                <button type="submit" class="btn-update-status btn-grey">Update</button>
              </form>
              

              <div class="btns-update-cancel-popup flex aic jcb mt-3">
                <a href="javascript:void(0)" class="btn-update-popup btn-grey">Update</a>
                <a href="javascript:void(0)" class="btn-cancel-popup btn-grey">Cancel</a>
              </div>
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