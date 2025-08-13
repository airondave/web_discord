@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="bi bi-controller me-2"></i>Game Management
        </h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGameModal">
            <i class="bi bi-plus-circle me-2"></i>Add New Game
        </button>
    </div>

    <!-- Games List -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Games</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="gamesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Publisher</th>
                            <th>Packages Count</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $game)
                        <tr>
                            <td>{{ $game->id }}</td>
                            <td>
                                <strong>{{ $game->name }}</strong>
                            </td>
                            <td>{{ $game->publisher }}</td>
                            <td>
                                <span class="badge bg-info">{{ $game->topupPackages->count() }}</span>
                            </td>
                            <td>{{ $game->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary" 
                                            onclick="editGame({{ $game->id }}, '{{ $game->name }}', '{{ $game->publisher }}')"
                                            data-bs-toggle="modal" data-bs-target="#editGameModal">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" 
                                            onclick="managePackages({{ $game->id }}, '{{ $game->name }}')"
                                            data-bs-toggle="modal" data-bs-target="#managePackagesModal">
                                        <i class="bi bi-box"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="deleteGame({{ $game->id }}, '{{ $game->name }}')">
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

<!-- Add Game Modal -->
<div class="modal fade" id="addGameModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.topup.games.store') }}" method="POST">
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

<!-- Manage Packages Modal -->
<div class="modal fade" id="managePackagesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Packages for <span id="gameNameTitle"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6>Current Packages</h6>
                    <button class="btn btn-sm btn-primary" onclick="addPackageRow()">
                        <i class="bi bi-plus-circle me-1"></i>Add Package
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
function editGame(id, name, publisher) {
    document.getElementById('editGameName').value = name;
    document.getElementById('editGamePublisher').value = publisher;
    document.getElementById('editGameForm').action = `/admin/topup/games/${id}`;
}

function deleteGame(id, name) {
    if (confirm(`Are you sure you want to delete "${name}"? This will also delete all associated packages.`)) {
        fetch(`/admin/topup/games/${id}`, {
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

function managePackages(gameId, gameName) {
    document.getElementById('gameNameTitle').textContent = gameName;
    
    // Load packages for this game
    fetch(`/admin/topup/games/${gameId}/packages`)
        .then(response => response.json())
        .then(packages => {
            const container = document.getElementById('packagesContainer');
            container.innerHTML = '';
            
            packages.forEach(package => {
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
            <input type="text" class="form-control" name="packages[${packageId}][name]" 
                   placeholder="Package Name" value="${package ? package.name : ''}" required>
        </div>
        <div class="col-md-3">
            <input type="number" class="form-control" name="packages[${packageId}][amount]" 
                   placeholder="Amount" value="${package ? package.amount : ''}" required>
        </div>
        <div class="col-md-3">
            <input type="number" class="form-control" name="packages[${packageId}][price]" 
                   placeholder="Price" value="${package ? package.price : ''}" required>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-sm btn-danger" onclick="removePackageRow(this)">
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
    // Implementation for saving packages
    alert('Package saving functionality will be implemented in the controller');
}
</script>
@endsection 