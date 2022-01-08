@extends('layouts.patient')

@section('content')
    <div class="container justify-content-center">

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
                                <th scope="row">ID Card</th>
                                <td>{{ $order->patient_id_card_number }}</th>
                            </tr>
                            <tr>
                                <th scope="row">Date of Birth</th>
                                <td>{{ $order->formatted_date_of_birth }}</th>
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
                            @if ($order->result)
                                <tr>
                                    <th scope="row">Result</th>
                                    <td>
                                        <div class="row mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="fw-bold text-decoration-underline">Covid</div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="has_covid" disabled {{ $order->result->has_covid ? 'checked' : '' }}>
                                                        <label>Positive</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="has_covid" disabled {{ $order->result->has_covid === false ? 'checked' : '' }}>
                                                        <label>Negative</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fw-bold text-decoration-underline">Flu A</div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="has_flu_a" disabled {{ $order->result->has_flu_a ? 'checked' : '' }}>
                                                        <label>Positive</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="has_flu_a" disabled {{ $order->result->has_flu_a === false ? 'checked' : '' }}>
                                                        <label>Negative</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fw-bold text-decoration-underline">Flu B</div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="has_flu_b" disabled {{ $order->result->has_flu_b ? 'checked' : '' }}>
                                                        <label>Positive</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="has_flu_b" disabled {{ $order->result->has_flu_b === false ? 'checked' : '' }}>
                                                        <label>Negative</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="fw-bold text-decoration-underline">RSV</div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="has_rsv" disabled {{ $order->result->has_rsv ? 'checked' : '' }}>
                                                        <label>Positive</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" name="has_rsv" disabled {{ $order->result->has_rsv === false ? 'checked' : '' }}>
                                                        <label>Negative</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <a target="_blank" href="{{ url($order->result->file_url) }}">View Document</a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <th scope="row">Result</th>
                                    <td>
                                        <div class="alert alert-warning">
                                            <p>No result yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <p>We couldn't find your the order, please recheck the information you've entered.</p>
            </div>
        @endif

    </div>
@endsection
