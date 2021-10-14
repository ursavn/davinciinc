@if (session('success'))
    <div class="alert alert-success alert-block">
        <strong>{{ session('success') }}</strong>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-block">
        <strong>{{ session('error') }}</strong>
    </div>
@endif
