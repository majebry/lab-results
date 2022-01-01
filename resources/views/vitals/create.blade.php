@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                @include('orders._order_details')
                
                @include('shared.errors')
                
                <div class="card">
                    <div class="card-header">Order # {{ $order->id }} Vitals</div>

                    <div class="card-body">
                        <form action="{{ url("orders/{$order->id}/vitals") }}" method="post">
                            @csrf

                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Temperature</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="temperature" value="{{ old('temperature') }}">
                                        <span class="input-group-text">°F</span>
                                    </div>
                                </div>

                                <div class="col">
                                    <label class="form-label">Pulse</label>
                                    <input type="text" class="form-control" name="pulse" value="{{ old('pulse') }}">
                                </div>

                                <div class="col">
                                    <label class="form-label">O2Sat</label>
                                    <input type="text" class="form-control" name="o2sat" value="{{ old('o2sat') }}">
                                </div>
                            </div>

                            <h4>Have the patient experienced any of the following symptoms?</h4>

                            <div class="row p-1">
                                <label class="form-label col-md-9">Fever of 100.4 degrees or greater or chills</label>
                                <div class="col-md-3 text-end">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="fever" id="feverYes" value="1" {{ old('fever') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feverYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="fever" id="feverNo" value="0" {{ old('fever') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feverNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-1 bg-light">
                                <label class="form-label col-md-9">Cough</label>
                                <div class="col-md-3 text-end">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="cough" id="coughYes" value="1" {{ old('cough') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="coughYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="cough" id="coughNo" value="0" {{ old('cough') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="coughNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-1">
                                <label class="form-label col-md-9">Shortness of breath or difficulty breathing</label>
                                <div class="col-md-3 text-end">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="difficulty_breathing" id="difficulyBreathingYes" value="1" {{ old('difficulty_breathing') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="difficulyBreathingYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="difficulty_breathing" id="difficulyBreathingNo" value="0" {{ old('difficulty_breathing') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="difficulyBreathingNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-1 bg-light">
                                <label class="form-label col-md-9">Headache</label>
                                <div class="col-md-3 text-end">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="headache" id="headacheYes" value="1" {{ old('headache') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="headacheYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="headache" id="headacheNo" value="0" {{ old('headache') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="headacheNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-1">
                                <label class="form-label col-md-9">Sore Throat</label>
                                <div class="col-md-3 text-end">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sore_throat" id="soreThroatYes" value="1" {{ old('sore_throat') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="soreThroatYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sore_throat" id="soreThroatNo" value="0" {{ old('sore_throat') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="soreThroatNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-1">
                                <label class="form-label col-md-9">Is the patient vaccinated for COVID-19?</label>
                                <div class="col-md-3 text-end">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="vaccinated" id="vaccinatedYes" value="1" {{ old('vaccinated') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="vaccinatedYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="vaccinated" id="vaccinatedNo" value="0" {{ old('vaccinated') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="vaccinatedNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-1 bg-light">
                                <label class="form-label col-md-9">Has the patient been exposed to a person with COVID-19 or are worried that may be sick with COVID-19?</label>
                                <div class="col-md-3 text-end">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="exposed" id="exposedYes" value="1" {{ old('exposed') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exposedYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="exposed" id="exposedNo" value="0" {{ old('exposed') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exposedNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-1">
                                <label class="form-label col-md-9">Does the patient wants to be seen by one of our Providers by Tele-Medicine video call?</label>
                                <div class="col-md-3 text-end">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="call_request" id="callRequestYes" value="1" {{ old('call_request') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="callRequestYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="call_request" id="callRequestNo" value="0" {{ old('call_request') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="callRequestNo">No</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection