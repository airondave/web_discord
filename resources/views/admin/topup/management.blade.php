@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="bi bi-credit-card me-2"></i>Topup Management
        </h1>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="managementTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="games-tab" data-bs-toggle="tab" data-bs-target="#games" type="button" role="tab">
                <i class="bi bi-controller me-2"></i>Games
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="packages-tab" data-bs-toggle="tab" data-bs-target="#packages" type="button" role="tab">
                <i class="bi bi-box me-2"></i>Packages
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="payment-methods-tab" data-bs-toggle="tab" data-bs-target="#payment-methods" type="button" role="tab">
                <i class="bi bi-credit-card me-2"></i>Payment Methods
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="managementTabsContent">
        <!-- Games Tab -->
        <div class="tab-pane fade show active" id="games" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Game Management</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addGameModal">
                    <i class="bi bi-plus-circle me-2"></i>Add New Game
                </button>
            </div>
            
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Publisher</th>
                                    <th>Packages</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($games as $game)
                                <tr>
                                    <td>{{ $game->id }}</td>
                                    <td><strong>{{ $game->name }}</strong></td>
                                    <td>{{ $game->publisher }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $game->topupPackages->count() }}</span>
                                    </td>
                                    <td>{{ $game->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" onclick="editGame({{ $game->id }}, '{{ $game->name }}', '{{ $game->publisher }}')" data-bs-toggle="modal" data-bs-target="#editGameModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-success" onclick="manageGamePackages({{ $game->id }}, '{{ $game->name }}')" data-bs-toggle="modal" data-bs-target="#managePackagesModal">
                                                <i class="bi bi-box"></i>
                                            </button>
                                            <button class="btn btn-outline-danger" onclick="deleteGame({{ $game->id }}, '{{ $game->name }}')">
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

        <!-- Packages Tab -->
        <div class="tab-pane fade" id="packages" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Package Management</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPackageModal">
                    <i class="bi bi-plus-circle me-2"></i>Add New Package
                </button>
            </div>
            
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Package Name</th>
                                    <th>Game</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $package)
                                <tr>
                                    <td>{{ $package->id }}</td>
                                    <td><strong>{{ $package->name }}</strong></td>
                                    <td>{{ $package->game->name }}</td>
                                    <td>{{ $package->amount }}</td>
                                    <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" onclick="editPackage({{ $package->id }}, '{{ $package->name }}', {{ $package->amount }}, {{ $package->price }}, {{ $package->game_id }})" data-bs-toggle="modal" data-bs-target="#editPackageModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger" onclick="deletePackage({{ $package->id }}, '{{ $package->name }}')">
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

        <!-- Payment Methods Tab -->
        <div class="tab-pane fade" id="payment-methods" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Payment Method Management</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPaymentMethodModal">
                    <i class="bi bi-plus-circle me-2"></i>Add New Payment Method
                </button>
            </div>
            
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentMethods as $method)
                                <tr>
                                    <td>{{ $method->id }}</td>
                                    <td><strong>{{ $method->name }}</strong></td>
                                    <td><span class="badge bg-secondary">{{ $method->type }}</span></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" onclick="editPaymentMethod({{ $method->id }}, '{{ $method->name }}', '{{ $method->type }}')" data-bs-toggle="modal" data-bs-target="#editPaymentMethodModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger" onclick="deletePaymentMethod({{ $method->id }}, '{{ $method->name }}')">
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
    </div>
</div>

<!-- Add Game Modal -->
<div class="modal fade" id="addGameModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.topup.management.storeGame') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Game Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Publisher</label>
                        <input type="text" class="form-control" name="publisher" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Game</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Game Modal -->
