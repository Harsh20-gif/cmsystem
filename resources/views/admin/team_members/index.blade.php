@extends('layouts.admin')

@section('title', 'Team Members')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Team Members</h4>
    <a href="{{ route('admin.team-members.create') }}" class="btn btn-orange">Add Team Member</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.team-members.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Search by name or role..." value="{{ request('q') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Photo & Name</th>
                    <th>Role</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($member->photo)
                                <img src="{{ Storage::url($member->photo) }}" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center text-secondary" style="width: 45px; height: 45px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <div>
                                <strong>{{ $member->name }}</strong>
                            </div>
                        </div>
                    </td>
                    <td>{{ $member->role }}</td>
                    <td>{{ $member->order_position }}</td>
                    <td>
                        <span class="badge bg-{{ $member->status == 'published' ? 'success' : 'secondary' }}">
                            {{ ucfirst($member->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.team-members.edit', $member) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this team member?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No team members found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $members->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
