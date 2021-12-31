@if ($order)
    <div class="card mb-5">
        <div class="card-header">Order # <strong><em>{{ $order->id }}</em></strong></div>
        
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
@endif