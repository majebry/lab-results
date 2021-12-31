@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                @include('shared.errors')

                <div class="card">
                    <div class="card-header">Create a User</div>

                    <div class="card-body">
                        @include('users._form', ['action' => 'create'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection