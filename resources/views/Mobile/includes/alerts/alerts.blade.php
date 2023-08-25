@if (session('error'))
    <div class="alert alert-card alert-danger">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-card alert-success">
        {{ session('success') }}
    </div>
@endif
