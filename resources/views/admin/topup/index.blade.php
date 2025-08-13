@extends('admin.layout')

@section('title', 'Topup Transactions')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-credit-card me-2"></i>
        Topup Transactions
    </h1>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Transactions</h6>
                        <h3 class="mb-0">{{ $transactions->total() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-credit-card display-6"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Pending Verification</h6>
                        <h3 class="mb-0">{{ $transactions->where('status', 'paid')->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-clock display-6"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Completed</h6>
                        <h3 class="mb-0">{{ $transactions->where('status', 'delivered')->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-check-circle display-6"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Failed/Rejected</h6>
                        <h3 class="mb-0">{{ $transactions->where('status', 'failed')->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-x-circle display-6"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-list me-2"></i>
            All Transactions
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Game</th>
                        <th>Package</th>
                        <th>Player ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                    <tr>
                        <td>
                            <strong>#{{ $transaction->id }}</strong>
                        </td>
                        <td>
                            @if($transaction->user)
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle me-2"></i>
                                    <div>
                                        <div class="fw-bold">{{ $transaction->user->name }}</div>
                                        <small class="text-muted">{{ $transaction->user->email }}</small>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person me-2"></i>
                                    <div>
                                        <div class="fw-bold">{{ $transaction->buyer_name }}</div>
                                        <small class="text-muted">{{ $transaction->buyer_email }}</small>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $transaction->game->name }}</span>
                        </td>
                        <td>
                            <div>
                                <div class="fw-bold">{{ $transaction->topupPackage->name }}</div>
                                <small class="text-muted">
                                    {{ number_format($transaction->topupPackage->amount) }} 
                                    {{ $transaction->game->game_code == 'VALORANT' ? 'VP' : 'Primogems' }}
                                </small>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="fw-bold">{{ $transaction->player_id }}</div>
                                @if($transaction->player_server)
                                    <small class="text-muted">{{ $transaction->player_server }}</small>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-success">
                                Rp {{ number_format($transaction->price, 0, ',', '.') }}
                            </span>
                        </td>
                        <td>
                            @switch($transaction->status)
                                @case('pending')
                                    <span class="badge bg-secondary">Pending</span>
                                    @break
                                @case('paid')
                                    <span class="badge bg-warning">Paid</span>
                                    @break
                                @case('delivered')
                                    <span class="badge bg-success">Delivered</span>
                                    @break
                                @case('failed')
                                    <span class="badge bg-danger">Failed</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">{{ ucfirst($transaction->status) }}</span>
                            @endswitch
                        </td>
                        <td>
                            <div>
                                <div>{{ $transaction->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $transaction->created_at->format('H:i') }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.topup.show', $transaction->id) }}" 
                                   class="btn btn-sm btn-outline-primary" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                
                                @if($transaction->status === 'paid')
                                    <button type="button" class="btn btn-sm btn-outline-success" 
                                            onclick="processTransaction({{ $transaction->id }})" 
                                            title="Process Transaction">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="rejectTransaction({{ $transaction->id }})" 
                                            title="Reject Transaction">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-inbox display-4"></i>
                                <p class="mt-2">No transactions found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($transactions->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Rejection Modal -->
<div class="modal fade" id="rejectionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-x-circle text-danger me-2"></i>
                    Reject Transaction
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="rejectionForm" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-muted">
                        Please provide a reason for rejecting this transaction. This will be sent to the customer via email.
                    </p>
                    <div class="mb-3">
                        <label for="rejection_reason" class="form-label">Rejection Reason</label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" 
                                  rows="4" required placeholder="Enter the reason for rejection..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x-circle me-2"></i>
                        Reject Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Process Confirmation Modal -->
<div class="modal fade" id="processModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Process Transaction
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to process this transaction?</p>
                <p class="text-muted">
                    This will:
                </p>
                <ul class="text-muted">
                    <li>Mark the transaction as delivered</li>
                    <li>Send a confirmation email to the customer</li>
                    <li>Indicate that the topup will be processed within 24 hours</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="processForm" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>
                        Process Transaction
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function processTransaction(transactionId) {
    const modal = new bootstrap.Modal(document.getElementById('processModal'));
    const form = document.getElementById('processForm');
    form.action = `/admin/topup/${transactionId}/process`;
    modal.show();
}

function rejectTransaction(transactionId) {
    const modal = new bootstrap.Modal(document.getElementById('rejectionModal'));
    const form = document.getElementById('rejectionForm');
    form.action = `/admin/topup/${transactionId}/reject`;
    modal.show();
}

// Auto-refresh every 30 seconds for pending transactions
setInterval(function() {
    if (document.querySelector('.badge.bg-warning')) {
        location.reload();
    }
}, 30000);
</script>
@endpush 