<form action="{{ $action === 'update' ? url("users/{$user->id}") : url("users") }}" method="post">
    @csrf

    @if ($action === 'update')
        @method('PATCH')
    @endif
    
    <div class="row mb-3">
        <div class="col-md-4 col-form-label">Name</div>

        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name', $action === 'update' ? $user->name : null) }}">
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-4 col-form-label">ُEmail</div>

        <div class="col-md-6">
            <input type="email" class="form-control" name="email" value="{{ old('email', $action === 'update' ? $user->email : null) }}">
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-4 col-form-label">Password</div>

        <div class="col-md-6">
            <input type="password" class="form-control" name="password" value="">
            
            @if ($action === 'update')
                <span class="text-warning" role="alert">
                    <strong class="small">Keep the input empty if you don't want to change the user's password</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 col-form-label">Role</div>

        <div class="col-md-6">
            <select name="role" class="form-control">
                <option value="">-- Choose --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', $action == 'update' ? $user->roles->pluck('id')->toArray() : [])) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ ucfirst($action) }}
            </button>
        </div>
    </div>
</form>