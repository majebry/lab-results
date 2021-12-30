@extends('layouts.patient')

@section('content')

<div class="justify-content-center">
    
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    
    <div class="card text-center">
        <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Get Report Result</h4>
        </div>

        <div class="card-body">
            <form action="{{ url('/') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-right">Order Number</label>

                    <div class="col-md-6">
                        <input type="number" class="form-control form-control-lg" name="number">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-4 col-form-label text-md-right">Date of Birth</label>

                    <div class="col-md-6">
                        <input type="date" class="form-control form-control-lg" name="birthdate" placeholder="mm/dd/yyyy">
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {!! NoCaptcha::display() !!}
                </div>

                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-outline-primary btn-lg w-50">
                        Check
                    </button>
                </div>
            </form>
        </div>
    </div>
    
</div>

@endsection