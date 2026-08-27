@extends('layouts.admin')

@section('title', 'Add Course Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-plus-circle text-orange me-2"></i>Add Course Category
    </h4>
    <a href="{{ route('admin.course-categories.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.course-categories.store') }}" method="POST">
    @csrf
    
    <div class="row">
        <!-- Main Form Column (Desktop) -->
        <div class="col-lg-8 col-12">
            
            <!-- Basic Info Section -->
            <x-form-section title="Category Info" icon="fas fa-info-circle">
                <div class="row gy-4">
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-tag text-muted me-1"></i> Category Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="categoryName" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        <div class="form-text mt-2">
                            <i class="fas fa-link me-1"></i> Slug preview: <span id="slugPreview" class="badge bg-light text-dark font-monospace text-lowercase border"></span>
                        </div>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-hashtag text-muted me-1"></i> Order Position <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="order_position" class="form-control @error('order_position') is-invalid @enderror" value="{{ old('order_position', 0) }}" required>
                        @error('order_position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-eye text-muted me-1"></i> Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>
            
        </div>

        <!-- Right Column (Desktop) -->
        <div class="col-lg-4 col-12">
            
            <!-- Icon Section -->
            <x-form-section title="Category Icon" icon="fas fa-image">
                <div class="row gy-4">
                    <div class="col-12">
                        <x-media-picker name="icon" id="icon" label="Select Icon Image" :value="old('icon')" />
                        @error('icon')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Actions Area -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold btn-hover-lift">
                        <i class="fas fa-save me-1"></i> Save Category
                    </button>
                    <a href="{{ route('admin.course-categories.index') }}" class="btn btn-light w-100 text-muted">
                        Cancel
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</form>

<style>
    .btn-hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .btn-hover-lift:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('categoryName');
        const slugPreview = document.getElementById('slugPreview');
        
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }

        function updateSlugPreview() {
            if (nameInput.value.trim() === '') {
                slugPreview.textContent = 'auto-generated';
                slugPreview.classList.add('text-muted');
            } else {
                slugPreview.textContent = slugify(nameInput.value);
                slugPreview.classList.remove('text-muted');
            }
        }

        nameInput.addEventListener('input', updateSlugPreview);
        updateSlugPreview(); // Initial call
    });
</script>
@endpush
@endsection
