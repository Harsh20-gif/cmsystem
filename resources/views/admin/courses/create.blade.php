@extends('layouts.admin')

@section('title', 'Add Course')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Add Course</h4>
    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <!-- Basic Details -->
            <div class="col-12">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Basic Details</h5>
            </div>
            
            <div class="col-md-8">
                <label class="form-label">Course Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-4">
                <label class="form-label">Category <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Short Description</label>
                <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="2">{{ old('short_description') }}</textarea>
                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Full Description</label>
                <textarea name="full_description" class="form-control @error('full_description') is-invalid @enderror" rows="5">{{ old('full_description') }}</textarea>
                @error('full_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <!-- Media -->
            <div class="col-12 mt-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Media</h5>
            </div>
            <div class="col-md-6">
                <x-media-picker name="thumbnail" id="thumbnail" label="Course Thumbnail" :value="old('thumbnail')" />
            </div>

            <!-- Attributes -->
            <div class="col-12 mt-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Course Attributes</h5>
            </div>
            
            <div class="col-md-3">
                <label class="form-label">Duration</label>
                <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" placeholder="e.g. 6 Months">
                @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">Mode</label>
                <select name="mode" class="form-select @error('mode') is-invalid @enderror">
                    <option value="">Select Mode</option>
                    <option value="Online" {{ old('mode') == 'Online' ? 'selected' : '' }}>Online</option>
                    <option value="Offline" {{ old('mode') == 'Offline' ? 'selected' : '' }}>Offline</option>
                    <option value="Hybrid" {{ old('mode') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>
                @error('mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">Fee</label>
                <input type="text" name="fee" class="form-control @error('fee') is-invalid @enderror" value="{{ old('fee') }}" placeholder="e.g. ₹40,000">
                @error('fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">Technologies (comma separated)</label>
                <input type="text" name="technologies" class="form-control @error('technologies') is-invalid @enderror" value="{{ old('technologies') }}" placeholder="e.g. PHP, Laravel, Vue">
                @error('technologies')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Eligibility</label>
                <textarea name="eligibility" class="form-control @error('eligibility') is-invalid @enderror" rows="2">{{ old('eligibility') }}</textarea>
                @error('eligibility')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-4">
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="certification" value="1" id="certification" {{ old('certification') ? 'checked' : '' }}>
                    <label class="form-check-label" for="certification">Certification Provided</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="placement_support" value="1" id="placement_support" {{ old('placement_support') ? 'checked' : '' }}>
                    <label class="form-check-label" for="placement_support">Placement Support</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="featured" value="1" id="featured" {{ old('featured') ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">Featured Course</label>
                </div>
            </div>

            <!-- SEO & Status -->
            <div class="col-12 mt-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">SEO & Status</h5>
            </div>

            <div class="col-md-6">
                <label class="form-label">SEO Title</label>
                <input type="text" name="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title') }}">
                @error('seo_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">SEO Description</label>
                <textarea name="seo_description" class="form-control @error('seo_description') is-invalid @enderror" rows="2">{{ old('seo_description') }}</textarea>
                @error('seo_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange">Save & Continue to Modules</button>
            </div>
        </div>
    </form>
</div>
@endsection
