@extends('admin.layout')

@section('title', 'Manage Games')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manage Games</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGameModal">
        <i class="bi bi-plus-circle me-2"></i>
        Add New Game
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

<!-- Games Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-controller me-2"></i>
            All Games
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game Name</th>
                        <th>Publisher</th>
                        <th>Packages Count</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($games as $game)
                    <tr>
                        <td>
                            <strong>#{{ $game->id }}</strong>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $game->name }}</div>
                        </td>
                        <td>
                            <span class="text-muted">{{ $game->publisher }}</span>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $game->topupPackages->count() }} packages</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td>
                            <div>
                                <div>{{ $game->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $game->created_at->format('H:i') }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="editGame({{ $game->id }}, '{{ $game->name }}', '{{ $game->publisher }}')" 
                                        title="Edit Game">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="{{ route('admin.topup.packages') }}?game={{ $game->id }}" 
                                   class="btn btn-sm btn-outline-info" 
                                   title="View Packages">
                                    <i class="bi bi-box"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-inbox display-4"></i>
                                <p class="mt-2">No games found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Game Modal -->
<div class="modal fade" id="addGameModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-plus-circle text-primary me-2"></i>
                    Add New Game
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.topup.games.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Game Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="e.g., Valorant, PUBG Mobile">
                    </div>
                    <div class="mb-3">
                        <label for="publisher" class="form-label">Publisher</label>
                        <input type="text" class="form-control" name="publisher" required placeholder="e.g., Riot Games, PUBG Corporation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add Game
                    </button>
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
                <h5 class="modal-title">
                    <i class="bi bi-pencil text-primary me-2"></i>
                    Edit Game
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editGameForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Game Name</label>
                        <input type="text" class="form-control" name="name" id="edit_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_publisher" class="form-label">Publisher</label>
                        <input type="text" class="form-control" name="publisher" id="edit_publisher" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>
                        Update Game
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editGame(gameId, name, publisher) {
    // Populate the edit form
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_publisher').value = publisher;
    
    // Set the form action
    document.getElementById('editGameForm').action = `/admin/topup/games/${gameId}`;
    
    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('editGameModal'));
    modal.show();
}
</script>
@endpush 