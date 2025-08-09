@extends('admin.layout')

@section('title', 'Role Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0"><i class="bi bi-award"></i> Role Management</h4>
                    <small class="opacity-75">Manage Discord verification roles</small>
                </div>
                <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                    <i class="bi bi-plus-circle"></i> Create New Role
                </button>
            </div>
            <div class="card-body">
                @if($roles->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Role Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Submissions Count</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>
                                            <strong class="text-primary">{{ $role->name }}</strong>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $role->description ?: 'No description' }}
                                            </small>
                                        </td>
                                        <td>
                                            @if($role->is_active)
                                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Active</span>
                                            @else
                                                <span class="badge bg-secondary"><i class="bi bi-pause-circle"></i> Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $role->submissions->count() }}</span>
                                        </td>
                                        <td>
                                            <small>{{ $role->created_at->format('M d, Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editRoleModal{{ $role->id }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('admin.roles.toggle-status', $role) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-{{ $role->is_active ? 'warning' : 'success' }}">
                                                        <i class="bi bi-{{ $role->is_active ? 'pause' : 'play' }}-circle"></i>
                                                    </button>
                                                </form>
                                                @if($role->submissions->count() == 0)
                                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                onclick="return confirm('Are you sure you want to delete this role?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Role Modal -->
                                    <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Role: {{ $role->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="edit_name{{ $role->id }}" class="form-label">Role Name</label>
                                                            <input type="text" class="form-control" id="edit_name{{ $role->id }}" 
                                                                   name="name" value="{{ $role->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_description{{ $role->id }}" class="form-label">Description</label>
                                                            <textarea class="form-control" id="edit_description{{ $role->id }}" 
                                                                      name="description" rows="3">{{ $role->description }}</textarea>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="edit_is_active{{ $role->id }}" 
                                                                   name="is_active" {{ $role->is_active ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="edit_is_active{{ $role->id }}">
                                                                Active Role
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update Role</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-award display-1 text-muted"></i>
                        <h4 class="text-muted mt-3">No roles created yet</h4>
                        <p class="text-muted">Create your first role to get started with Discord verification.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                            <i class="bi bi-plus-circle"></i> Create First Role
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Create Role Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Create New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               placeholder="Enter role name" required>
                        <div class="form-text">Role name must be unique</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" 
                                  rows="3" placeholder="Describe this role..."></textarea>
                        <div class="form-text">Optional description for this role</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Create Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush