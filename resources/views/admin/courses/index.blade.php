@extends('layouts.admin')

@section('title', 'Courses')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Courses</h4>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-orange">Add New Course</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.courses.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="q" class="form-control" placeholder="Search by title..." value="{{ request('q') }}">
        </div>
        <div class="col-md-3">
            <select name="category_id" class="form-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($course->thumbnail)
                                <img src="{{ Storage::url($course->thumbnail) }}" alt="Thumbnail" class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <span class="text-muted small">Img</span>
                                </div>
                            @endif
                            <div>
                                <strong>{{ $course->title }}</strong><br>
                                <small class="text-muted">{{ $course->slug }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ $course->category->name ?? 'N/A' }}</td>
                    <td>{{ $course->duration }}</td>
                    <td>
                        @if($course->status == 'published')
                            <span class="badge bg-success">Published</span>
                        @elseif($course->status == 'draft')
                            <span class="badge bg-secondary">Draft</span>
                        @else
                            <span class="badge bg-warning text-dark">Archived</span>
                        @endif
                        @if($course->featured)
                            <span class="badge bg-primary ms-1">Featured</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No courses found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $courses->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
