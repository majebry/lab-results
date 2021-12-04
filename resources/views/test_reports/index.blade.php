@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a href="{{ url('test-reports/create') }}" class="btn btn-primary mb-4">Add Test Report</a>

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <p>{{ session()->get('message') }}</p>
                    </div>
                @endif
                
                <div class="card">
                    <div class="card-header">Patient Results</div>

                    <div class="card-body">
                        @if ($reports->count())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Patient ID</th>
                                        <th scope="col">Patient Name</th>
                                        <th scope="col">Date of Birth</th>
                                        <th scope="col">Covid Result</th>
                                        <th scope="col">Report Inserted At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <th>{{ $report->patient_id }}</th>
                                            <td>{{ $report->patient_name }}</td>
                                            <td>{{ $report->birthdate }}</td>
                                            <td>{{ $report->covid_result }}</td>
                                            <td>{{ $report->created_at->toDayDateTimeString() }}</td>
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
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
