@extends('layouts.admin')

@section('title', 'Branches / Locations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Branches & Locations</h4>
    <a href="{{ route('admin.branches.create') }}" class="btn btn-orange">Add New Branch</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.branches.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Search by name or city..." value="{{ request('q') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Branch Name</th>
                    <th>City & Contact</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($branches as $branch)
                <tr>
                    <td>
                        <strong>{{ $branch->name }}</strong>
                    </td>
                    <td>
                        <div><i class="fas fa-map-marker-alt text-muted me-1"></i> {{ $branch->city }}{{ $branch->state ? ', '.$branch->state : '' }}</div>
                        <div class="small"><i class="fas fa-phone text-muted me-1"></i> {{ $branch->phone ?? 'N/A' }}</div>
                        <div class="small"><i class="fas fa-envelope text-muted me-1"></i> {{ $branch->email ?? 'N/A' }}</div>
                    </td>
                    <td>
                        @if($branch->is_head_office)
                            <span class="badge bg-primary">Head Office</span>
                        @else
                            <span class="badge bg-light text-dark border">Branch</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $branch->status == 'published' ? 'success' : 'secondary' }}">
                            {{ ucfirst($branch->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.branches.edit', $branch) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.branches.destroy', $branch) }}" method="POST" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No branches found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $branches->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
