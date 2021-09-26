@extends('layouts.app')

@section('content')
    <div>
        <div class="container">
            <form method="POST" action="/roles">
                @csrf
                <div class="mb-3">
                    <label for="role_name" class="form-label">Role's Name</label>
                    <input name="role_name" class="form-control" id="role_name">
                </div>
                @foreach ($permissions as $permission)
                    <div class="mb-3 form-check">
                        <input type="checkbox" value="{{$permission->name}}" class="form-check-input" name="role_permission" id="permission">
                        <label class="form-check-label" for="exampleCheck1">{{$permission->name}}</label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection