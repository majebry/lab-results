<form action="{{ $action === 'update' ? url("roles/{$role->id}") : url("roles") }}" method="post">
    @csrf

    @if ($action === 'update')
        @method('PATCH')
    @endif
    
    <div class="row mb-3">
        <div class="col-md-4 col-form-label">Role Name</div>

        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name', $action === 'update' ? $role->name : null) }}">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 col-form-label">Permissions</div>

        <div class="col-md-6">
            <select name="permissions[]" multiple class="form-control">
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', $action == 'update' ? $role->permissions->pluck('id')->toArray() : [])) ? 'selected' : '' }}>{{ $permission->name }}</option>
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