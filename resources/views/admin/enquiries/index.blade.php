@extends('layouts.admin')

@section('title', 'Enquiries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Contact Enquiries</h4>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.enquiries.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-5">
            <input type="text" name="q" class="form-control" placeholder="Search by name, email or phone..." value="{{ request('q') }}">
        </div>
        <div class="col-md-4">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enquiries as $enquiry)
                <tr class="{{ $enquiry->status == 'new' ? 'fw-bold bg-light' : '' }}">
                    <td>{{ $enquiry->created_at->format('M d, Y h:i A') }}</td>
                    <td>{{ $enquiry->name }}</td>
                    <td>
                        <div><i class="fas fa-envelope text-muted me-1"></i> <a href="mailto:{{ $enquiry->email }}" class="text-decoration-none">{{ $enquiry->email }}</a></div>
                        <div><i class="fas fa-phone text-muted me-1"></i> {{ $enquiry->phone }}</div>
                    </td>
                    <td>{{ Str::limit($enquiry->subject, 30) }}</td>
                    <td>
                        @if($enquiry->status == 'new')
                            <span class="badge bg-danger">New</span>
                        @elseif($enquiry->status == 'read')
                            <span class="badge bg-warning text-dark">Read</span>
                        @else
                            <span class="badge bg-success">Resolved</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-sm btn-primary">View</a>
                        <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this enquiry?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No enquiries found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $enquiries->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
