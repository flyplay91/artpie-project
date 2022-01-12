@extends('admin.layout')

@section('content')

<div class="block-admin-transactions mt-3">
  <h2>지불리력</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">리력 ID</th>
        <th scope="col">설명</th>
        <th scope="col">쪼각 개수</th>
        <th scope="col">그림 ID</th>
        <th scope="col">그림 제목</th>
        <th scope="col">송금핸 사람</th>
        <th scope="col">받은 사람</th>
        <th scope="col">금액</th>
      </tr>
    </thead>
    <tbody>
      @if (!empty($transactions))
        @foreach($transactions as $transaction)
        <tr>
          <th scope="row">{{ $transaction->id }}</th>
          <td>
            @if ($transaction->description == 'whole')
              완전구매
            @else
              쪼각구매
            @endif
          </td>
          <td>{{ $transaction->piece_count }}</td>
          <td>{{ $transaction->gallery_id }}</td>
          <td>{{ $transaction->gallery_title }}</td>
          <td>{{ $transaction->sender }}</td>
          <td>{{ $transaction->receiver }}</td>
          <td>{{ $transaction->price }}</td>
        </tr>
        @endforeach
      @endif
    </tbody>
  </table>
</div>

@endsection