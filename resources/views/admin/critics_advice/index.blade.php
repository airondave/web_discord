@extends('admin.layout')

@section('title', 'Critics & Advice Management')

@section('content')
<style>
    .bg-discord {
        background-color: #5865F2 !important;
    }
    .bg-discord:hover {
        background-color: #4752C4 !important;
    }
</style>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">
                    <i class="bi bi-chat-heart me-2"></i>
                    Critics & Advice Management
                </h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.submissions') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Submissions
                    </a>
                </div>
            </div>
            <p class="text-muted mt-2">Manage user feedback and respond to critics and advice</p>
        </div>
    </div>

    <!-- Unresponded Feedback -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Pending Responses ({{ $unresponded->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    @if($unresponded->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Discord</th>
                                        <th>Message</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unresponded as $feedback)
                                    <tr>
                                        <td>
                                            <small class="text-muted">
                                                {{ $feedback->created_at->format('M j, Y') }}<br>
                                                <span class="badge bg-secondary">{{ $feedback->created_at->format('g:i A') }}</span>
                                            </small>
                                        </td>
                                        <td>
                                            <strong>{{ $feedback->sender_name }}</strong>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $feedback->sender_email }}" class="text-decoration-none">
                                                {{ $feedback->sender_email }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($feedback->discord_username)
                                                <span class="badge bg-discord text-white">
                                                    <i class="bi bi-discord me-1"></i>
                                                    {{ $feedback->discord_username }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="message-preview">
                                                {{ Str::limit($feedback->messages, 100) }}
                                                @if(strlen($feedback->messages) > 100)
                                                    <button class="btn btn-sm btn-link p-0 ms-1" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#messageModal{{ $feedback->id }}">
                                                        Read More
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#responseModal{{ $feedback->id }}">
                                                    <i class="bi bi-reply me-1"></i>Respond
                                                </button>
                                                <button class="btn btn-sm btn-danger" 
                                                        onclick="deleteFeedback({{ $feedback->id }})">
                                                    <i class="bi bi-trash me-1"></i>Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Message Modal -->
                                    <div class="modal fade" id="messageModal{{ $feedback->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Full Message from {{ $feedback->sender_name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <strong>From:</strong> {{ $feedback->sender_name }} ({{ $feedback->sender_email }})
                                                    </div>
                                                    @if($feedback->discord_username)
                                                    <div class="mb-3">
                                                        <strong>Discord:</strong> 
                                                        <span class="badge bg-discord text-white">
                                                            <i class="bi bi-discord me-1"></i>
                                                            {{ $feedback->discord_username }}
                                                        </span>
                                                    </div>
                                                    @endif
                                                    <div class="mb-3">
                                                        <strong>Date:</strong> {{ $feedback->created_at->format('F j, Y \a\t g:i A') }}
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Message:</strong>
                                                        <div class="border rounded p-3 bg-light mt-2">
                                                            {{ $feedback->messages }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#responseModal{{ $feedback->id }}"
                                                            data-bs-dismiss="modal">
                                                        <i class="bi bi-reply me-1"></i>Respond Now
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Response Modal -->
                                    <div class="modal fade" id="responseModal{{ $feedback->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Send Response to {{ $feedback->sender_name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('admin.critics.advice.respond', $feedback->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Original Message:</label>
                                                            <div class="border rounded p-3 bg-light">
                                                                {{ $feedback->messages }}
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="response{{ $feedback->id }}" class="form-label">Your Response:</label>
                                                            <textarea class="form-control" 
                                                                      id="response{{ $feedback->id }}" 
                                                                      name="response" 
                                                                      rows="6" 
                                                                      placeholder="Type your response here..."
                                                                      required></textarea>
                                                            <div class="form-text">
                                                                This response will be sent via email to {{ $feedback->sender_email }}
                                                                @if($feedback->discord_username)
                                                                    <br><i class="bi bi-discord me-1"></i>Discord notification will also be sent to {{ $feedback->discord_username }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="bi bi-send me-1"></i>Send Response
                                                        </button>
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
                        <div class="text-center py-4">
                            <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-success">All Caught Up!</h5>
                            <p class="text-muted">No pending feedback to respond to.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Responded Feedback -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-check-circle me-2"></i>
                        Responded Feedback ({{ $responded->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    @if($responded->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Discord</th>
                                        <th>Message</th>
                                        <th>Response</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($responded as $feedback)
                                    <tr>
                                        <td>
                                            <small class="text-muted">
                                                {{ $feedback->created_at->format('M j, Y') }}<br>
                                                <span class="badge bg-secondary">{{ $feedback->created_at->format('g:i A') }}</span>
                                            </small>
                                        </td>
                                        <td>
                                            <strong>{{ $feedback->sender_name }}</strong>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $feedback->sender_email }}" class="text-decoration-none">
                                                {{ $feedback->sender_email }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($feedback->discord_username)
                                                <span class="badge bg-discord text-white">
                                                    <i class="bi bi-discord me-1"></i>
                                                    {{ $feedback->discord_username }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="message-preview">
                                                {{ Str::limit($feedback->messages, 80) }}
                                                @if(strlen($feedback->messages) > 80)
                                                    <button class="btn btn-sm btn-link p-0 ms-1" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#respondedMessageModal{{ $feedback->id }}">
                                                        Read More
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="response-preview">
                                                {{ Str::limit($feedback->response, 80) }}
                                                @if(strlen($feedback->response) > 80)
                                                    <button class="btn btn-sm btn-link p-0 ms-1" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#respondedResponseModal{{ $feedback->id }}">
                                                        Read More
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" 
                                                    onclick="deleteFeedback({{ $feedback->id }})">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Responded Message Modal -->
                                    <div class="modal fade" id="respondedMessageModal{{ $feedback->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Full Message from {{ $feedback->sender_name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <strong>From:</strong> {{ $feedback->sender_name }} ({{ $feedback->sender_email }})
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Date:</strong> {{ $feedback->created_at->format('F j, Y \a\t g:i A') }}
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Message:</strong>
                                                        <div class="border rounded p-3 bg-light mt-2">
                                                            {{ $feedback->messages }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Responded Response Modal -->
                                    <div class="modal fade" id="respondedResponseModal{{ $feedback->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Response Sent to {{ $feedback->sender_name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <strong>Response:</strong>
                                                        <div class="border rounded p-3 bg-success bg-opacity-10 mt-2">
                                                            {{ $feedback->response }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-chat-dots text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">No Responses Yet</h5>
                            <p class="text-muted">Responses will appear here once you start replying to feedback.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this feedback? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function deleteFeedback(id) {
    if (confirm('Are you sure you want to delete this feedback? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/critics-advice/${id}`;
        
        // Create CSRF token input
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        
        // Create method override input
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Auto-refresh every 30 seconds to check for new feedback
setInterval(function() {
    // Only refresh if no modals are open
    if (!document.querySelector('.modal.show')) {
        location.reload();
    }
}, 30000);
</script>
@endpush 