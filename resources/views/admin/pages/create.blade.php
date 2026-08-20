@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Create Static Page</h4>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.pages.store') }}" method="POST">
        @csrf
        
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Page Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Page Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="15">{{ old('content') }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">HTML is supported for page content.</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 bg-light mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Publish Settings</h6>
                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="card border-0 bg-light mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Featured Image</h6>
                        <x-media-picker name="featured_image" id="featured_image" label="Select Image" :value="old('featured_image')" />
                    </div>
                </div>

                <div class="card border-0 bg-light mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">SEO Settings</h6>
                        <div class="mb-3">
                            <label class="form-label">SEO Title</label>
                            <input type="text" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title') }}" placeholder="Leave blank to use page title">
                            @error('seo_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="seo_description" class="form-control @error('seo_description') is-invalid @enderror" rows="3">{{ old('seo_description') }}</textarea>
                            @error('seo_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange btn-lg px-5">Save Page</button>
            </div>
        </div>
    </form>
</div>

<!-- TinyMCE could be included here if required, currently using a simple textarea -->
@endsection
