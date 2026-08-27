@extends('layouts.admin')

@section('title', 'Edit Branch')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-edit text-orange me-2"></i>Edit Branch: {{ $branch->name }}
    </h4>
    <a href="{{ route('admin.branches.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.branches.update', $branch) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Main Form Column (Desktop) -->
        <div class="col-lg-8 col-12">
            
            <x-form-section title="Branch Info" icon="fas fa-building">
                <div class="row gy-4 align-items-end">
                    <div class="col-md-7 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-code-branch text-muted me-1"></i> Branch Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $branch->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-5 col-12">
                        <div class="form-check form-switch p-3 border rounded-3 transition-all" id="head-office-wrapper">
                            <input class="form-check-input ms-0 mt-1 me-2" type="checkbox" role="switch" name="is_head_office" value="1" id="is_head_office" {{ old('is_head_office', $branch->is_head_office) ? 'checked' : '' }} style="transform: scale(1.2);">
                            <label class="form-check-label fw-bold mb-0 ps-1 text-navy" for="is_head_office" style="cursor: pointer;">
                                <i class="fas fa-star text-warning me-1"></i> Set as Head Office
                            </label>
                        </div>
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Address Details" icon="fas fa-map-marked-alt">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-map-pin text-muted me-1"></i> Full Address <span class="text-danger">*</span>
                        </label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" required>{{ old('address', $branch->address) }}</textarea>
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-city text-muted me-1"></i> City <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $branch->city) }}" required>
                        @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-map text-muted me-1"></i> State
                        </label>
                        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $branch->state) }}">
                        @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-4 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-mail-bulk text-muted me-1"></i> Zip/Pin Code
                        </label>
                        <input type="text" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code', $branch->zip_code) }}">
                        @error('zip_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Contact Info" icon="fas fa-address-book">
                <div class="row gy-4">
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-phone text-muted me-1"></i> Phone Number
                        </label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $branch->phone) }}">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-envelope text-muted me-1"></i> Email Address
                        </label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $branch->email) }}">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Map" icon="fas fa-map">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-code text-muted me-1"></i> Google Maps Embed Code (iframe)
                        </label>
                        <textarea name="map_embed_code" id="map_embed_code" class="form-control @error('map_embed_code') is-invalid @enderror" rows="3">{{ old('map_embed_code', $branch->map_embed_code) }}</textarea>
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i> <strong>How to get this:</strong> Go to Google Maps → Search location → Click "Share" → "Embed a map" → Copy the HTML code and paste it here.
                        </div>
                        @error('map_embed_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <div id="map-preview-container" class="mt-2 d-none">
                            <label class="form-label fw-semibold small text-success"><i class="fas fa-check-circle me-1"></i> Live Map Preview</label>
                            <div id="map-preview" class="border rounded-3 overflow-hidden bg-light ratio ratio-16x9"></div>
                        </div>
                    </div>
                </div>
            </x-form-section>
            
        </div>

        <!-- Right Column (Desktop) -->
        <div class="col-lg-4 col-12">
            
            <x-form-section title="Display Settings" icon="fas fa-sliders-h">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-sort-numeric-down text-muted me-1"></i> Order Position <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="order_position" class="form-control @error('order_position') is-invalid @enderror" value="{{ old('order_position', $branch->order_position) }}" required>
                        <div class="form-text"><i class="fas fa-info-circle me-1"></i> Lower numbers appear first.</div>
                        @error('order_position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-eye text-muted me-1"></i> Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="published" {{ old('status', $branch->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ old('status', $branch->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Actions Area -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold">
                        <i class="fas fa-save me-1"></i> Update Branch
                    </button>
                    <a href="{{ route('admin.branches.index') }}" class="btn btn-light w-100 text-muted">
                        Cancel
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</form>

<style>
    .transition-all { transition: all 0.3s ease; }
    .head-office-active { background-color: rgba(255, 193, 7, 0.1) !important; border-color: #ffc107 !important; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Head Office Checkbox Highlight Logic
        const hoCheckbox = document.getElementById('is_head_office');
        const hoWrapper = document.getElementById('head-office-wrapper');

        function updateHoWrapper() {
            if(hoCheckbox.checked) {
                hoWrapper.classList.add('head-office-active');
            } else {
                hoWrapper.classList.remove('head-office-active');
            }
        }
        
        hoCheckbox.addEventListener('change', updateHoWrapper);
        updateHoWrapper(); // Run on load

        // Map Preview Logic
        const mapInput = document.getElementById('map_embed_code');
        const mapPreviewContainer = document.getElementById('map-preview-container');
        const mapPreview = document.getElementById('map-preview');

        function updateMapPreview() {
            const val = mapInput.value.trim();
            // Basic validation to check if it's an iframe
            if(val.toLowerCase().startsWith('<iframe') && val.toLowerCase().includes('src="https://www.google.com/maps')) {
                // To keep the ratio responsive, we force width and height to 100% on the iframe via regex
                let modifiedIframe = val.replace(/width="[^"]*"/i, 'width="100%"').replace(/height="[^"]*"/i, 'height="100%"');
                mapPreview.innerHTML = modifiedIframe;
                mapPreviewContainer.classList.remove('d-none');
            } else {
                mapPreview.innerHTML = '';
                mapPreviewContainer.classList.add('d-none');
            }
        }

        mapInput.addEventListener('input', updateMapPreview);
        updateMapPreview(); // Run on load
    });
</script>
@endpush
@endsection
