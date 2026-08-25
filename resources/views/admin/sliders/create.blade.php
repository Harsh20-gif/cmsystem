@extends('layouts.admin')

@section('title', 'Add Slider')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Add New Slider</h4>
    <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.sliders.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Title (Optional)</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Subtitle (Optional)</label>
                <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle') }}">
                @error('subtitle')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label">Link/URL (Optional)</label>
                <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}">
                @error('link')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">Order Position <span class="text-danger">*</span></label>
                <input type="number" name="order_position" class="form-control @error('order_position') is-invalid @enderror" value="{{ old('order_position', 0) }}" required>
                @error('order_position')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-12">
                <x-media-picker name="image" id="image" label="Slider Image" :value="old('image')" />
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange">Save Slider</button>
            </div>
        </div>
    </form>
</div>
@endsection
