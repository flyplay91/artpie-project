@extends('admin.layout')

@section('content')

<div class="block-admin-users mt-3">
  <h2>사용자 정보</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">사용자 ID</th>
        <th scope="col">이름</th>
        <th scope="col">전자우편/폰번호</th>
        <th scope="col">주소 1</th>
        <th scope="col">주소 2</th>
        <th scope="col">주소 3</th>
        <th scope="col">주소 4</th>
        <th scope="col">주소 5</th>
        <th scope="col">총 가격</th>
        <th scope="col">투자 가격</th>
        <th scope="col">투자가</th>
        <th scope="col">Admin</th>
        <th scope="col" style="width: 100px;">보기</th>
        <th scope="col" style="width: 120px;">동작</th>
      </tr>
    </thead>
    <tbody>
      @if (isset($users))
        @foreach($users as $user)
          <tr class="boxCtnt">
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->address_1 }}</td>
            <td>{{ $user->address_2 }}</td>
            <td>{{ $user->address_3 }}</td>
            <td>{{ $user->address_4 }}</td>
            <td>{{ $user->address_5 }}</td>
            <td></td>
            <td></td>
            @if ($user->email == 'superadmin@kartpie.com')
            <td></td>
            <td>Super Admin</td>
            <td></td>
            <td></td>
            @else
            <td class="investor-user">
              <label class="chkBox2">
                <input type="checkbox" data-user-id="{{ $user->id }}" @if ($user->role == 'buyer') checked="checked" @endif>
                <div class="chkBox2_box"></div>
              </label>
            </td>
            <td class="admin-user">
              <label class="chkBox2">
                <input type="checkbox" data-user-id="{{ $user->id }}" @if ($user->role == 'admin') checked="checked" @endif>
                <div class="chkBox2_box"></div>
              </label>
            </td>

            <td><a href="" class="btn-view-profile btn-grey">보기 </a></td>
            <td>
              <form class="" action="{{ route('admin-user.destroy',$user->id) }}" method="POST" enctype="multipart/form-data">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-grey btn-delete-gallery">삭제</button>
              </form>
            </td>
            @endif
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>

</div>

@endsection