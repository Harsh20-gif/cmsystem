@extends('layouts.admin')

@section('title', 'Manage Album')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Manage Album: {{ $galleryAlbum->title }}</h4>
    <a href="{{ route('admin.gallery-albums.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<ul class="nav nav-tabs mb-4" id="albumTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">Album Details</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab">Images <span class="badge bg-secondary ms-1">{{ $galleryAlbum->images->count() }}</span></button>
    </li>
</ul>

<div class="tab-content" id="albumTabsContent">
    <!-- Album Details Tab -->
    <div class="tab-pane fade show active" id="details" role="tabpanel">
        <div class="admin-card p-4">
            <form action="{{ route('admin.gallery-albums.update', $galleryAlbum) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    
                    <div class="col-md-8">
                        <label class="form-label">Album Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $galleryAlbum->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" {{ old('status', $galleryAlbum->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $galleryAlbum->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description (Optional)</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $galleryAlbum->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <x-media-picker name="cover_image" id="cover_image" label="Cover Image" :value="old('cover_image', $galleryAlbum->cover_image)" />
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-orange">Update Album Details</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Images Tab -->
    <div class="tab-pane fade" id="images" role="tabpanel">
        <div class="admin-card p-4 mb-4 bg-light border-0">
            <h5 class="fw-bold">Add Image</h5>
            <form action="{{ route('admin.gallery-albums.images.store', $galleryAlbum) }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-5">
                        <x-media-picker name="image_path" id="new_image" label="Select Image" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Caption (Optional)</label>
                        <input type="text" name="caption" class="form-control" placeholder="Image Caption">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Order</label>
                        <input type="number" name="order_position" class="form-control" value="{{ $galleryAlbum->images->count() + 1 }}" required>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-orange w-100">Add</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row g-3">
            @forelse($galleryAlbum->images as $image)
            <div class="col-md-4 col-sm-6">
                <div class="card h-100">
                    <img src="{{ Storage::url($image->image_path) }}" class="card-img-top" alt="Gallery Image" style="height: 150px; object-fit: cover;">
                    <div class="card-body p-2 border-top">
                        <form action="{{ route('admin.gallery-images.update', $image) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <input type="text" name="caption" class="form-control form-control-sm" value="{{ $image->caption }}" placeholder="Caption">
                            </div>
                            <div class="d-flex gap-2">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Order</span>
                                    <input type="number" name="order_position" class="form-control" value="{{ $image->order_position }}" required>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-white border-top-0 p-2 text-end">
                        <form action="{{ route('admin.gallery-images.destroy', $image) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100"><i class="fas fa-trash"></i> Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4 text-muted">
                No images added to this album yet.
            </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let activeTab = localStorage.getItem('albumActiveTab');
        if (activeTab) {
            let tab = new bootstrap.Tab(document.querySelector(activeTab));
            tab.show();
        }

        document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(function(el) {
            el.addEventListener('shown.bs.tab', function (e) {
                localStorage.setItem('albumActiveTab', '#' + e.target.id);
            });
        });
    });
</script>
@endpush
@endsection
