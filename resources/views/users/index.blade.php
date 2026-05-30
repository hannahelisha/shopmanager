@extends('layouts.main')

@section('content')

{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color: #4a4a4a;">
            <i class="fas fa-users me-2" style="color: #e26d9f;"></i> User Management
        </h4>
        <p class="text-muted small mb-0">Manage all users in your system</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-pink">
        <i class="fas fa-user-plus me-1"></i> Add User
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

{{-- Users Table --}}
<div class="card">
    <div class="card-header text-white">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i> Users List</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background-color: #ffeef4;">
                    <tr>
                        <th style="color: #4a4a4a;">#</th>
                        <th style="color: #4a4a4a;">Name</th>
                        <th style="color: #4a4a4a;">Email</th>
                        <th style="color: #4a4a4a;">Created Date</th>
                        <th style="color: #4a4a4a;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <i class="fas fa-user me-1" style="color: #e26d9f;"></i>
                            {{ $user->name }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}"
   class="btn btn-sm me-1"
   style="background-color: #f4b183; color: white; border-radius: 20px;">
    <i class="fas fa-edit"></i> Edit
</a>
                            {{-- Delete Button triggers Modal --}}
                            <button type="button" class="btn btn-sm"
        style="background-color: #d96b7b; color: white; border-radius: 20px;"
                                    onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                <i class="fas fa-trash"></i> Delete
                            </button>

                            {{-- Hidden Delete Form --}}
                            <form id="delete-form-{{ $user->id }}"
                                  action="{{ route('users.destroy', $user->id) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="fas fa-users fa-2x mb-2 d-block" style="color: #e26d9f;"></i>
                            No users found!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Cute Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none;">
            <div class="modal-header text-white text-center d-block"
                 style="background-color: #e26d9f; border-radius: 16px 16px 0 0;">
                <h5 class="modal-title w-100">
                    🍦 Delete User
                </h5>
            </div>
            <div class="modal-body text-center py-4">
                <i class="fas fa-exclamation-circle fa-3x mb-3" style="color: #e26d9f;"></i>
                <p class="mb-1" style="color: #4a4a4a;">Are you sure you want to delete</p>
                <h5 class="fw-bold" id="deleteUserName" style="color: #e26d9f;"></h5>
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
        document.getElementById('deleteUserName').textContent = name;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    function submitDelete() {
        if (deleteId) {
            document.getElementById('delete-form-' + deleteId).submit();
        }
    }
</script>

@endsection