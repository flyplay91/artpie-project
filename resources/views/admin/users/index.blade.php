@extends('admin.layout')

@section('content')

<div class="block-admin-users mt-3">
  <h2>Users</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">User ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email/Phone</th>
        <th scope="col">Email Verified</th>
        <th scope="col">Address 1</th>
        <th scope="col">Address 2</th>
        <th scope="col">Address 3</th>
        <th scope="col">Address 4</th>
        <th scope="col">Address 5</th>
        <th scope="col">Total Price</th>
        <th scope="col">Invest Price</th>
        <th scope="col">Investor</th>
        <th scope="col">Admin</th>
        <th scope="col" style="width: 100px;">View</th>
        <th scope="col" style="width: 120px;">Action</th>
      </tr>
    </thead>
    <tbody>
      @if (isset($users))
        @foreach($users as $user)
          <tr class="boxCtnt">
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->email_veficied_at }}</td>
            <td>{{ $user->address_1 }}</td>
            <td>{{ $user->address_2 }}</td>
            <td>{{ $user->address_3 }}</td>
            <td>{{ $user->address_4 }}</td>
            <td>{{ $user->address_5 }}</td>
            <td></td>
            <td></td>
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
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>

</div>

@endsection