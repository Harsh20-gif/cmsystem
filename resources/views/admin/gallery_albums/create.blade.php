@extends('layouts.admin')

@section('title', 'Create Album')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Create Gallery Album</h4>
    <a href="{{ route('admin.gallery-albums.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.gallery-albums.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            
            <div class="col-md-8">
                <label class="form-label">Album Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Description (Optional)</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <x-media-picker name="cover_image" id="cover_image" label="Cover Image" :value="old('cover_image')" />
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange">Save Album & Add Images</button>
            </div>
        </div>
    </form>
</div>
@endsection
