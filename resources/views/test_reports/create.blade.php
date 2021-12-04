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
                    <form action="{{ url('test-reports') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Patient ID</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="patient_id" value="{{ old('patient_id') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Date of Birth</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Covid Result</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="covid_result" value="positive">
                                    <label>Positive</label>
                                </div>

                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="covid_result" value="negative">
                                    <label>Negative</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">File</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="file">
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