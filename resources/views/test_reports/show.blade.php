@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if ($report)
                    <div class="card">
                        <div class="card-header">Test Report for <strong><em>{{ $report->patient_name }}</em></strong></div>

                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Report Number</th>
                                        <td>{{ $report->id }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Patient ID</th>
                                        <td>{{ $report->patient_id }}</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Birthdate</th>
                                        <td>{{ $report->birthdate }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">
                        <p>No report found, please recheck the data you entered are correct!</p>
                        
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Go back!</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection