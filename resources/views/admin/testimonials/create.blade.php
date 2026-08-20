@extends('layouts.admin')

@section('title', 'Add Testimonial')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Add Testimonial</h4>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.testimonials.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            
            <div class="col-md-6">
                <label class="form-label">Reviewer Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Role / Company (Optional)</label>
                <input type="text" name="role_or_company" class="form-control @error('role_or_company') is-invalid @enderror" value="{{ old('role_or_company') }}" placeholder="e.g. Student at EduSkill / CEO at TechCorp">
                @error('role_or_company')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Testimonial Content <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="4" required>{{ old('content') }}</textarea>
                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Video URL (Optional - YouTube/Vimeo)</label>
                <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url') }}">
                @error('video_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Rating (1-5)</label>
                <select name="rating" class="form-select @error('rating') is-invalid @enderror">
                    <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>5 Stars</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Stars</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Stars</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Stars</option>
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star</option>
                </select>
                @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <x-media-picker name="photo" id="photo" label="Reviewer Photo" :value="old('photo')" />
            </div>

            <div class="col-md-4">
                <label class="form-label">Order Position <span class="text-danger">*</span></label>
                <input type="number" name="order_position" class="form-control @error('order_position') is-invalid @enderror" value="{{ old('order_position', 0) }}" required>
                @error('order_position')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange">Save Testimonial</button>
            </div>
        </div>
    </form>
</div>
@endsection
