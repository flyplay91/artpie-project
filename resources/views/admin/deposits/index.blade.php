@extends('admin.layout')

@section('content')

  <div class="block-admin-orders mt-3">
    <h2>입금리력</h2>

    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th scope="col">No</th>
          <th scope="col">날자 시간</th>
          <th scope="col">사용자 ID</th>
          <th scope="col">이름</th>
          <th scope="col">금액(USD)</th>
          <th scope="col">상태</th>
          <th scope="col">동작</th>
        </tr>
      </thead>
      <tbody>
        @if (!empty($deposits))
          @foreach($deposits as $deposit)
          <tr class="text-right">
            <th scope="row">{{ $deposit->id }}</th>
            <td>{{ $deposit->created_at }}</td>
            <td>{{ $deposit->user->id }}</td>
            <td>{{ $deposit->user->name }}</td>
            <td>{{ number_format($deposit->amount, 2, '.', ' ') }}</td>
            <td class="status">
              @if ($deposit->status == 'pending')
                처리중
              @elseif ($deposit->status == 'complete')
                완료
              @else
                취소
              @endif
            </td>
            <td>
              @if ($deposit->status == 'pending')
                <button class="btn btn-grey btn-confirm-deposit" data-deposit-id="{{ $deposit->id }}">확인</button>
              @endif
              @if ($deposit->status != 'cancel')
                <button class="btn btn-grey btn-cancel-deposit" data-deposit-id="{{ $deposit->id }}">취소</button>
              @endif
            </td>
          </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
@endsection