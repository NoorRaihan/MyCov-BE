
                @if(Request::is('admin/user/*/edit')) @method('PUT') @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input name="name" class="form-control" value="{{$user->name ?? ''}}" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" class="form-control" value="{{$user->email ?? ''}}" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" class="form-control" id="password" required>
                </div>
                <h2>Roles</h2>
                @foreach ($roles as $role)
                    <div class="mb-3 form-check">
                        <input type="checkbox" value="{{$role->name}}" class="form-check-input" name="role" id="role">
                        <label class="form-check-label" for="exampleCheck1">{{$role->name}}</label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">@if(Request::is('admin/user/*/edit')) Update @else Add @endif</button>
