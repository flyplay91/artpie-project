@extends('front.layouts.app')

@section('content')
  <div class="container">
    <div class="block-admin-orders mt-3">
      <h2>입금리력</h2>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">번호</th>
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
@endsection