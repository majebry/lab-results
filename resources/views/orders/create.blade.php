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
                <div class="card-header">Create an Order</div>

                <div class="card-body">
                    <form action="{{ url('orders') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Full Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="patient_name" value="{{ old('patient_name') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Date of Birth</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="patient_date_of_birth" value="{{ old('patient_date_of_birth') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Phone</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="patient_phone" value="{{ old('patient_phone') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="patient_email" value="{{ old('patient_email') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Reason of Test</label>

                            <div class="col-md-6">
                                <select name="reason_of_test" class="form-control">
                                    <option value="Exposed" {{ old('reason_of_test') == 'Exposed' ? 'selected' : '' }}>Exposed</option>
                                    <option value="Traveling" {{ old('reason_of_test') == 'Traveling' ? 'selected' : '' }}>Traveling</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Covid Test Type</label>

                            <div class="col-md-6">
                                <select name="covid_test_type" class="form-control">
                                    <option value="Sars-cov-2 NAA" {{ old('covid_test_type') == 'Sars-cov-2 NAA' ? 'selected' : '' }}>Sars-cov-2 NAA</option>
                                    <option value="Sars-cov-2 PCR" {{ old('covid_test_type') == 'Sars-cov-2 PCR' ? 'selected' : '' }}>Sars-cov-2 PCR</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Date of Test</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="date_of_test" value="{{ old('date_of_test', date('Y-m-d')) }}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Order
                                </button>

                                <a class="btn btn-warning" href="{{ url('orders') }}">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection