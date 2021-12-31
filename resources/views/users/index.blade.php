@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                @include('shared.status')
                
                @can('create users')
                    <a href="{{ url('users/create') }}" class="btn btn-primary mb-3">Create New User</a>
                @endcan
                
                @if ($users->count())
                    <div class="card">
                        <div class="card-header">Users List</div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->roles->count() ? $user->roles->first()->name : '' }}</td>
                                            <td>
                                                @can('edit users')
                                                    <a href="{{ url("users/{$user->id}/edit") }}" class="btn btn-warning">Edit</a>
                                                @endcan

                                                @can('delete users')
                                                    <form action="{{ url("users/{$user->id}") }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <p>No users created yet!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection