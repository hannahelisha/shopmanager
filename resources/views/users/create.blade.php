@extends('layouts.main')

@section('content')

{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color: #4a4a4a;">
            <i class="fas fa-user-plus me-2" style="color: #e26d9f;"></i> Add User
        </h4>
        <p class="text-muted small mb-0">Create a new user account</p>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-pink">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header text-white text-center">
                <h5><i class="fas fa-user-plus me-2"></i> User Information</h5>
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

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name') }}"
                               placeholder="Enter full name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email') }}"
                               placeholder="Enter email address" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Enter password (min. 6 characters)" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-pink">
                            <i class="fas fa-user-plus me-1"></i> Add User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection