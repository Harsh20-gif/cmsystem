@extends('layouts.admin')

@section('title', 'Media Library - EduSkill Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0 text-navy fw-bold">Media Library</h3>
    <button type="button" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#uploadModal">
        Upload New
    </button>
</div>

<div class="admin-card p-4">
    <div class="row g-3">
        @forelse($media as $m)
        <div class="col-md-2 col-sm-4 col-6">
            <div class="card h-100 position-relative">
                <img src="{{ Storage::url($m->file_path) }}" class="card-img-top" alt="{{ $m->file_name }}" style="height: 120px; object-fit: cover;">
                <div class="card-body p-2 text-center">
                    <small class="text-truncate d-block" title="{{ $m->file_name }}">{{ $m->file_name }}</small>
                </div>
                <form action="{{ route('admin.media.destroy', $m) }}" method="POST" class="position-absolute top-0 end-0 m-1" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm p-1 lh-1" title="Delete">
                        &times;
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-muted text-center py-5">No media found. Upload some images.</p>
        </div>
        @endforelse
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $media->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Upload Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Image</label>
                        <input type="file" name="file" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-orange">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
