@extends('layouts.admin')

@section('title', 'Edit Branch')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Edit Branch</h4>
    <a href="{{ route('admin.branches.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.branches.update', $branch) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            
            <div class="col-md-6">
                <label class="form-label">Branch Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $branch->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" name="is_head_office" value="1" id="is_head_office" {{ old('is_head_office', $branch->is_head_office) ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="is_head_office">
                        Set as Head Office
                    </label>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">Full Address <span class="text-danger">*</span></label>
                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address', $branch->address) }}</textarea>
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">City <span class="text-danger">*</span></label>
                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $branch->city) }}" required>
                @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">State</label>
                <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $branch->state) }}">
                @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Zip/Pin Code</label>
                <input type="text" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code', $branch->zip_code) }}">
                @error('zip_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $branch->phone) }}">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $branch->email) }}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Google Maps Embed Code (iframe)</label>
                <textarea name="map_embed_code" class="form-control @error('map_embed_code') is-invalid @enderror" rows="3">{{ old('map_embed_code', $branch->map_embed_code) }}</textarea>
                @error('map_embed_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Order Position <span class="text-danger">*</span></label>
                <input type="number" name="order_position" class="form-control @error('order_position') is-invalid @enderror" value="{{ old('order_position', $branch->order_position) }}" required>
                @error('order_position')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="published" {{ old('status', $branch->status) == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ old('status', $branch->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange">Update Branch</button>
            </div>
        </div>
    </form>
</div>
@endsection
