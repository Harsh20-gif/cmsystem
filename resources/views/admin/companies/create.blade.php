@extends('layouts.admin')

@section('title', 'Add Company')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-plus-circle text-orange me-2"></i>Add Company
    </h4>
    <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.companies.store') }}" method="POST" id="companyForm">
    @csrf
    
    <div class="row">
        <!-- Main Form Column (Desktop) -->
        <div class="col-lg-8 col-12">
            
            <!-- Company Info Section -->
            <x-form-section title="Company Info" icon="fas fa-building">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-building text-muted me-1"></i> Company Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-link text-muted me-1"></i> Website (Optional)
                        </label>
                        <input type="url" name="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}" placeholder="https://example.com">
                        @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>
            
        </div>

        <!-- Right Column (Desktop) -->
        <div class="col-lg-4 col-12">
            
            <!-- Logo Section -->
            <x-form-section title="Company Logo" icon="fas fa-image">
                <div class="row gy-4">
                    <div class="col-12">
                        <x-media-picker name="logo" id="logo" label="Select Logo" :value="old('logo')" />
                        @error('logo')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Actions Area -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold btn-hover-lift" id="submitBtn">
                        <span class="normal-state"><i class="fas fa-save me-1"></i> Save Company</span>
                        <span class="loading-state d-none">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Saving...
                        </span>
                    </button>
                    <a href="{{ route('admin.companies.index') }}" class="btn btn-light w-100 text-muted">
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
        // Submit Loader
        const form = document.getElementById('companyForm');
        const btn = document.getElementById('submitBtn');
        if (form && btn) {
            form.addEventListener('submit', function() {
                btn.disabled = true;
                btn.querySelector('.normal-state').classList.add('d-none');
                btn.querySelector('.loading-state').classList.remove('d-none');
            });
        }
    });
</script>
@endpush
@endsection
