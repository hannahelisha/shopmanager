@extends('layouts.main')

@section('content')

{{-- Page Header --}}
<div class="mb-4">
    <h4 class="fw-bold mb-0" style="color: #4a4a4a;">
        <i class="fas fa-user me-2" style="color: #e26d9f;"></i> My Profile
    </h4>
    <p class="text-muted small mb-0">Manage your profile information</p>
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

@if(session('error'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="errorToast" class="toast show align-items-center text-white border-0"
         role="alert" style="background-color: #d96b7b;">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<script>
    setTimeout(function() {
        var toast = document.getElementById('errorToast');
        if (toast) toast.style.display = 'none';
    }, 4000);
</script>
@endif

<div class="row g-4">

    {{-- Left Column - Avatar & Basic Info --}}
    <div class="col-md-4">
        <div class="card text-center p-4">

            {{-- Avatar --}}
            @if($user->avatar)
                <img src="{{ asset('avatars/' . $user->avatar) }}"
                     class="rounded-circle mx-auto mb-3"
                     style="width: 120px; height: 120px; object-fit: cover;
                            border: 4px solid #e26d9f;
                            box-shadow: 0 4px 12px rgba(0,0,0,0.1);"
                     alt="Avatar">
            @else
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                     style="width: 120px; height: 120px;
                            background-color: #ffeef4;
                            border: 4px solid #e26d9f;">
                    <i class="fas fa-user fa-3x" style="color: #e26d9f;"></i>
                </div>
            @endif

            <h5 class="fw-bold mb-1" style="color: #4a4a4a;">{{ $user->name }}</h5>
            <p class="text-muted small mb-1">{{ $user->email }}</p>
            <p class="text-muted small mb-3">
                <i class="fas fa-calendar me-1" style="color: #e26d9f;"></i>
                Joined {{ $user->created_at->format('M d, Y') }}
            </p>

            {{-- Ice Cream Preferences Summary --}}
            @if($user->ice_cream_preference || $user->serving_preference)
            <div class="p-3 rounded-3 text-start" style="background-color: #ffeef4;">
                <p class="fw-bold small mb-2" style="color: #e26d9f;">
                    🍦 Ice Cream Preferences
                </p>
                @if($user->ice_cream_preference)
                <p class="small mb-1" style="color: #4a4a4a;">
                    <i class="fas fa-heart me-1" style="color: #e26d9f;"></i>
                    Favorite: <strong>{{ $user->ice_cream_preference }}</strong>
                </p>
                @endif
                @if($user->serving_preference)
                <p class="small mb-1" style="color: #4a4a4a;">
                    <i class="fas fa-ice-cream me-1" style="color: #B7D3B0;"></i>
                    Serving: <strong>{{ $user->serving_preference }}</strong>
                </p>
                @endif
                @if($user->topping_preference)
                <p class="small mb-0" style="color: #4a4a4a;">
                    <i class="fas fa-star me-1" style="color: #f4b183;"></i>
                    Toppings: <strong>{{ $user->topping_preference }}</strong>
                </p>
                @endif
            </div>
            @endif

        </div>
    </div>

    {{-- Right Column - Edit Forms --}}
    <div class="col-md-8">

        {{-- Edit Profile Form --}}
        <div class="card mb-4">
            <div class="card-header text-white">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Profile</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('profile.update') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Avatar Upload --}}
                    <div class="mb-3">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" name="avatar" class="form-control"
                               accept="image/*" onchange="previewAvatar(this)">
                        <div id="avatarPreview" class="mt-2 d-none">
                            <img id="previewImg" src="" alt="Preview"
                                 style="width: 80px; height: 80px;
                                        object-fit: cover;
                                        border-radius: 50%;
                                        border: 3px solid #e26d9f;">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select gender</option>
                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control"
                                   value="{{ old('address', $user->address) }}"
                                   placeholder="Enter your address">
                        </div>
                    </div>

                    <hr class="my-4">
                    <p class="fw-bold mb-3" style="color: #e26d9f;">
                        🍦 Ice Cream Preferences
                    </p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Favorite Flavor</label>
                            <select name="ice_cream_preference" class="form-control">
                                <option value="">Select favorite flavor</option>
                                <option value="Choco Mint" {{ $user->ice_cream_preference == 'Choco Mint' ? 'selected' : '' }}>Choco Mint</option>
                                <option value="Strawberry" {{ $user->ice_cream_preference == 'Strawberry' ? 'selected' : '' }}>Strawberry</option>
                                <option value="Cookies and Cream" {{ $user->ice_cream_preference == 'Cookies and Cream' ? 'selected' : '' }}>Cookies and Cream</option>
                                <option value="Honey and Lemon" {{ $user->ice_cream_preference == 'Honey and Lemon' ? 'selected' : '' }}>Honey and Lemon</option>
                                <option value="Vanilla" {{ $user->ice_cream_preference == 'Vanilla' ? 'selected' : '' }}>Vanilla</option>
                                <option value="Dark Chocolate" {{ $user->ice_cream_preference == 'Dark Chocolate' ? 'selected' : '' }}>Dark Chocolate</option>
                                <option value="Matcha" {{ $user->ice_cream_preference == 'Matcha' ? 'selected' : '' }}>Matcha</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Serving Preference</label>
                            <select name="serving_preference" class="form-control">
                                <option value="">Select serving</option>
                                <option value="Cup" {{ $user->serving_preference == 'Cup' ? 'selected' : '' }}>🥤 Cup</option>
                                <option value="Cone" {{ $user->serving_preference == 'Cone' ? 'selected' : '' }}>🍦 Cone</option>
                                <option value="Both" {{ $user->serving_preference == 'Both' ? 'selected' : '' }}>Both</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Topping Preference</label>
                            <input type="text" name="topping_preference" class="form-control"
                                   value="{{ old('topping_preference', $user->topping_preference) }}"
                                   placeholder="e.g. Sprinkles, Chocolate chips, Nuts">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">🌟 Suggest a New Flavor</label>
                            <textarea name="flavor_suggestion" class="form-control" rows="3"
                                      placeholder="e.g. I would love to see Ube Cheesecake flavor!">{{ old('flavor_suggestion', $user->flavor_suggestion) }}</textarea>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-pink">
                            <i class="fas fa-save me-1"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Change Password Form --}}
        <div class="card">
            <div class="card-header text-white">
                <h5 class="mb-0"><i class="fas fa-lock me-2"></i> Change Password</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control"
                               placeholder="Enter current password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Enter new password (min. 6 characters)" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Confirm new password" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-pink">
                            <i class="fas fa-lock me-1"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function previewAvatar(input) {
        const preview = document.getElementById('avatarPreview');
        const img = document.getElementById('previewImg');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection