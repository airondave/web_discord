@extends('admin.layout')

@section('title', 'Manage Games')

@push('styles')
<style>
.game-icon-small {
    transition: transform 0.2s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.game-icon-small:hover {
    transform: scale(1.1);
}

.game-icon-placeholder {
    transition: all 0.2s ease;
}

.game-icon-placeholder:hover {
    background: #e9ecef !important;
    border-color: #adb5bd !important;
}

.table td {
    vertical-align: middle;
}
</style>
@endpush

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
                        <th>Icon</th>
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
                            @if($game->icon)
                                <img src="{{ asset('image/games/' . $game->icon) }}" 
                                     alt="{{ $game->name }}" 
                                     class="game-icon-small" 
                                     style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div class="game-icon-placeholder" 
                                     style="width: 40px; height: 40px; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
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
                                        onclick="editGame({{ $game->id }}, '{{ $game->name }}', '{{ $game->publisher }}', '{{ $game->icon ?? '' }}')" 
                                        title="Edit Game">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="{{ route('admin.topup.packages') }}?game={{ $game->id }}" 
                                   class="btn btn-sm btn-outline-info" 
                                   title="View Packages">
                                    <i class="bi bi-box"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="deleteGame({{ $game->id }}, '{{ $game->name }}')" 
                                        title="Delete Game">
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
            <form action="{{ route('admin.topup.games.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="mb-3">
                        <label for="icon" class="form-label">Game Icon</label>
                        <input type="file" class="form-control" name="icon" accept="image/*" id="icon">
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Recommended: 200x200px, PNG/JPG format. Will be saved to /public/image/games/
                        </div>
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
            <form id="editGameForm" method="POST" enctype="multipart/form-data">
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
                    <div class="mb-3">
                        <label for="edit_icon" class="form-label">Game Icon</label>
                        <input type="file" class="form-control" name="icon" accept="image/*" id="edit_icon">
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Leave empty to keep current icon. Recommended: 200x200px, PNG/JPG format.
                        </div>
                        <div id="current_icon_preview" class="mt-2" style="display: none;">
                            <small class="text-muted">Current icon:</small>
                            <img id="current_icon_img" src="" alt="Current icon" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; margin-left: 10px;">
                        </div>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteGameModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                    Delete Game
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the game "<strong id="delete_game_name"></strong>"?</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. If the game has packages, you must delete them first.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteGameForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i>
                        Delete Game
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editGame(gameId, name, publisher, icon) {
    // Populate the edit form
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_publisher').value = publisher;
    
    // Set the form action
    document.getElementById('editGameForm').action = `/admin/topup/games/${gameId}`;
    
    // Show current icon preview if exists
    const currentIconPreview = document.getElementById('current_icon_preview');
    const currentIconImg = document.getElementById('current_icon_img');
    
    if (icon) {
        currentIconImg.src = `/image/games/${icon}`;
        currentIconPreview.style.display = 'block';
    } else {
        currentIconPreview.style.display = 'none';
    }
    
    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('editGameModal'));
    modal.show();
}

function deleteGame(gameId, gameName) {
    // Set the game name in the modal
    document.getElementById('delete_game_name').textContent = gameName;
    
    // Set the form action
    document.getElementById('deleteGameForm').action = `/admin/topup/games/${gameId}`;
    
    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('deleteGameModal'));
    modal.show();
}
</script>
@endpush 