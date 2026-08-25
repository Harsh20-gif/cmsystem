@extends('layouts.admin')

@section('title', 'Trainings & Programs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Trainings & Programs</h4>
    <a href="{{ route('admin.trainings.create') }}" class="btn btn-orange">Add New Training</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.trainings.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-5">
            <input type="text" name="q" class="form-control" placeholder="Search by title..." value="{{ request('q') }}">
        </div>
        <div class="col-md-4">
            <select name="type" class="form-select" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="summer" {{ request('type') == 'summer' ? 'selected' : '' }}>Summer</option>
                <option value="winter" {{ request('type') == 'winter' ? 'selected' : '' }}>Winter</option>
                <option value="industrial" {{ request('type') == 'industrial' ? 'selected' : '' }}>Industrial</option>
                <option value="internship" {{ request('type') == 'internship' ? 'selected' : '' }}>Internship</option>
                <option value="corporate" {{ request('type') == 'corporate' ? 'selected' : '' }}>Corporate</option>
                <option value="workshop" {{ request('type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
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
                    <th>Title & Type</th>
                    <th>Course Link</th>
                    <th>Dates</th>
                    <th>Registration</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trainings as $training)
                <tr>
                    <td>
                        <strong>{{ $training->title }}</strong><br>
                        <span class="badge bg-light text-dark border">{{ ucfirst($training->type) }}</span>
                    </td>
                    <td>{{ $training->course ? $training->course->title : 'N/A' }}</td>
                    <td>
                        @if($training->start_date || $training->end_date)
                            {{ $training->start_date ? $training->start_date->format('M d, Y') : '?' }} - 
                            {{ $training->end_date ? $training->end_date->format('M d, Y') : '?' }}
                        @else
                            <span class="text-muted">Not specified</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $training->registration_status == 'open' ? 'success' : 'danger' }}">
                            {{ ucfirst($training->registration_status) }}
                        </span>
                    </td>
                    <td>
                        @if($training->status == 'published')
                            <span class="badge bg-success">Published</span>
                        @elseif($training->status == 'draft')
                            <span class="badge bg-secondary">Draft</span>
                        @else
                            <span class="badge bg-warning text-dark">Archived</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.trainings.edit', $training) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.trainings.destroy', $training) }}" method="POST" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No trainings found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $trainings->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
