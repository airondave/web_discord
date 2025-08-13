@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="bi bi-box me-2"></i>Package Management
        </h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPackageModal">
            <i class="bi bi-plus-circle me-2"></i>Add New Package
        </button>
    </div>

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Packages</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Filter by Game</label>
                    <select class="form-select" id="gameFilter">
                        <option value="">All Games</option>
                        @foreach($games as $game)
                            <option value="{{ $game->id }}">{{ $game->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Search Package</label>
                    <input type="text" class="form-control" id="packageSearch" placeholder="Search packages...">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Price Range</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="minPrice" placeholder="Min">
                        <span class="input-group-text">-</span>
                        <input type="number" class="form-control" id="maxPrice" placeholder="Max">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Packages List -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Packages</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="packagesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Package Name</th>
                            <th>Game</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($packages as $package)
                        <tr data-game-id="{{ $package->game_id }}" data-price="{{ $package->price }}">
                            <td>{{ $package->id }}</td>
                            <td>
                                <strong>{{ $package->name }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $package->game->name }}</span>
                            </td>
                            <td>{{ $package->amount }}</td>
                            <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td>{{ $package->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary" 
                                            onclick="editPackage({{ $package->id }}, '{{ $package->name }}', {{ $package->amount }}, {{ $package->price }}, {{ $package->game_id }})"
                                            data-bs-toggle="modal" data-bs-target="#editPackageModal">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="deletePackage({{ $package->id }}, '{{ $package->name }}')">
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

<!-- Add Package Modal -->
<div class="modal fade" id="addPackageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.topup.packages.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Game</label>
                        <select class="form-select" name="game_id" required>
                            <option value="">Select Game</option>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" placeholder="e.g., 100 Diamonds" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" placeholder="e.g., 100" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price (IDR)</label>
                        <input type="number" class="form-control" name="price" placeholder="e.g., 25000" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Package</button>
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
                <h5 class="modal-title">Edit Package</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPackageForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Game</label>
                        <select class="form-select" name="game_id" id="editPackageGame" required>
                            <option value="">Select Game</option>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" id="editPackageName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" id="editPackageAmount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price (IDR)</label>
                        <input type="number" class="form-control" name="price" id="editPackagePrice" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Package</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Filter functionality
document.getElementById('gameFilter').addEventListener('change', filterPackages);
document.getElementById('packageSearch').addEventListener('input', filterPackages);
document.getElementById('minPrice').addEventListener('input', filterPackages);
document.getElementById('maxPrice').addEventListener('input', filterPackages);

function filterPackages() {
    const gameFilter = document.getElementById('gameFilter').value;
    const searchTerm = document.getElementById('packageSearch').value.toLowerCase();
    const minPrice = document.getElementById('minPrice').value;
    const maxPrice = document.getElementById('maxPrice').value;
    
    const rows = document.querySelectorAll('#packagesTable tbody tr');
    
    rows.forEach(row => {
        const gameId = row.dataset.gameId;
        const price = parseInt(row.dataset.price);
        const packageName = row.cells[1].textContent.toLowerCase();
        const gameName = row.cells[2].textContent.toLowerCase();
        
        let show = true;
        
        // Game filter
        if (gameFilter && gameId !== gameFilter) {
            show = false;
        }
        
        // Search filter
        if (searchTerm && !packageName.includes(searchTerm) && !gameName.includes(searchTerm)) {
            show = false;
        }
        
        // Price filter
        if (minPrice && price < parseInt(minPrice)) {
            show = false;
        }
        if (maxPrice && price > parseInt(maxPrice)) {
            show = false;
        }
        
        row.style.display = show ? '' : 'none';
    });
}

function editPackage(id, name, amount, price, gameId) {
    document.getElementById('editPackageName').value = name;
    document.getElementById('editPackageAmount').value = amount;
    document.getElementById('editPackagePrice').value = price;
    document.getElementById('editPackageGame').value = gameId;
    document.getElementById('editPackageForm').action = `/admin/topup/packages/${id}`;
}

function deletePackage(id, name) {
    if (confirm(`Are you sure you want to delete "${name}"?`)) {
        fetch(`/admin/topup/packages/${id}`, {
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