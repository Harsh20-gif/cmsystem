@extends('layouts.admin')

@section('title', 'Add Notice')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-plus-circle text-orange me-2"></i>Add New Notice
    </h4>
    <a href="{{ route('admin.notices.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.notices.store') }}" method="POST">
    @csrf
    
    <div class="row">
        <!-- Main Form Column (Desktop) -->
        <div class="col-lg-8 col-12">
            
            <x-form-section title="Notice Content" icon="fas fa-bullhorn">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-font text-muted me-1"></i> Notice Text / Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" id="notice-title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required placeholder="e.g. New Batch Starting Soon!">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-link text-muted me-1"></i> Link/URL <small class="text-muted fw-normal">(Optional)</small>
                        </label>
                        <input type="url" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" placeholder="https://example.com/...">
                        <div class="form-text"><i class="fas fa-info-circle me-1"></i> Ensure you enter a full, valid URL (starting with http:// or https://).</div>
                        @error('link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <!-- Live Marquee Preview Box -->
                    <div class="col-12 d-none" id="marquee-preview-container">
                        <label class="form-label fw-semibold text-primary small">
                            <i class="fas fa-eye me-1"></i> Live Marquee Preview
                        </label>
                        <div class="border rounded bg-dark text-white p-2 overflow-hidden shadow-sm">
                            <marquee behavior="scroll" direction="left" scrollamount="6" class="m-0 py-1" id="marquee-preview-text">
                                Your notice text will scroll like this...
                            </marquee>
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
                            <i class="fas fa-columns text-muted me-1"></i> Display Area <span class="text-danger">*</span>
                        </label>
                        <select name="type" id="display-area-select" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="board" {{ old('type') == 'board' ? 'selected' : '' }}>Notice Board</option>
                            <option value="marquee" {{ old('type') == 'marquee' ? 'selected' : '' }}>Scrolling Marquee</option>
                        </select>
                        <div class="form-text small mt-2">
                            <i class="fas fa-info-circle text-primary me-1"></i> 
                            <span id="display-help-text"><strong>Notice Board:</strong> shown in a static list on the page.</span>
                        </div>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-eye text-muted me-1"></i> Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Actions Area -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold">
                        <i class="fas fa-save me-1"></i> Save Notice
                    </button>
                    <a href="{{ route('admin.notices.index') }}" class="btn btn-light w-100 text-muted">
                        Cancel
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('notice-title');
        const displaySelect = document.getElementById('display-area-select');
        const helpText = document.getElementById('display-help-text');
        
        const previewContainer = document.getElementById('marquee-preview-container');
        const previewText = document.getElementById('marquee-preview-text');

        function updateUI() {
            // Update helper text
            if (displaySelect.value === 'marquee') {
                helpText.innerHTML = '<strong>Marquee:</strong> scrolls continuously across the screen.';
                previewContainer.classList.remove('d-none');
            } else {
                helpText.innerHTML = '<strong>Notice Board:</strong> shown in a static list on the page.';
                previewContainer.classList.add('d-none');
            }

            // Update marquee preview text
            if (titleInput.value.trim() !== '') {
                previewText.textContent = titleInput.value;
            } else {
                previewText.textContent = 'Your notice text will scroll like this...';
            }
        }

        titleInput.addEventListener('input', updateUI);
        displaySelect.addEventListener('change', updateUI);
        
        // Initial setup on load
        updateUI();
    });
</script>
@endpush
@endsection
