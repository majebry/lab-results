@if ($order->vitals_document)
    <a target="_blank" href="{{ $order->vitals_document_url }}" class="btn btn-light" download>Vitals Pdf</a>
@else
    @can('create vitals')
        <a href="{{ url("orders/{$order->id}/vitals/create") }}" class="btn btn-info">Vitals</a>
    @endcan
@endif

@if ($order->result)
    <a target="_blank" href="{{ $order->result->file_url }}" class="btn btn-light" download>Result Pdf</a>
@endif

@can('notify patients')
    @if ($order->result && $order->patient_phone && !$order->is_patient_notified)
        <form action="{{ url("orders/{$order->id}/notify-patient-via-sms") }}" method="post" style="display:inline">
            @csrf
            <button class="btn btn-secondary">Notify Patient</button>
        </form>
    @endif
@endcan

@if ($order->is_patient_notified)
    <button class="btn btn-outline-info" disabled>Notified</button>
@endif
