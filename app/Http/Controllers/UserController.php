<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::with('roles')->get()
        ]);
    }
    
    public function create()
    {
        return view('users.create', [
            'roles' => Role::where('name', '!=', 'Super Admin')->get()
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($request->role == Role::findByName('Super Admin')->id) {
            session()->flash('status', [
                'status' => 'danger',
                'message' => 'Role Super Admin cannot be assigned'
            ]);
        } else {
            $user->syncRoles($request->role);
        }

        return redirect('users');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    public function update(User $user, UserRequest $request)
    {
        if ($user->hasRole('Super Admin')) {
            session()->flash('status', [
                'status' => 'danger',
                'message' => 'Super Admin user cannot be changed'
            ]);

            return redirect('users');
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $userRoleId = $user->roles()->count() ? $user->roles->first()->id : null;
        
        if (
            $request->role == Role::findByName('Super Admin')->id && 
            $userRoleId != $request->role
        ) {
            session()->flash('status', [
                'status' => 'danger',
                'message' => 'Role Super Admin cannot be assigned'
            ]);
        } else {
            $user->syncRoles($request->role);
        }

        return redirect('users');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('Super Admin')) {
            session()->flash('status', [
                'status' => 'danger',
                'message' => 'Super Admin user cannot be deleted'
            ]);

            return redirect('users');
        }

        $user->delete();

        return redirect('users');
    }
}
