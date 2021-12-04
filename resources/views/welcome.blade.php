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
                <div class="card-header">Get Report Result</div>

                <div class="card-body">
                    <form action="{{ url('/') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Report Number</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="report_number">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-right">Date of Birth</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="birthdate">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! NoCaptcha::display() !!}

                                <button type="submit" class="btn btn-primary">
                                    Check
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