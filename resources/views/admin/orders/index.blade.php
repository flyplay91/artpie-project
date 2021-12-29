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
        <th scope="col">Phone Number</th>
        <th scope="col">Total Price</th>
        <th scope="col">Address</th>
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
          <td>{{ $order->billing_name }}</td>
          <td>{{ $order->billing_email }}</td>
          <td>{{ $order->billing_phone }}</td>
          <td>¥ {{ number_format($order->total_price, 2, '.', '') }}</td>
          <td>{{ $order->billing_address }}</td>
          <td>{{ $order->updated_at }}</td>
          <td><a href="javascript:void(0)" data-order-id="{{ $order->id }}" class="btn-view-items btn-grey">View</a></td>
          <td style="text-transform: capitalize;">{{ $order->status }}</td>
        </tr>
        @endforeach
      @endif
    </tbody>
  </table>

  <div class="popup-order-items position-absolute">
    <!-- <form action="{{ route('admin-order.update',$order->id) }}" method="POST" enctype="multipart/form-data">
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
    </form> -->
  </div>
</div>

@endsection