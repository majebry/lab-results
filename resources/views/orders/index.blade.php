@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a href="{{ url('orders/create') }}" class="btn btn-primary mb-4">Create Order</a>

                <form action="{{ url('orders') }}" method="GET">
                <div class="card mb-4">
                    <div class="card-header">Filter by:</div>
                    <div class="card-body row">
                            <div class="col-auto row">
                                <label class="col-auto col-form-label">Order number:</label>
                                <div class="col-auto">
                                    <input name="id" type="number" class="form-control" value="{{ request()->id }}">
                                </div>
                            </div>
                            <div class="col-auto row">
                                <label class="col-auto col-form-label">Patient date of birth:</label>
                                <div class="col-auto">
                                    <input name="patient_date_of_birth" type="date" class="form-control" value="{{ request()->patient_date_of_birth }}">
                                </div>
                            </div>
                            <div class="col-auto">
                                <input type="submit" value="Search" class="btn btn-secondary">

                                <a href="{{ url('orders') }}" class="btn btn-light">Clear</a>
                            </div>
                        </div>
                    </div>
                </form>

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <p>{{ session()->get('message') }}</p>
                    </div>
                @endif
                
                <div class="card">
                    <div class="card-header">Orders</div>

                    <div class="card-body">
                        @if ($orders->count())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Patient ID</th>
                                        <th scope="col">Patient Name</th>
                                        <th scope="col">Date of Birth</th>
                                        <th scope="col">Date of Test</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <th>{{ $order->id }}</th>
                                            <th>{{ $order->patient_id }}</th>
                                            <td>{{ $order->patient_name }}</td>
                                            <td>{{ $order->formatted_date_of_birth }}</td>
                                            <td>{{ $order->formatted_date_of_test }}</td>
                                            <td>
                                                @if ($order->is_patient_swabbed)
                                                    <button class="btn btn-light" disabled>Swabbed</button>

                                                    @if ($order->result)
                                                        <button class="btn btn-light" disabled>Result issued</button>
                                                    @endif
                                                
                                                    <a href="{{ url('orders/' . $order->id) }}" class="btn btn-info">Show</a>
                                                @else
                                                    <form action="{{ url("orders/{$order->id}/mark-patient-as-swabbed") }}" method="post" style="display:inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-warning">Mark as swabbed</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning">
                                <p>No data!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
