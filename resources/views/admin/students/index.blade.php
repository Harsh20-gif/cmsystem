@extends('layouts.admin')

@section('title', 'Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Students Database</h4>
    <a href="{{ route('admin.students.create') }}" class="btn btn-orange">Add New Student</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.students.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Search by name or email..." value="{{ request('q') }}">
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
                    <th>Contact</th>
                    <th>College / Course</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($student->photo)
                                <img src="{{ Storage::url($student->photo) }}" alt="Photo" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle me-2 d-flex align-items-center justify-content-center text-secondary" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <div>
                                <strong>{{ $student->name }}</strong>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div><i class="fas fa-envelope text-muted me-1"></i> <a href="mailto:{{ $student->email }}" class="text-decoration-none">{{ $student->email ?? 'N/A' }}</a></div>
                        <div><i class="fas fa-phone text-muted me-1"></i> {{ $student->phone ?? 'N/A' }}</div>
                    </td>
                    <td>
                        <div><strong>{{ $student->college ?? 'N/A' }}</strong></div>
                        <div class="small text-muted">{{ $student->course_enrolled ?? 'N/A' }}</div>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this student?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No students found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $students->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
