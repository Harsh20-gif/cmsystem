@extends('layouts.admin')

@section('title', 'Notice Board & Marquee')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Notice Board & Marquee</h4>
    <a href="{{ route('admin.notices.create') }}" class="btn btn-orange">Add New Notice</a>
</div>

<div class="admin-card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notices as $notice)
                <tr>
                    <td>
                        <strong>{{ $notice->title }}</strong>
                    </td>
                    <td>{{ $notice->link ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $notice->type == 'marquee' ? 'primary' : 'info' }}">
                            {{ ucfirst($notice->type) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $notice->status == 'published' ? 'success' : 'secondary' }}">
                            {{ ucfirst($notice->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.notices.edit', $notice) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.notices.destroy', $notice) }}" method="POST" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No notices found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $notices->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
