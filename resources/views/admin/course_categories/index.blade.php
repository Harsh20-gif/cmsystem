@extends('layouts.admin')

@section('title', 'Course Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Course Categories</h4>
    <a href="{{ route('admin.course-categories.create') }}" class="btn btn-orange">Add New</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.course-categories.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="q" class="form-control" placeholder="Search by name..." value="{{ request('q') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td><small class="text-muted">{{ $category->slug }}</small></td>
                    <td>{{ $category->order_position }}</td>
                    <td>
                        <span class="badge bg-{{ $category->status == 'published' ? 'success' : 'secondary' }}">
                            {{ ucfirst($category->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.course-categories.edit', $category) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.course-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
