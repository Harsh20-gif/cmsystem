@extends('layouts.admin')

@section('title', 'Newsletter Subscribers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Newsletter Subscribers</h4>
    <a href="{{ route('admin.newsletters.export') }}" class="btn btn-success"><i class="fas fa-file-csv me-1"></i> Export to CSV</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.newsletters.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Search by email..." value="{{ request('q') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Email Address</th>
                    <th>Subscribed On</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscribers as $subscriber)
                <tr>
                    <td>
                        <i class="fas fa-envelope text-muted me-2"></i>
                        <a href="mailto:{{ $subscriber->email }}" class="text-decoration-none fw-bold">{{ $subscriber->email }}</a>
                    </td>
                    <td>{{ $subscriber->created_at->format('M d, Y h:i A') }}</td>
                    <td class="text-end">
                        <form action="{{ route('admin.newsletters.destroy', $subscriber) }}" method="POST" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">No subscribers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $subscribers->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
