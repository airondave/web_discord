@extends('admin.layout')

@section('title', 'Approval History')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0"><i class="bi bi-clock-history"></i> Approval History</h4>
                    <small class="opacity-75">View processed submission history</small>
                </div>
                <div class="badge bg-light text-info fs-6">
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
                                    <th>Status</th>
                                    <th>Submitted</th>
                                    <th>Processed</th>
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
                                            @if($submission->status === 'approved')
                                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Approved</span>
                                            @else
                                                <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $submission->created_at->format('M d, Y H:i') }}</small>
                                        </td>
                                        <td>
                                            <small>{{ $submission->updated_at->format('M d, Y H:i') }}</small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-clock-history display-1 text-muted"></i>
                        <h4 class="text-muted mt-3">No processed submissions yet</h4>
                        <p class="text-muted">Approved and rejected submissions will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection