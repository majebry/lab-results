<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index', [
            'roles' => Role::all()
        ]);
    }
    
    public function create()
    {
        return view('roles.create', [
            'permissions' => Permission::all()
        ]);
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->only('name'));

        $role->syncPermissions($request->only('permissions'));

        return redirect('roles');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    public function update(Role $role, RoleRequest $request)
    {
        if ($role->name === 'Super Admin') {
            session()->flash('status', [
                'status' => 'danger',
                'message' => 'Role Super Admin cannot be changed'
            ]);

            return redirect('roles');
        }

        $role->update($request->only('name'));

        $role->syncPermissions($request->only('permissions'));

        return redirect('roles');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'Super Admin') {
            session()->flash('status', [
                'status' => 'danger',
                'message' => 'Role Super Admin cannot be deleted'
            ]);

            return redirect('roles');
        }
 
        $role->delete();

        return redirect('roles');
    }
}
