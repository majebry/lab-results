@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            
            <div class="card">
                <div class="card-header">Add a Test Report</div>

                <div class="card-body">
                    <form action="{{ url('test-reports') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Identity</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="patient_id">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Birthdate</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="birthdate">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection