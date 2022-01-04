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
              <button class="btn btn-grey" type="submit">{{ __('messages.send_request') }}</button>
            </div>
        </div>

        <h2>{{ __('messages.deposit_history') }}</h2>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">{{ __('messages.history_no') }}</th>
              <th scope="col">{{ __('messages.depositor_no') }}</th>
              <th scope="col">{{ __('messages.depositor_name') }}</th>
              <th scope="col">{{ __('messages.amount') }}</th>
              <th scope="col">{{ __('messages.status') }}</th>
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