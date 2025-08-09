@extends('admin.layout')

@section('title', 'Discord Verification Submissions')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0"><i class="bi bi-shield-check"></i> Discord Verification Submissions</h4>
                    <small class="opacity-75">Manage and verify user submissions</small>
                </div>
                <div class="badge bg-light text-primary fs-6">
                    Total: {{ $submissions->count() }}
                </div>
            </div>
            <div class="card-body">

                    @if($submissions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Discord Username</th>
                                        <th>Discord ID</th>
                                        <th>Current Role</th>
                                        <th>Desired Role</th>
                                        <th>Proof Image</th>
                                        <th>Status</th>
                                        <th>Submitted At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($submissions as $submission)
                                        <tr>
                                            <td>{{ $submission->id }}</td>
                                            <td>
                                                @if($submission->submission_type === 'butun')
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-mortarboard-fill me-1"></i>
                                                        BUTUN
                                                    </span>
                                                @else
                                                    <span class="badge bg-primary">
                                                        <i class="bi bi-person-fill me-1"></i>
                                                        REGULAR
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $submission->discord_username }}</strong>
                                            </td>
                                            <td>
                                                <code>{{ $submission->discord_id }}</code>
                                            </td>
                                            <td>
                                                @if($submission->role)
                                                    <span class="badge bg-info">{{ $submission->role->name }}</span>
                                                @else
                                                    <span class="text-muted">No role</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($submission->desired_role)
                                                    <span class="badge bg-warning text-dark">{{ $submission->desired_role }}</span>
                                                @else
                                                    <span class="text-muted">Not specified</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($submission->proof_path)
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#imageModal{{ $submission->id }}">
                                                        <i class="bi bi-image"></i> View Image
                                                    </button>
                                                    
                                                    <!-- Modal for image -->
                                                    <div class="modal fade" id="imageModal{{ $submission->id }}" tabindex="-1">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Proof Image - {{ $submission->discord_username }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ asset($submission->proof_path) }}" class="img-fluid" alt="Proof Image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($submission->status === 'pending')
                                                    <span class="badge bg-warning"><i class="bi bi-clock"></i> Pending</span>
                                                @elseif($submission->status === 'approved')
                                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Approved</span>
                                                @else
                                                    <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>{{ $submission->created_at->format('M d, Y H:i') }}</small>
                                            </td>
                                            <td>
                                                @if($submission->status === 'pending')
                                                    <div class="btn-group" role="group">
                                                        <form action="/admin/submissions/{{ $submission->id }}/approve" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to approve this submission?')">
                                                                <i class="bi bi-check-lg"></i> Approve
                                                            </button>
                                                        </form>
                                                        <form action="/admin/submissions/{{ $submission->id }}/reject" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this submission?')">
                                                                <i class="bi bi-x-lg"></i> Reject
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="bi bi-check-circle-fill"></i> Processed
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-inbox display-1 text-muted"></i>
                            <h4 class="text-muted mt-3">No submissions yet</h4>
                            <p class="text-muted">Submissions will appear here when users submit their Discord verification.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection