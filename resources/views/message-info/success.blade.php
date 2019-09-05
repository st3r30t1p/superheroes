@if(session()->get('success'))
    <div class="alert alert-success text-center">
        {{ session()->get('success') }}
    </div>
@endif