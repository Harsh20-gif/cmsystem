@extends('layouts.admin')

@section('title', 'Add Company')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Add Company</h4>
    <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.companies.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            
            <div class="col-md-6">
                <label class="form-label">Company Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label">Website (Optional)</label>
                <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}" placeholder="https://example.com">
                @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <x-media-picker name="logo" id="logo" label="Company Logo" :value="old('logo')" />
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange">Save Company</button>
            </div>
        </div>
    </form>
</div>
@endsection
