@extends('layouts.admin')

@section('title', 'Manage Album')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-camera-retro text-orange me-2"></i>Manage Album: {{ $galleryAlbum->title }}
    </h4>
    <a href="{{ route('admin.gallery-albums.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<ul class="nav nav-tabs mb-4" id="albumTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active fw-medium px-4 py-3" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">
            <i class="fas fa-info-circle me-1"></i> Album Details
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link fw-medium px-4 py-3" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab">
            <i class="fas fa-images me-1"></i> Images <span class="badge bg-secondary ms-1">{{ $galleryAlbum->images->count() }}</span>
        </button>
    </li>
</ul>

<div class="tab-content" id="albumTabsContent">
    <!-- Album Details Tab -->
    <div class="tab-pane fade show active" id="details" role="tabpanel">
        <form action="{{ route('admin.gallery-albums.update', $galleryAlbum) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- Main Form Column (Desktop) -->
                <div class="col-lg-8 col-12">
                    
                    <!-- Basic Info Section -->
                    <x-form-section title="Basic Info" icon="fas fa-info-circle">
                        <div class="row gy-4">
                            <div class="col-md-8 col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-heading text-muted me-1"></i> Album Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $galleryAlbum->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-4 col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-eye text-muted me-1"></i> Status <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="draft" {{ old('status', $galleryAlbum->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $galleryAlbum->status) == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-align-left text-muted me-1"></i> Description <small class="text-muted fw-normal">(Optional)</small>
                                </label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $galleryAlbum->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </x-form-section>

                    <!-- Media Section -->
                    <x-form-section title="Cover Image" icon="fas fa-image">
                        <div class="row gy-4">
                            <div class="col-12">
                                <x-media-picker name="cover_image" id="cover_image" label="Select Cover Image" :value="old('cover_image', $galleryAlbum->cover_image)" />
                            </div>
                        </div>
                    </x-form-section>
                    
                </div>

                <!-- Right Column (Desktop) -->
                <div class="col-lg-4 col-12">
                    
                    <!-- Actions Area -->
                    <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                        <div class="card-body p-4 text-center">
                            <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold">
                                <i class="fas fa-save me-1"></i> Update Album Details
                            </button>
                            <a href="{{ route('admin.gallery-albums.index') }}" class="btn btn-light w-100 text-muted">
                                Cancel
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>

    <!-- Images Tab -->
    <div class="tab-pane fade" id="images" role="tabpanel">
        <x-form-section title="Upload New Image" icon="fas fa-cloud-upload-alt">
            <form action="{{ route('admin.gallery-albums.images.store', $galleryAlbum) }}" method="POST">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-lg-5 col-12">
                        <x-media-picker name="image_path" id="new_image" label="Select Image from Library" />
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <label class="form-label fw-semibold">Caption <small class="text-muted fw-normal">(Optional)</small></label>
                        <input type="text" name="caption" class="form-control" placeholder="Image Caption">
                    </div>
                    <div class="col-lg-2 col-md-4 col-8">
                        <label class="form-label fw-semibold">Order</label>
                        <input type="number" name="order_position" class="form-control" value="{{ $galleryAlbum->images->count() + 1 }}" required>
                    </div>
                    <div class="col-lg-1 col-md-2 col-4">
                        <button type="submit" class="btn btn-orange w-100 h-100">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </div>
                </div>
            </form>
        </x-form-section>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 gy-4 gx-4">
            @forelse($galleryAlbum->images as $image)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="ratio ratio-4x3 bg-light">
                        <img src="{{ Storage::url($image->image_path) }}" class="object-fit-cover w-100 h-100" alt="Gallery Image">
                    </div>
                    <div class="card-body p-3 bg-light">
                        <form action="{{ route('admin.gallery-images.update', $image) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-muted mb-1">Caption</label>
                                <input type="text" name="caption" class="form-control form-control-sm" value="{{ $image->caption }}" placeholder="Caption">
                            </div>
                            <div class="d-flex gap-2">
                                <div class="input-group input-group-sm w-50">
                                    <span class="input-group-text bg-white">Order</span>
                                    <input type="number" name="order_position" class="form-control border-start-0" value="{{ $image->order_position }}" required>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary w-50 fw-medium">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-white border-top-0 p-3 pt-0 text-end">
                        <button type="button" class="btn btn-sm btn-outline-danger w-100 delete-btn" data-id="img-{{ $image->id }}" data-title="this image">
                            <i class="fas fa-trash-alt me-1"></i> Remove Image
                        </button>
                        <form id="delete-form-img-{{ $image->id }}" action="{{ route('admin.gallery-images.destroy', $image) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 w-100">
                <div class="admin-card p-5 text-center bg-white border-0 shadow-sm rounded-4">
                    <div class="mb-3">
                        <i class="fas fa-images fa-4x text-muted opacity-25"></i>
                    </div>
                    <h5 class="fw-bold text-navy">No Images Yet</h5>
                    <p class="text-muted mb-0">Use the upload form above to add images to this album.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

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
                <h4 class="fw-bold mb-3">Delete Item?</h4>
                <p class="text-muted mb-4">Are you sure you want to remove <span id="deleteItemTitle" class="fw-bold text-dark"></span>? This action cannot be undone.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">Yes, Remove</button>
                </div>
            </div>
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

        // Delete Modal Logic for images
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        let currentFormId = null;

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                
                document.getElementById('deleteItemTitle').textContent = title;
                currentFormId = 'delete-form-' + id;
                
                deleteModal.show();
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (currentFormId) {
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
