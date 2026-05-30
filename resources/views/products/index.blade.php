@extends('layouts.main')

@section('content')

{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color: #4a4a4a;">
            <i class="fas fa-ice-cream me-2" style="color: #e26d9f;"></i> Ice Cream Flavors
        </h4>
        <p class="text-muted small mb-0">Manage your shop's ice cream flavors</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-pink">
        <i class="fas fa-plus me-1"></i> Add Flavor
    </a>
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

{{-- Products Grid --}}
@if($products->isEmpty())
    <div class="text-center py-5">
        <i class="fas fa-ice-cream fa-4x mb-3" style="color: #e26d9f; opacity: 0.4;"></i>
        <h5 class="text-muted">No ice cream flavors yet!</h5>
        <p class="text-muted small">Click "Add Flavor" to add your first flavor 🍦</p>
    </div>
@else
    <div class="row g-4">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card h-100">
                {{-- Product Image --}}
                @if($product->image)
                    <img src="{{ $product->image }}" class="card-img-top"
                         style="height: 200px; object-fit: cover; border-radius: 16px 16px 0 0;"
                         alt="{{ $product->name }}">
                @else
                    <div class="d-flex align-items-center justify-content-center"
                         style="height: 200px; background-color: #ffeef4; border-radius: 16px 16px 0 0;">
                        <i class="fas fa-ice-cream fa-4x" style="color: #e26d9f; opacity: 0.4;"></i>
                    </div>
                @endif

                <div class="card-body">
                    <h5 class="fw-bold mb-1" style="color: #4a4a4a;">{{ $product->name }}</h5>
                    <p class="mb-2" style="color: #e26d9f; font-weight: 600;">
                        ₱{{ number_format($product->price, 2) }}
                    </p>
                    <p class="mb-2 small">
    <i class="fas fa-box me-1" style="color: #B7D3B0;"></i>
    <span style="color: #4a4a4a;">Stock:</span>
    <span class="fw-bold" style="color: #B7D3B0;">{{ $product->stock }}</span>
</p>
                    <p class="text-muted small mb-3">{{ $product->description }}</p>

                    <div class="d-flex gap-2">
                        <a href="{{ route('products.edit', $product->id) }}"
   class="btn btn-sm flex-fill"
   style="background-color: #f4b183; color: white; border-radius: 20px;">
    <i class="fas fa-edit"></i> Edit
</a>
<button type="button" class="btn btn-sm flex-fill"
        style="background-color: #d96b7b; color: white; border-radius: 20px;"
                                onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>

                        <form id="delete-form-{{ $product->id }}"
                              action="{{ route('products.destroy', $product->id) }}"
                              method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

{{-- Cute Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header text-white text-center d-block"
                 style="background-color: #e26d9f; border-radius: 16px 16px 0 0;">
                <h5 class="modal-title w-100">🍦 Delete Flavor</h5>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-exclamation-circle fa-3x mb-3" style="color: #e26d9f;"></i>
                <p class="mb-1" style="color: #4a4a4a;">Are you sure you want to delete</p>
                <h5 class="fw-bold" id="deleteProductName" style="color: #e26d9f;"></h5>
                <p class="text-muted small mb-0">This action cannot be undone!</p>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4">
                <button type="button" class="btn btn-pink px-4"
                        onclick="submitDelete()">
                    <i class="fas fa-trash me-1"></i> Yes, Delete
                </button>
                <button type="button" class="btn px-4"
                        style="background-color: #f0f0f0; color: #4a4a4a; border-radius: 25px;"
                        data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteId = null;

    function confirmDelete(id, name) {
        deleteId = id;
        document.getElementById('deleteProductName').textContent = name;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    function submitDelete() {
        if (deleteId) {
            document.getElementById('delete-form-' + deleteId).submit();
        }
    }
</script>

@endsection