@extends('layouts.admin')

@section('title', 'Add Course')

@section('content')
<!-- Multi-step Indicator -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}" class="text-decoration-none text-muted">Courses</a></li>
            <li class="breadcrumb-item active fw-bold text-navy" aria-current="page">Step 1: Course Details</li>
        </ol>
    </nav>
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <h4 class="mb-0 text-navy fw-bold">
            <i class="fas fa-plus-circle text-orange me-2"></i>Add New Course
        </h4>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
    </div>
</div>

<form action="{{ route('admin.courses.store') }}" method="POST" id="courseForm">
    @csrf
    
    <div class="row">
        <!-- Main Form Column (Desktop) -->
        <div class="col-lg-8 col-12">
            
            <!-- Basic Details -->
            <x-form-section title="Basic Details" icon="fas fa-info-circle">
                <div class="row gy-4">
                    <div class="col-md-7 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-book text-muted me-1"></i> Course Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required placeholder="e.g. Master in Data Science">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-5 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-tags text-muted me-1"></i> Category <span class="text-danger">*</span>
                        </label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-align-left text-muted me-1"></i> Short Description
                        </label>
                        <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="2" placeholder="Brief summary for course cards...">{{ old('short_description') }}</textarea>
                        @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-align-justify text-muted me-1"></i> Full Description
                        </label>
                        <textarea name="full_description" class="form-control @error('full_description') is-invalid @enderror" rows="6" placeholder="Comprehensive course details...">{{ old('full_description') }}</textarea>
                        @error('full_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Course Attributes -->
            <x-form-section title="Course Attributes" icon="fas fa-sliders-h">
                <div class="row gy-4">
                    <div class="col-md-6 col-lg-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-clock text-muted me-1"></i> Duration
                        </label>
                        <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" placeholder="e.g. 6 Months">
                        @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-laptop-house text-muted me-1"></i> Mode
                        </label>
                        <select name="mode" class="form-select @error('mode') is-invalid @enderror">
                            <option value="">Select Mode</option>
                            <option value="Online" {{ old('mode') == 'Online' ? 'selected' : '' }}>Online</option>
                            <option value="Offline" {{ old('mode') == 'Offline' ? 'selected' : '' }}>Offline</option>
                            <option value="Hybrid" {{ old('mode') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-rupee-sign text-muted me-1"></i> Fee
                        </label>
                        <input type="text" name="fee" class="form-control @error('fee') is-invalid @enderror" value="{{ old('fee') }}" placeholder="e.g. 14,000">
                        @error('fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-code text-muted me-1"></i> Tech (CSV)
                        </label>
                        <input type="text" name="technologies" id="techInput" class="form-control @error('technologies') is-invalid @enderror" value="{{ old('technologies') }}" placeholder="e.g. PHP, Laravel">
                        @error('technologies')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <!-- Live Tag Preview -->
                    <div class="col-12 mt-2 d-none" id="techPreviewContainer">
                        <div class="d-flex flex-wrap gap-2" id="techTags"></div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-check-square text-muted me-1"></i> Eligibility
                        </label>
                        <textarea name="eligibility" class="form-control @error('eligibility') is-invalid @enderror" rows="2" placeholder="e.g. B.Tech / MCA / BCA">{{ old('eligibility') }}</textarea>
                        @error('eligibility')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Course Highlights (Flags) -->
            <div class="card shadow-sm border-0 mb-4 bg-light">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-navy mb-4"><i class="fas fa-star text-warning me-2"></i>Course Highlights</h6>
                    <div class="row gy-3">
                        <div class="col-md-4">
                            <div class="form-check form-switch d-flex align-items-center gap-2">
                                <input class="form-check-input fs-5 m-0" type="checkbox" role="switch" name="certification" value="1" id="certification" {{ old('certification') ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium ms-2" for="certification">
                                    <i class="fas fa-certificate text-primary me-1"></i> Certification Provided
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch d-flex align-items-center gap-2">
                                <input class="form-check-input fs-5 m-0" type="checkbox" role="switch" name="placement_support" value="1" id="placement_support" {{ old('placement_support') ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium ms-2" for="placement_support">
                                    <i class="fas fa-briefcase text-success me-1"></i> Placement Support
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch d-flex align-items-center gap-2">
                                <input class="form-check-input fs-5 m-0" type="checkbox" role="switch" name="featured" value="1" id="featured" {{ old('featured') ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium ms-2" for="featured">
                                    <i class="fas fa-fire text-orange me-1"></i> Featured Course
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column (Desktop) -->
        <div class="col-lg-4 col-12">
            
            <!-- Media -->
            <x-form-section title="Media" icon="fas fa-image">
                <x-media-picker name="thumbnail" id="thumbnail" label="Course Thumbnail" :value="old('thumbnail')" />
                @error('thumbnail')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </x-form-section>

            <!-- SEO Settings -->
            <x-form-section title="SEO Settings" icon="fas fa-search">
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-heading text-muted me-1"></i> SEO Title
                    </label>
                    <input type="text" name="seo_title" id="seoTitle" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title') }}">
                    <div class="form-text text-end small"><span id="seoTitleCount">0</span>/60</div>
                    @error('seo_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="form-label fw-semibold">
                        <i class="fas fa-align-left text-muted me-1"></i> SEO Description
                    </label>
                    <textarea name="seo_description" id="seoDesc" class="form-control @error('seo_description') is-invalid @enderror" rows="3">{{ old('seo_description') }}</textarea>
                    <div class="form-text text-end small"><span id="seoDescCount">0</span>/160</div>
                    @error('seo_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </x-form-section>

            <!-- Status & Actions -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-navy mb-3"><i class="fas fa-eye text-muted me-2"></i>Publishing</h6>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <button type="submit" class="btn btn-orange w-100 py-2 fw-semibold btn-hover-lift" id="submitBtn">
                        <span class="normal-state"><i class="fas fa-arrow-right me-1"></i> Save & Continue to Modules</span>
                        <span class="loading-state d-none">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Saving...
                        </span>
                    </button>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-light w-100 mt-2 text-muted">
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
    .form-switch .form-check-input:checked { background-color: var(--bs-primary); border-color: var(--bs-primary); }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tech Tags Logic
        const techInput = document.getElementById('techInput');
        const previewContainer = document.getElementById('techPreviewContainer');
        const tagsContainer = document.getElementById('techTags');

        function updateTags() {
            const val = techInput.value.trim();
            tagsContainer.innerHTML = '';
            if (val) {
                previewContainer.classList.remove('d-none');
                const tags = val.split(',').map(t => t.trim()).filter(t => t);
                tags.forEach(tag => {
                    const span = document.createElement('span');
                    span.className = 'badge bg-dark-subtle text-dark border px-2 py-1 shadow-sm';
                    span.innerHTML = `<i class="fas fa-code me-1 text-muted"></i>${tag}`;
                    tagsContainer.appendChild(span);
                });
            } else {
                previewContainer.classList.add('d-none');
            }
        }
        techInput.addEventListener('input', updateTags);
        updateTags(); // Init

        // SEO Counters Logic
        const titleInput = document.getElementById('seoTitle');
        const titleCount = document.getElementById('seoTitleCount');
        const descInput = document.getElementById('seoDesc');
        const descCount = document.getElementById('seoDescCount');

        const updateCount = (input, counter, max) => {
            const len = input.value.length;
            counter.textContent = len;
            if (len > max) {
                counter.classList.add('text-danger', 'fw-bold');
            } else {
                counter.classList.remove('text-danger', 'fw-bold');
            }
        };

        titleInput.addEventListener('input', () => updateCount(titleInput, titleCount, 60));
        descInput.addEventListener('input', () => updateCount(descInput, descCount, 160));
        updateCount(titleInput, titleCount, 60);
        updateCount(descInput, descCount, 160);

        // Submit Loader
        const form = document.getElementById('courseForm');
        const btn = document.getElementById('submitBtn');
        form.addEventListener('submit', function() {
            btn.disabled = true;
            btn.querySelector('.normal-state').classList.add('d-none');
            btn.querySelector('.loading-state').classList.remove('d-none');
        });
    });
</script>
@endpush
@endsection
