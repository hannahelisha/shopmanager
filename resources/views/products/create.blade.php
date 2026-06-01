@extends('layouts.main')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color: #4a4a4a;">
            <i class="fas fa-plus me-2" style="color: #e26d9f;"></i> Add Ice Cream Flavor
        </h4>
        <p class="text-muted small mb-0">Add a new flavor to your shop</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-pink">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header text-white text-center">
                <h5><i class="fas fa-ice-cream me-2"></i> Flavor Information</h5>
            </div>
            <div class="card-body p-4">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Flavor Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name') }}"
                               placeholder="e.g. Choco Mint" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price (₱)</label>
                        <input type="number" name="price" class="form-control"
                               value="{{ old('price') }}"
                               placeholder="e.g. 99.00" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" name="stock" class="form-control"
                        value="{{ old('stock') }}"
                        placeholder="e.g. 50" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"
                                  placeholder="e.g. Rich chocolate with cool mint flavor">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="url" name="image" class="form-control"
                               value="{{ old('image') }}"
                               placeholder="https://example.com/image.jpg"
                               id="imageUrl" oninput="previewImage()">
                    </div>

                    <div id="imagePreview" class="mb-3 text-center d-none">
                        <p class="text-muted small mb-1">Image Preview:</p>
                        <img id="previewImg" src="" alt="Preview"
                             style="height: 150px; object-fit: cover;
                                    border-radius: 12px;
                                    box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-pink">
                            <i class="fas fa-plus me-1"></i> Add Flavor
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const url = document.getElementById('imageUrl').value;
        const preview = document.getElementById('imagePreview');
        const img = document.getElementById('previewImg');

        if (url) {
            img.src = url;
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }
    }
</script>

@endsection