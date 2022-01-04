@extends('front.layouts.app')

@section('content')
  <div class="account-deposits-page">
    <div class="container">
      <div class="block-admin-orders mt-3">
        <h2>입금</h2>
        <form class="deposit-form" method="post" action="{{ route('process-deposit') }}">
          @csrf
          <img src="/images/wechat-icon.png" />

          <label>
            액수
            <input type="number" name="amount" />
          </label>
          <button class="btn btn-primary" type="submit">요청 보내기</button>
        </div>

        <h2>입금리력</h2>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">리력번호</th>
              <th scope="col">입금자번호</th>
              <th scope="col">입금자이름</th>
              <th scope="col">액수</th>
              <th scope="col">상태</th>
            </tr>
          </thead>
          <tbody>
            @if (!empty($deposits))
              @foreach($deposits as $deposit)
              <tr>
                <th scope="row">{{ $deposit->id }}</th>
                <td>{{ $deposit->user->id }}</td>
                <td>{{ $deposit->user->name }}</td>
                <td>{{ $deposit->amount }}</td>
                <td>{{ $deposit->status }}</td>
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection