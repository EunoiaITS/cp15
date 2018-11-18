@if(session()->has('success-message'))
    <p class="alert alert-success">
        {{ session()->get('success-message') }}
    </p>
@endif
@if(session()->has('error-message'))
    <p class="alert alert-danger">
        {{ session()->get('error-message') }}
    </p>
@endif
@if(session()->has('error'))
    <p class="alert alert-danger">
        {{ session()->get('error') }}
    </p>
@endif
@if(session()->has('success'))
    <p class="alert alert-success">
        {{ session()->get('success') }}
    </p>
@endif