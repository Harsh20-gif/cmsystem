@extends('layouts.admin')

@section('title', 'Pages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Static Pages</h4>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-orange">Add New Page</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.pages.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Search by title..." value="{{ request('q') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>URL Slug</th>
                    <th>Last Updated</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                <tr>
                    <td><strong>{{ $page->title }}</strong></td>
                    <td><span class="text-muted">/{{ $page->slug }}</span></td>
                    <td>{{ $page->updated_at->format('M d, Y h:i A') }}</td>
                    <td>
                        <span class="badge bg-{{ $page->status == 'published' ? 'success' : 'secondary' }}">
                            {{ ucfirst($page->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No pages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $pages->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
