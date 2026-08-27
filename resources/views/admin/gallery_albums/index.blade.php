@extends('layouts.admin')

@section('title', 'Gallery Albums')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-camera-retro text-orange me-2"></i>Gallery Albums
    </h4>
    <a href="{{ route('admin.gallery-albums.create') }}" class="btn btn-orange">
        <i class="fas fa-plus-circle me-1"></i> Create New Album
    </a>
</div>

<div class="admin-card p-4 mb-4">
    <form action="{{ route('admin.gallery-albums.index') }}" method="GET" class="row gy-3 gx-3 align-items-center">
        <div class="col-12 col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Search albums..." value="{{ request('q') }}">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
        <div class="col-12 col-md-2">
            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
        </div>
        @if(request('q') || request('status'))
            <div class="col-12 col-md-2">
                <a href="{{ route('admin.gallery-albums.index') }}" class="btn btn-outline-secondary w-100">Clear</a>
            </div>
        @endif
    </form>
</div>

@if($albums->count() > 0)
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 gy-4 gx-4">
        @foreach($albums as $album)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                <!-- Cover Image -->
                <div class="ratio ratio-4x3 bg-light">
                    @if($album->cover_image)
                        <img src="{{ Storage::url($album->cover_image) }}" class="object-fit-cover w-100 h-100" alt="{{ $album->title }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center w-100 h-100">
                            <i class="fas fa-image text-muted fa-3x opacity-25"></i>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="card-title fw-bold text-navy mb-1">{{ $album->title }}</h5>
                    <p class="card-text text-muted small mb-3 flex-grow-1">{{ Str::limit($album->description, 60) }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-auto border-top pt-3">
                        <span class="badge bg-light text-dark border px-2 py-1">
                            <i class="fas fa-images me-1 text-muted"></i> {{ $album->images_count ?? 0 }} Images
                        </span>
                        <span class="badge {{ $album->status == 'published' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} border-0 px-2 py-1">
                            <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> {{ ucfirst($album->status) }}
                        </span>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="card-footer bg-white border-top-0 px-4 pb-4 pt-0">
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.gallery-albums.edit', $album) }}" class="btn btn-sm btn-outline-primary flex-grow-1 fw-medium">
                            <i class="fas fa-edit me-1"></i> Manage
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger px-3 delete-btn" data-id="{{ $album->id }}" data-title="{{ $album->title }}" title="Delete Album" data-bs-toggle="tooltip">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <form id="delete-form-{{ $album->id }}" action="{{ route('admin.gallery-albums.destroy', $album) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-5 d-flex justify-content-center">
        {{ $albums->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@else
    <div class="admin-card p-5 text-center">
        <div class="mb-3">
            <i class="fas fa-folder-open fa-4x text-muted opacity-25"></i>
        </div>
        <h5 class="fw-bold text-navy">No Albums Found</h5>
        <p class="text-muted mb-4">You haven't created any gallery albums yet, or your search returned no results.</p>
        <a href="{{ route('admin.gallery-albums.create') }}" class="btn btn-orange">
            <i class="fas fa-plus me-1"></i> Create Your First Album
        </a>
    </div>
@endif

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pt-0 px-4 pb-4">
                <div class="mb-3 text-danger">
                    <i class="fas fa-exclamation-circle fa-4x"></i>
                </div>
                <h4 class="fw-bold mb-3">Delete Album?</h4>
                <p class="text-muted mb-4">Are you sure you want to delete the album "<span id="deleteAlbumTitle" class="fw-bold text-dark"></span>"? This action cannot be undone and will permanently remove all associated images.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Delete Modal Logic
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        let currentFormId = null;

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                // Prevent default form submission from the layout.blade.php script
                e.preventDefault();
                e.stopPropagation();
                
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                
                document.getElementById('deleteAlbumTitle').textContent = title;
                currentFormId = 'delete-form-' + id;
                
                deleteModal.show();
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (currentFormId) {
                // Remove the confirmation listener attached by layout.blade.php before submitting
                const form = document.getElementById(currentFormId);
                const clone = form.cloneNode(true);
                form.parentNode.replaceChild(clone, form);
                clone.submit();
            }
        });
    });
</script>
@endpush
@endsection
