@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="bi bi-credit-card me-2"></i>Payment Method Management
        </h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal">
            <i class="bi bi-plus-circle me-2"></i>Add New Payment Method
        </button>
    </div>

    <!-- Payment Methods List -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Payment Methods</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="paymentMethodsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paymentMethods as $method)
                        <tr>
                            <td>{{ $method->id }}</td>
                            <td>
                                <strong>{{ $method->name }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-{{ $method->type === 'qris' ? 'success' : 'info' }}">
                                    {{ strtoupper($method->type) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                            <td>{{ $method->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary" 
                                            onclick="editPaymentMethod({{ $method->id }}, '{{ $method->name }}', '{{ $method->type }}')"
                                            data-bs-toggle="modal" data-bs-target="#editPaymentMethodModal">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="deletePaymentMethod({{ $method->id }}, '{{ $method->name }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Payment Method Modal -->
<div class="modal fade" id="addPaymentMethodModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.topup.payment-methods.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Payment Method Name</label>
                        <input type="text" class="form-control" name="name" placeholder="e.g., QRIS, GoPay, OVO" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-select" name="type" required>
                            <option value="">Select Type</option>
                            <option value="qris">QRIS</option>
                            <option value="bank">Bank Transfer</option>
                            <option value="ewallet">E-Wallet</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Payment Method</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Payment Method Modal -->
<div class="modal fade" id="editPaymentMethodModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPaymentMethodForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Payment Method Name</label>
                        <input type="text" class="form-control" name="name" id="editPaymentMethodName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-select" name="type" id="editPaymentMethodType" required>
                            <option value="">Select Type</option>
                            <option value="qris">QRIS</option>
                            <option value="bank">Bank Transfer</option>
                            <option value="ewallet">E-Wallet</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Payment Method</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editPaymentMethod(id, name, type) {
    document.getElementById('editPaymentMethodName').value = name;
    document.getElementById('editPaymentMethodType').value = type;
    document.getElementById('editPaymentMethodForm').action = `/admin/topup/payment-methods/${id}`;
}

function deletePaymentMethod(id, name) {
    if (confirm(`Are you sure you want to delete "${name}"?`)) {
        fetch(`/admin/topup/payment-methods/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}
</script>
@endsection 