<div class="modal fade" id="editGameModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editGameForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Game Name</label>
                        <input type="text" class="form-control" name="name" id="editGameName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Publisher</label>
                        <input type="text" class="form-control" name="publisher" id="editGamePublisher" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Game</button>
                </div>
            </form>
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
            <form action="{{ route('admin.topup.management.storePackage') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Game</label>
                        <select class="form-control" name="game_id" required>
                            <option value="">Select Game</option>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price (Rp)</label>
                        <input type="number" class="form-control" name="price" required>
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
                        <label class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" id="editPackageName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Game</label>
                        <select class="form-control" name="game_id" id="editPackageGame" required>
                            @foreach($games as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" id="editPackageAmount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price (Rp)</label>
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

<!-- Add Payment Method Modal -->
<div class="modal fade" id="addPaymentMethodModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.topup.management.storePaymentMethod') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-control" name="type" required>
                            <option value="qris">QRIS</option>
                            <option value="bank">Bank Transfer</option>
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
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="editPaymentMethodName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-control" name="type" id="editPaymentMethodType" required>
                            <option value="qris">QRIS</option>
                            <option value="bank">Bank Transfer</option>
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

<!-- Manage Packages Modal -->
<div class="modal fade" id="managePackagesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Packages for <span id="manageGameName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6>Current Packages</h6>
                    <button type="button" class="btn btn-success btn-sm" onclick="addPackageRow()">
                        <i class="bi bi-plus-circle me-2"></i>Add Package
                    </button>
                </div>
                <div id="packagesContainer">
                    <!-- Packages will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePackages()">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
// Game Management Functions
function editGame(id, name, publisher) {
    document.getElementById('editGameName').value = name;
    document.getElementById('editGamePublisher').value = publisher;
    document.getElementById('editGameForm').action = `/admin/topup/management/games/${id}`;
}

function deleteGame(id, name) {
    if (confirm(`Are you sure you want to delete "${name}"? This will also delete all associated packages.`)) {
        fetch(`/admin/topup/management/games/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            location.reload();
        });
    }
}

// Package Management Functions
function editPackage(id, name, amount, price, gameId) {
    document.getElementById('editPackageName').value = name;
    document.getElementById('editPackageAmount').value = amount;
    document.getElementById('editPackagePrice').value = price;
    document.getElementById('editPackageGame').value = gameId;
    document.getElementById('editPackageForm').action = `/admin/topup/management/packages/${id}`;
}

function deletePackage(id, name) {
    if (confirm(`Are you sure you want to delete package "${name}"?`)) {
        fetch(`/admin/topup/management/packages/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            location.reload();
        });
    }
}

// Payment Method Management Functions
function editPaymentMethod(id, name, type) {
    document.getElementById('editPaymentMethodName').value = name;
    document.getElementById('editPaymentMethodType').value = type;
    document.getElementById('editPaymentMethodForm').action = `/admin/topup/management/payment-methods/${id}`;
}

function deletePaymentMethod(id, name) {
    if (confirm(`Are you sure you want to delete payment method "${name}"?`)) {
        fetch(`/admin/topup/management/payment-methods/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            location.reload();
        });
    }
}

// Package Management for Games
function manageGamePackages(gameId, gameName) {
    document.getElementById('manageGameName').textContent = gameName;
    document.getElementById('managePackagesModal').dataset.gameId = gameId;
    
    fetch(`/admin/topup/management/games/${gameId}/packages`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('packagesContainer');
            container.innerHTML = '';
            
            data.packages.forEach(package => {
                addPackageRow(package);
            });
        });
}

function addPackageRow(package = null) {
    const container = document.getElementById('packagesContainer');
    const packageId = package ? package.id : 'new_' + Date.now();
    
    const row = document.createElement('div');
    row.className = 'row mb-2 package-row';
    row.dataset.packageId = packageId;
    
    row.innerHTML = `
        <div class="col-md-4">
            <input type="text" class="form-control form-control-sm" name="packages[${packageId}][name]" 
                   placeholder="Package Name" value="${package ? package.name : ''}" required>
        </div>
        <div class="col-md-3">
            <input type="number" class="form-control form-control-sm" name="packages[${packageId}][amount]" 
                   placeholder="Amount" value="${package ? package.amount : ''}" required>
        </div>
        <div class="col-md-3">
            <input type="number" class="form-control form-control-sm" name="packages[${packageId}][price]" 
                   placeholder="Price" value="${package ? package.price : ''}" required>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger btn-sm" onclick="removePackageRow(this)">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `;
    
    container.appendChild(row);
}

function removePackageRow(button) {
    button.closest('.package-row').remove();
}

function savePackages() {
    const gameId = document.querySelector('#managePackagesModal').dataset.gameId;
    const formData = new FormData();
    
    document.querySelectorAll('.package-row').forEach(row => {
        const packageId = row.dataset.packageId;
        const name = row.querySelector('input[name*="[name]"]').value;
        const amount = row.querySelector('input[name*="[amount]"]').value;
        const price = row.querySelector('input[name*="[price]"]').value;
        
        if (name && amount && price) {
            formData.append(`packages[${packageId}][name]`, name);
            formData.append(`packages[${packageId}][amount]`, amount);
            formData.append(`packages[${packageId}][price]`, price);
        }
    });
    
    fetch(`/admin/topup/management/games/${gameId}/packages`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    }).then(() => {
        location.reload();
    });
}
</script>
@endsection 