@if (session()->has('status'))
    <div class="alert alert-{{ session()->get('status')['status'] }}">
        <p>{{ session()->get('status')['message'] }}</p>
    </div>
@endif