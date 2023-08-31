@if (session('error'))
    <div class="alert alert-soft-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-soft-success" role="alert">
        {{ session('success') }}
    </div>
@endif
