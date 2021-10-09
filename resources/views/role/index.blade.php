@extends('layouts.app');

@section('content')
<div>
    <div class="container">
        <a style="margin-bottom: 20px" class="btn btn-primary" href="/admin/roles/create" role="button">Add Role</a>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Permission</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$role->name}}</td>
                    {{-- <td>{{$role->getPermissionNames()}}</td> --}}
                    @php $count = 0; @endphp
                    @foreach ($users as $user)
                        @if($user->hasAnyRole($role->name)) @php $count++; @endphp @endif 
                    @endforeach
                    <td style="color: green">{{$count}} users</td>
                    <td>
                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" value="delete">DELETE</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>

@endsection