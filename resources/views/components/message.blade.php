@if (session('success'))
    <div class="alert alert-success fade-in">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger fade-in">{{ session('error') }}</div>
@endif
