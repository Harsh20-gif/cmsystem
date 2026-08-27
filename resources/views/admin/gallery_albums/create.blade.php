@extends('layouts.admin')

@section('title', 'Create Album')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-plus-circle text-orange me-2"></i>Create Gallery Album
    </h4>
    <a href="{{ route('admin.gallery-albums.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.gallery-albums.store') }}" method="POST">
    @csrf
    
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
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-eye text-muted me-1"></i> Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-align-left text-muted me-1"></i> Description <small class="text-muted fw-normal">(Optional)</small>
                        </label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Media Section -->
            <x-form-section title="Cover Image" icon="fas fa-image">
                <div class="row gy-4">
                    <div class="col-12">
                        <x-media-picker name="cover_image" id="cover_image" label="Select Cover Image" :value="old('cover_image')" />
                    </div>
                </div>
            </x-form-section>
            
        </div>

        <!-- Right Column (Desktop) -->
        <div class="col-lg-4 col-12">
            
            <!-- Actions Area -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                <div class="card-body p-4 text-center">
                    <p class="text-muted small mb-3">You will be able to upload multiple photos into this album after saving.</p>
                    <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold">
                        <i class="fas fa-save me-1"></i> Save Album & Add Images
                    </button>
                    <a href="{{ route('admin.gallery-albums.index') }}" class="btn btn-light w-100 text-muted">
                        Cancel
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</form>

@endsection
