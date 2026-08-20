@extends('layouts.admin')

@section('title', 'Placements')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Placements</h4>
    <a href="{{ route('admin.placements.create') }}" class="btn btn-orange">Add New Placement</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.placements.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <select name="student_id" class="form-select" onchange="this.form.submit()">
                <option value="">Filter by Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select name="company_id" class="form-select" onchange="this.form.submit()">
                <option value="">Filter by Company</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.placements.index') }}" class="btn btn-outline-secondary w-100">Clear</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Student</th>
                    <th>Company</th>
                    <th>Position & Package</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($placements as $placement)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($placement->student->photo)
                                <img src="{{ Storage::url($placement->student->photo) }}" class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle me-2 d-flex align-items-center justify-content-center text-secondary" style="width: 30px; height: 30px;">
                                    <i class="fas fa-user small"></i>
                                </div>
                            @endif
                            <div>
                                <strong>{{ $placement->student->name }}</strong><br>
                                <small class="text-muted">{{ $placement->student->course_enrolled }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($placement->company->logo)
                                <img src="{{ Storage::url($placement->company->logo) }}" class="rounded me-2" style="height: 25px; max-width: 60px; object-fit: contain;">
                            @endif
                            <span>{{ $placement->company->name }}</span>
                        </div>
                    </td>
                    <td>
                        <div><strong>{{ $placement->position }}</strong></div>
                        <div class="small text-muted">{{ $placement->package ?? 'N/A' }}</div>
                    </td>
                    <td>
                        {{ $placement->placement_date ? $placement->placement_date->format('M Y') : 'N/A' }}
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.placements.edit', $placement) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.placements.destroy', $placement) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this placement?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No placements found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $placements->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
