@extends('layouts.admin')

@section('title', 'Gallery Albums')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Gallery Albums</h4>
    <a href="{{ route('admin.gallery-albums.create') }}" class="btn btn-orange">Create New Album</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.gallery-albums.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Search albums..." value="{{ request('q') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
    </form>

    <div class="row g-4">
        @forelse($albums as $album)
        <div class="col-md-4 col-sm-6">
            <div class="card h-100 border-0 shadow-sm">
                @if($album->cover_image)
                    <img src="{{ Storage::url($album->cover_image) }}" class="card-img-top" alt="Cover" style="height: 180px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                        <i class="fas fa-images text-muted fa-3x"></i>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $album->title }}</h5>
                    <p class="card-text text-muted small mb-2">{{ Str::limit($album->description, 60) }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="badge bg-secondary">{{ $album->images_count }} Images</span>
                        <span class="badge bg-{{ $album->status == 'published' ? 'success' : 'warning text-dark' }}">
                            {{ ucfirst($album->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.gallery-albums.edit', $album) }}" class="btn btn-sm btn-primary w-100 me-2">Manage</a>
                        <form action="{{ route('admin.gallery-albums.destroy', $album) }}" method="POST" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-3"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            No gallery albums found.
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $albums->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
