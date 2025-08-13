@extends('admin.layout')

@section('title', 'Manage Topup Packages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manage Topup Packages</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPackageModal">
        <i class="bi bi-plus-circle me-2"></i>
        Add New Package
    </button>
</div>

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

<!-- Game Filter -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label for="gameFilter" class="form-label">Filter by Game</label>
                <select class="form-select" id="gameFilter">
                    <option value="">All Games</option>
                    @foreach($games as $game)
                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="searchPackage" class="form-label">Search Package</label>
                <input type="text" class="form-control" id="searchPackage" placeholder="Search package name...">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="button" class="btn btn-outline-secondary" onclick="resetFilters()">
                    <i class="bi bi-arrow-clockwise me-2"></i>
                    Reset Filters
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Packages Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-box me-2"></i>
            All Packages
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game</th>
                        <th>Package Name</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="packagesTableBody">
                    @forelse($packages as $package)
                    <tr data-game-id="{{ $package->game_id }}" data-package-name="{{ strtolower($package->name) }}">
                        <td>
                            <strong>#{{ $package->id }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $package->game->name }}</span>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $package->name }}</div>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ number_format($package->amount) }}</span>
                        </td>
                        <td>
                            <span class="fw-bold text-success">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $package->is_active ? 'success' : 'secondary' }}">
                                {{ $package->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div>
                                <div>{{ $package->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $package->created_at->format('H:i') }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="editPackage({{ $package->id }})" 
                                        title="Edit Package">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-{{ $package->is_active ? 'warning' : 'success' }}" 
                                        onclick="togglePackageStatus({{ $package->id }}, {{ $package->is_active ? 'false' : 'true' }})" 
                                        title="{{ $package->is_active ? 'Deactivate' : 'Activate' }}">
                                    <i class="bi bi-{{ $package->is_active ? 'pause' : 'play' }}"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="deletePackage({{ $package->id }})" 
                                        title="Delete Package">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-inbox display-4"></i>
                                <p class="mt-2">No packages found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($packages->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $packages->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Add Package Modal -->
<div class="modal fade" id="addPackageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-plus-circle text-primary me-2"></i>
                    Add New Package
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.topup.packages.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="game_id" class="form-label">Game</label>
                        <select class="form-select" name="game_id" required>
                            <option value="">Select a game</option>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="e.g., 100 VP, 500 Diamonds">
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" required placeholder="e.g., 100, 500, 1000">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (Rp)</label>
                        <input type="number" class="form-control" name="price" required placeholder="e.g., 25000, 50000">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active Package
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add Package
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Package Modal -->
<div class="modal fade" id="editPackageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-pencil text-primary me-2"></i>
                    Edit Package
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPackageForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_game_id" class="form-label">Game</label>
                        <select class="form-select" name="game_id" id="edit_game_id" required>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" id="edit_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" id="edit_amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Price (Rp)</label>
                        <input type="number" class="form-control" name="price" id="edit_price" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active">
                            <label class="form-check-label" for="edit_is_active">
                                Active Package
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>
                        Update Package
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deletePackageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                    Delete Package
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this package?</p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deletePackageForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i>
                        Delete Package
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Filter functionality
document.getElementById('gameFilter').addEventListener('change', filterPackages);
document.getElementById('searchPackage').addEventListener('input', filterPackages);

function filterPackages() {
    const gameFilter = document.getElementById('gameFilter').value;
    const searchTerm = document.getElementById('searchPackage').value.toLowerCase();
    const rows = document.querySelectorAll('#packagesTableBody tr');
    
    rows.forEach(row => {
        const gameId = row.dataset.gameId;
        const packageName = row.dataset.packageName;
        
        const gameMatch = !gameFilter || gameId === gameFilter;
        const searchMatch = !searchTerm || packageName.includes(searchTerm);
        
        row.style.display = gameMatch && searchMatch ? '' : 'none';
    });
}

function resetFilters() {
    document.getElementById('gameFilter').value = '';
    document.getElementById('searchPackage').value = '';
    filterPackages();
}

// Edit package
function editPackage(packageId) {
    fetch(`/admin/topup/packages/${packageId}/edit`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const package = data.package;
                document.getElementById('edit_game_id').value = package.game_id;
                document.getElementById('edit_name').value = package.name;
                document.getElementById('edit_amount').value = package.amount;
                document.getElementById('edit_price').value = package.price;
                document.getElementById('edit_is_active').checked = package.is_active;
                
                document.getElementById('editPackageForm').action = `/admin/topup/packages/${packageId}`;
                
                const modal = new bootstrap.Modal(document.getElementById('editPackageModal'));
                modal.show();
            }
        })
        .catch(error => {
            console.error('Error fetching package details:', error);
            alert('Failed to load package details.');
        });
}

// Toggle package status
function togglePackageStatus(packageId, newStatus) {
    if (confirm('Are you sure you want to change this package status?')) {
        fetch(`/admin/topup/packages/${packageId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ is_active: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to update package status.');
            }
        })
        .catch(error => {
            console.error('Error updating package status:', error);
            alert('Failed to update package status.');
        });
    }
}

// Delete package
function deletePackage(packageId) {
    const modal = new bootstrap.Modal(document.getElementById('deletePackageModal'));
    document.getElementById('deletePackageForm').action = `/admin/topup/packages/${packageId}`;
    modal.show();
}
</script>
@endpush 