@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12">
                @include('shared.status')
                
                @can('create roles')
                    <a href="{{ url('roles/create') }}" class="btn btn-primary mb-3">Create New Role</a>
                @endcan
                
                @if ($roles->count())
                    <div class="card">
                        <div class="card-header">Roles List</div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Role Name</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @can('edit roles')
                                                    <a href="{{ url("roles/{$role->id}/edit") }}" class="btn btn-warning">Edit</a>
                                                @endcan

                                                @can('delete roles')
                                                    <form action="{{ url("roles/{$role->id}") }}" method="post" class="d-inline">
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
                        <p>No roles created yet!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection