@extends('admin.layout')

@section('title', 'Manage Admins')

@push('styles')
<style>
    /* Additional dark mode styles for admin index page */
    .card-header.bg-warning {
        background: var(--bg-secondary) !important;
        color: var(--text-primary) !important;
        border-bottom: 1px solid var(--border-color);
    }
    
    .badge {
        font-size: 0.8rem;
        padding: 0.4rem 0.6rem;
    }
    
    .btn-group .btn {
        margin: 0 2px;
    }
    
    .text-muted {
        color: var(--text-secondary) !important;
    }
    
    /* Ensure proper contrast for badges in dark mode */
    [data-bs-theme="dark"] .badge.bg-success {
        background-color: #198754 !important;
        color: #ffffff !important;
    }
    
    [data-bs-theme="dark"] .badge.bg-secondary {
        background-color: #6c757d !important;
        color: #ffffff !important;
    }
    
    [data-bs-theme="dark"] .badge.bg-info {
        background-color: #0dcaf0 !important;
        color: #000000 !important;
    }
    
    /* Button hover effects for dark mode */
    [data-bs-theme="dark"] .btn-outline-warning:hover {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #000000;
    }
    
    [data-bs-theme="dark"] .btn-outline-success:hover {
        background-color: #198754;
        border-color: #198754;
        color: #ffffff;
    }
    
    [data-bs-theme="dark"] .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0"><i class="bi bi-people-fill"></i> Manage Admin Users</h4>
                    <small>Manage administrator accounts and permissions</small>
                </div>
                <a href="{{ route('admin.create-admin') }}" class="btn btn-dark btn-sm">
                    <i class="bi bi-plus-circle"></i> Create New Admin
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>
                                        <strong>{{ $admin->username }}</strong>
                                        @if($admin->id === Auth::guard('admin')->id())
                                            <span class="badge bg-info ms-2">You</span>
                                        @endif
                                    </td>
                                    <td>{{ $admin->name }}</td>
                                    <td>
                                        @if($admin->is_active)
                                            <span class="badge bg-success"><i class="bi bi-check-circle"></i> Active</span>
                                        @else
                                            <span class="badge bg-secondary"><i class="bi bi-pause-circle"></i> Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>{{ $admin->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td>
                                        @if($admin->id !== Auth::guard('admin')->id())
                                            <div class="btn-group" role="group">
                                                <form action="{{ route('admin.toggle-admin', $admin) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $admin->is_active ? 'warning' : 'success' }}"
                                                            onclick="return confirm('Are you sure you want to {{ $admin->is_active ? 'deactivate' : 'activate' }} this admin?')">
                                                        <i class="bi bi-{{ $admin->is_active ? 'pause' : 'play' }}-circle"></i>
                                                        {{ $admin->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.delete-admin', $admin) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                            onclick="return confirm('Are you sure you want to delete this admin? This action cannot be undone.')">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-muted">
                                                <i class="bi bi-shield-lock"></i> Current User
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection