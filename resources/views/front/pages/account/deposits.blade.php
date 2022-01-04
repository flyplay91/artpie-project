@extends('front.layouts.app')

@section('content')
  <div class="account-deposits-page">
    <div class="container">
      <div class="block-admin-deposit">
        <h2>{{ __('messages.deposit_funds') }}</h2>
        <form class="deposit-form" method="post" action="{{ route('process-deposit') }}">
          @csrf

          <div class="deposit-form__inner flex aic jca">
            <img src="/images/wechat-icon.png" />
          
            <div class="deposit-form-price flex aic jcb">
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ __('messages.price') }}</span>
                </div>
                <input type="number" name="amount" class="form-control">
              </div>
              <button class="btn btn-grey" type="submit">요청 보내기</button>
            </div>
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