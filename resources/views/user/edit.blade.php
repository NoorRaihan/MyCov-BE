@extends('layouts.app')

@section('content')
    <div>
        <div class="container">
            <h1>@if(Request::is('admin/user/*/edit')) Edit User @else Add User @endif</h1>
            <form method="POST" action="{{route('user.update', $user->id)}}">
                @csrf
                @method('PUT')
                @include('user.form')
            </form>
        </div>
    </div>
@endsection