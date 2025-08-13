@extends('admin.layout')

@section('title', 'Manage Topup Packages')

@push('styles')
<style>
/* Fix for large chevron arrows and lines */
.pagination .page-link {
    font-size: 14px !important;
    padding: 0.375rem 0.75rem !important;
}

.pagination .page-link .bi {
    font-size: 14px !important;
}

/* Ensure table content is properly displayed */
.table tbody tr {
    display: table-row !important;
}

/* Fix any oversized icons */
.bi {
    font-size: inherit !important;
}

/* Remove any large display classes that might be causing issues */
.display-4 {
    font-size: 2.5rem !important;
}

/* Ensure proper table layout */
.table-responsive {
    overflow-x: auto;
}

/* Fix pagination spacing */
.pagination {
    margin-bottom: 0;
}

/* Ensure no large elements appear in table */
.card-body .table {
    position: relative;
}

.card-body .table::before,
.card-body .table::after {
    display: none !important;
}

/* Fix any potential large chevron or arrow elements */
.card-body .table > *:not(tbody):not(thead):not(tfoot) {
    display: none !important;
}

/* Ensure table body is properly displayed */
#packagesTableBody {
    display: table-row-group !important;
}

#packagesTableBody tr {
    display: table-row !important;
}

/* Remove any large display elements */
.display-1, .display-2, .display-3, .display-4, .display-5, .display-6 {
    font-size: 1rem !important;
}

/* Fix any oversized Bootstrap icons */
.bi-chevron-left, .bi-chevron-right {
    font-size: 14px !important;
}

/* Ensure proper table structure */
.table {
    table-layout: auto;
    width: 100%;
}

.table tbody {
    display: table-row-group;
}

.table tbody tr {
    display: table-row;
}

.table tbody td {
    display: table-cell;
}

/* Debug: Hide any extremely large elements */
* {
    max-width: 100vw !important;
    max-height: 100vh !important;
}

/* Ensure no elements are larger than the viewport */
.card-body * {
    max-width: 100% !important;
    max-height: 500px !important;
}

/* Fix any potential carousel or navigation elements */
.carousel, .carousel-inner, .carousel-item {
    display: none !important;
}

/* Remove any large arrows or chevrons */
.arrow, .chevron, .carousel-control {
    display: none !important;
}

/* Search form styling */
#filterForm .form-control:focus,
#filterForm .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

/* Search results info */
.alert-info {
    border-left: 4px solid #0d6efd;
}

/* Auto-submit indicator */
.searching {
    opacity: 0.7;
    pointer-events: none;
}
</style>
@endpush

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
        <form method="GET" action="{{ route('admin.topup.packages') }}" id="filterForm">
            <div class="row">
                <div class="col-md-4">
                    <label for="game" class="form-label">Filter by Game</label>
                    <select class="form-select" name="game" id="gameFilter">
                        <option value="">All Games</option>
                        @foreach($games as $game)
                            <option value="{{ $game->id }}" {{ request('game') == $game->id ? 'selected' : '' }}>
                                {{ $game->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="search" class="form-label">Search Package</label>
                    <input type="text" class="form-control" name="search" id="searchPackage" 
                           placeholder="Search package name..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search me-2"></i>
                        Search
                    </button>
                    <a href="{{ route('admin.topup.packages') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise me-2"></i>
                        Reset Filters
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Search Results Info -->
@if(request('search') || request('game'))
    <div class="alert alert-info mb-3">
        <i class="bi bi-info-circle me-2"></i>
        <strong>Search Results:</strong>
        @if(request('search'))
            Searching for packages containing "<strong>{{ request('search') }}</strong>"
        @endif
        @if(request('search') && request('game'))
            and
        @endif
        @if(request('game'))
            filtered by game "<strong>{{ $games->find(request('game'))->name ?? 'Unknown' }}</strong>"
        @endif
        <a href="{{ route('admin.topup.packages') }}" class="btn btn-sm btn-outline-secondary ms-3">
            <i class="bi bi-x-circle me-1"></i>
            Clear All Filters
        </a>
    </div>
@endif

<!-- Packages Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-box me-2"></i>
            All Packages
            @if(request('search') || request('game'))
                <small class="text-muted">(Filtered Results)</small>
            @endif
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
                                <i class="bi bi-inbox" style="font-size: 2rem;"></i>
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
                <nav aria-label="Packages pagination">
                    <ul class="pagination pagination-sm">
                        {{-- Previous Page Link --}}
                        @if ($packages->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $packages->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($packages->getUrlRange(1, $packages->lastPage()) as $page => $url)
                            @if ($page == $packages->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($packages->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $packages->nextPageUrl() }}" rel="next">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </nav>
                
                <div class="text-center mt-2">
                    <small class="text-muted">
                        Showing {{ $packages->firstItem() ?? 0 }} to {{ $packages->lastItem() ?? 0 }} of {{ $packages->total() }} results
                        @if(request('search') || request('game'))
                            <br><span class="text-info">(Filtered from total packages)</span>
                        @endif
                    </small>
                </div>
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
// Auto-submit form when filters change
document.getElementById('gameFilter').addEventListener('change', function() {
    document.getElementById('filterForm').submit();
});

// Auto-submit form when search is entered (with delay for better UX)
let searchTimeout;
document.getElementById('searchPackage').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        // Add loading indicator
        document.getElementById('filterForm').classList.add('searching');
        document.getElementById('filterForm').submit();
    }, 500); // 500ms delay to avoid too many requests
});

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