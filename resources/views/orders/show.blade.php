@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="justify-content-center row">
            <div class="col-md-10">
                @if ($order)
                    <div class="card mb-5">
                        <div class="card-header">Order # <strong><em>{{ $order->id }}</em></strong></div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Patient Name</th>
                                        <td>{{ $order->patient_name }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date of Birth</th>
                                        <td>{{ $order->formatted_date_of_birth }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Phone</th>
                                        <td>{{ $order->patient_phone }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>{{ $order->patient_email }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Reason of Test</th>
                                        <td>{{ $order->reason_of_test }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Covid Test Type</th>
                                        <td>{{ $order->covid_test_type }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date of Test</th>
                                        <td>{{ $order->formatted_date_of_test }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @include('shared.errors')
        
                <div class="card mt-4">
                    <div class="card-header">Test Result</div>
                    <div class="card-body">
                        <form action="{{ url('orders/' . $order->id . '/result') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-right">Covid Result</label>
                                <div class="col-md-6 row">
                                    <div class="col">
                                        <div class="fw-bold text-decoration-underline">Covid</div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="has_covid" value="1" {{ $order->result ? 'disabled' : ''}} {{ $order->result && $order->result->has_covid ? 'checked' : '' }}>
                                            <label>Positive</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="has_covid" value="0" {{ $order->result ? 'disabled' : ''}} {{ $order->result && $order->result->has_covid === false ? 'checked' : '' }}>
                                            <label>Negative</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="fw-bold text-decoration-underline">Flu A</div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="has_flu_a" value="1" {{ $order->result ? 'disabled' : ''}} {{ $order->result && $order->result->has_flu_a ? 'checked' : '' }}>
                                            <label>Positive</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="has_flu_a" value="0" {{ $order->result ? 'disabled' : ''}} {{ $order->result && $order->result->has_flu_a === false ? 'checked' : '' }}>
                                            <label>Negative</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="fw-bold text-decoration-underline">Flu B</div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="has_flu_b" value="1" {{ $order->result ? 'disabled' : ''}} {{ $order->result && $order->result->has_flu_b ? 'checked' : '' }}>
                                            <label>Positive</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="has_flu_b" value="0" {{ $order->result ? 'disabled' : ''}} {{ $order->result && $order->result->has_flu_b === false ? 'checked' : '' }}>
                                            <label>Negative</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="fw-bold text-decoration-underline">RSV</div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="has_rsv" value="1" {{ $order->result ? 'disabled' : ''}} {{ $order->result && $order->result->has_rsv ? 'checked' : '' }}>
                                            <label>Positive</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="has_rsv" value="0" {{ $order->result ? 'disabled' : ''}} {{ $order->result && $order->result->has_rsv === false ? 'checked' : '' }}>
                                            <label>Negative</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-right">Physician</label>
                                <div class="col-md-6">
                                    @if (! $order->result)
                                        <select name="physician" class="form-control">
                                            <option value="Nabil Suliman, MD">Nabil Suliman, MD</option>
                                            <option value="Bethany Brooks, PA-C">Bethany Brooks, PA-C</option>
                                            <option value="Alexis Arment, FNP">Alexis Arment, FNP</option>
                                            <option value="S. Chowdhury, MD">S. Chowdhury, MD</option>
                                            <option value="Shahid Ansari, MD">Shahid Ansari, MD</option>
                                            <option value="Njita Honorine, FNP">Njita Honorine, FNP</option>
                                        </select>
                                    @else
                                        {{ $order->result->physician }}
                                    @endif
                                </div>
                            </div>
                            @if ($order->result)
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label text-md-right">Report Document</label>
                                    <div class="col-md-6">
                                        <a target="_blank" href="{{ url($order->result->file_url) }}">View</a>
                                    </div>
                                </div>
                            @endif
                            @if (! $order->result)
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Add Result
                                        </button>
                                        <a href="{{ url('orders') }}" class="btn btn-warning">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="mt-5">
                    <form action="{{ url("orders/{$order->id}") }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
