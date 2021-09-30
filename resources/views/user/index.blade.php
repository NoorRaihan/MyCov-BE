@extends('layouts.app');

@section('content')
    <div>
        <div class="container">
            <a style="margin-bottom: 20px" class="btn btn-primary" href="/admin/user/create" role="button">Add User</a>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users ?? '' as $user)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->roles[0]->name}}</td>
                        <td>
                            <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('user.edit', $user->id)}}" role="button" class="btn btn-success">EDIT</a>
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