@extends('layouts.main')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header text-white text-center" style="background-color: #FFB6C1 !important;">
    <h4 style="font-family: 'Poppins', sans-serif;">
        <i class="fas fa-user-plus"></i> Registration Form
    </h4>
</div>
            <div class="card-body p-4">

                {{-- Error Messages --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/register" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" 
                               value="{{ old('name') }}" 
                               placeholder="Enter your full name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" 
                               value="{{ old('email') }}" 
                               placeholder="Enter your email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" 
                               placeholder="Enter password (min. 6 characters)" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" 
                               placeholder="Confirm your password" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-pink">
                            <i class="fas fa-user-plus"></i> Register
                        </button>
                    </div>
                </form>

                <hr>
                <p class="text-center mb-0 small">Already have an account? 
                    <a href="/login">Login here</a>
                </p>

            </div>
        </div>
    </div>
</div>

{{-- Toast Notification --}}
@if(session('success'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="successToast" class="toast show align-items-center text-white border-0" 
         role="alert" style="background: linear-gradient(90deg, #C9547A, #DA70D6);">
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