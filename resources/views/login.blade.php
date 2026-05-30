@extends('layouts.main')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header text-white text-center">
                <h4><i class="fas fa-sign-in-alt"></i> Login</h4>
            </div>
            <div class="card-body p-4">

                {{-- Error Message --}}
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    </div>
                @endif

                {{-- Success Message (from register) --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email') }}"
                               placeholder="Enter your email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Enter your password" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-pink">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </div>
                </form>

                <hr>
                <p class="text-center mb-0 small">Don't have an account?
                    <a href="/register">Register here</a>
                </p>

            </div>
        </div>
    </div>
</div>

{{-- Toast Notification --}}
@if(session('success'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="successToast" class="toast show align-items-center text-white border-0"
         role="alert" style="background-color: #e26d9f;">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        var toast = document.getElementById('successToast');
        if (toast) toast.style.display = 'none';
    }, 4000);
</script>
@endif

@endsection