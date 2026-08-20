@extends('layouts.admin')

@section('title', 'Add Team Member')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Add Team Member</h4>
    <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.team-members.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            
            <div class="col-md-6">
                <label class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Role / Designation <span class="text-danger">*</span></label>
                <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}" required>
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">LinkedIn URL</label>
                <input type="url" name="linkedin_url" class="form-control @error('linkedin_url') is-invalid @enderror" value="{{ old('linkedin_url') }}">
                @error('linkedin_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Twitter URL</label>
                <input type="url" name="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" value="{{ old('twitter_url') }}">
                @error('twitter_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label">Order Position <span class="text-danger">*</span></label>
                <input type="number" name="order_position" class="form-control @error('order_position') is-invalid @enderror" value="{{ old('order_position', 0) }}" required>
                @error('order_position')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Bio (Optional)</label>
                <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="3">{{ old('bio') }}</textarea>
                @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <x-media-picker name="photo" id="photo" label="Profile Photo" :value="old('photo')" />
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange">Save Team Member</button>
            </div>
        </div>
    </form>
</div>
@endsection
