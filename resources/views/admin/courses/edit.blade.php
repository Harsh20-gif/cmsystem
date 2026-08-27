@extends('layouts.admin')

@section('title', 'Edit Course')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Edit Course: {{ $course->title }}</h4>
    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<ul class="nav nav-tabs mb-4" id="courseTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">Basic Details</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="modules-tab" data-bs-toggle="tab" data-bs-target="#modules" type="button" role="tab">Modules</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="faqs-tab" data-bs-toggle="tab" data-bs-target="#faqs" type="button" role="tab">FAQs</button>
    </li>
</ul>

<div class="tab-content" id="courseTabsContent">
    <!-- Basic Details Tab -->
    <div class="tab-pane fade show active" id="details" role="tabpanel">
        <form action="{{ route('admin.courses.update', $course) }}" method="POST" id="courseForm">
            @csrf
            @method('PUT')
            
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
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $course->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-5 col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-tags text-muted me-1"></i> Category <span class="text-danger">*</span>
                                </label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-align-left text-muted me-1"></i> Short Description
                                </label>
                                <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="2">{{ old('short_description', $course->short_description) }}</textarea>
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-align-justify text-muted me-1"></i> Full Description
                                </label>
                                <textarea name="full_description" class="form-control @error('full_description') is-invalid @enderror" rows="6">{{ old('full_description', $course->full_description) }}</textarea>
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
                                <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $course->duration) }}">
                                @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-laptop-house text-muted me-1"></i> Mode
                                </label>
                                <select name="mode" class="form-select @error('mode') is-invalid @enderror">
                                    <option value="">Select Mode</option>
                                    <option value="Online" {{ old('mode', $course->mode) == 'Online' ? 'selected' : '' }}>Online</option>
                                    <option value="Offline" {{ old('mode', $course->mode) == 'Offline' ? 'selected' : '' }}>Offline</option>
                                    <option value="Hybrid" {{ old('mode', $course->mode) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                </select>
                                @error('mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-rupee-sign text-muted me-1"></i> Fee
                                </label>
                                <input type="text" name="fee" class="form-control @error('fee') is-invalid @enderror" value="{{ old('fee', $course->fee) }}">
                                @error('fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-code text-muted me-1"></i> Tech (CSV)
                                </label>
                                <input type="text" name="technologies" id="techInput" class="form-control @error('technologies') is-invalid @enderror" value="{{ old('technologies', $course->technologies_str) }}">
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
                                <textarea name="eligibility" class="form-control @error('eligibility') is-invalid @enderror" rows="2">{{ old('eligibility', $course->eligibility) }}</textarea>
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
                                        <input class="form-check-input fs-5 m-0" type="checkbox" role="switch" name="certification" value="1" id="certification" {{ old('certification', $course->certification) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-medium ms-2" for="certification">
                                            <i class="fas fa-certificate text-primary me-1"></i> Certification Provided
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch d-flex align-items-center gap-2">
                                        <input class="form-check-input fs-5 m-0" type="checkbox" role="switch" name="placement_support" value="1" id="placement_support" {{ old('placement_support', $course->placement_support) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-medium ms-2" for="placement_support">
                                            <i class="fas fa-briefcase text-success me-1"></i> Placement Support
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch d-flex align-items-center gap-2">
                                        <input class="form-check-input fs-5 m-0" type="checkbox" role="switch" name="featured" value="1" id="featured" {{ old('featured', $course->featured) ? 'checked' : '' }}>
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
                        <x-media-picker name="thumbnail" id="thumbnail" label="Course Thumbnail" :value="old('thumbnail', $course->thumbnail)" />
                        @error('thumbnail')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </x-form-section>

                    <!-- SEO Settings -->
                    <x-form-section title="SEO Settings" icon="fas fa-search">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-heading text-muted me-1"></i> SEO Title
                            </label>
                            <input type="text" name="seo_title" id="seoTitle" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title', $course->seo_title) }}">
                            <div class="form-text text-end small"><span id="seoTitleCount">0</span>/60</div>
                            @error('seo_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="form-label fw-semibold">
                                <i class="fas fa-align-left text-muted me-1"></i> SEO Description
                            </label>
                            <textarea name="seo_description" id="seoDesc" class="form-control @error('seo_description') is-invalid @enderror" rows="3">{{ old('seo_description', $course->seo_description) }}</textarea>
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
                                    <option value="draft" {{ old('status', $course->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status', $course->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <button type="submit" class="btn btn-orange w-100 py-2 fw-semibold btn-hover-lift" id="submitBtn">
                                <span class="normal-state"><i class="fas fa-save me-1"></i> Update Course</span>
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
    </div>
    <!-- Modules Tab -->
    <div class="tab-pane fade" id="modules" role="tabpanel">
        <div class="admin-card p-4 mb-4 bg-light border-0">
            <h5 class="fw-bold">Add New Module</h5>
            <form action="{{ route('admin.courses.modules.store', $course) }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-5">
                        <input type="text" name="title" class="form-control" placeholder="Module Title" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="description" class="form-control" placeholder="Short Description (Optional)">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="order_position" class="form-control" placeholder="Order" value="{{ $course->modules->count() + 1 }}" required>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-orange w-100">+</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="admin-card p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($course->modules as $module)
                    <tr>
                        <td>{{ $module->order_position }}</td>
                        <td><strong>{{ $module->title }}</strong></td>
                        <td>{{ $module->description }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModuleModal{{ $module->id }}">Edit</button>
                            <form action="{{ route('admin.modules.destroy', $module) }}" method="POST" class="d-inline" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    
                    <!-- Edit Module Modal -->
                    <div class="modal fade" id="editModuleModal{{ $module->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content text-start">
                                <form action="{{ route('admin.modules.update', $module) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Module</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ $module->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control">{{ $module->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Order</label>
                                            <input type="number" name="order_position" class="form-control" value="{{ $module->order_position }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-orange">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr><td colspan="4" class="text-center py-3 text-muted">No modules added yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- FAQs Tab -->
    <div class="tab-pane fade" id="faqs" role="tabpanel">
        <div class="admin-card p-4 mb-4 bg-light border-0">
            <h5 class="fw-bold">Add New FAQ</h5>
            <form action="{{ route('admin.courses.faqs.store', $course) }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-10">
                        <input type="text" name="question" class="form-control mb-2" placeholder="Question" required>
                        <textarea name="answer" class="form-control" rows="2" placeholder="Answer" required></textarea>
                    </div>
                    <div class="col-md-2 d-flex flex-column gap-2">
                        <input type="number" name="order_position" class="form-control" placeholder="Order" value="{{ $course->faqs->count() + 1 }}" required>
                        <button type="submit" class="btn btn-orange w-100">Add FAQ</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="admin-card p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order</th>
                        <th>Question / Answer</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($course->faqs as $faq)
                    <tr>
                        <td>{{ $faq->order_position }}</td>
                        <td>
                            <strong>{{ $faq->question }}</strong>
                            <p class="mb-0 text-muted small">{{ $faq->answer }}</p>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editFaqModal{{ $faq->id }}">Edit</button>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    
                    <!-- Edit FAQ Modal -->
                    <div class="modal fade" id="editFaqModal{{ $faq->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content text-start">
                                <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit FAQ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Question</label>
                                            <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Answer</label>
                                            <textarea name="answer" class="form-control" rows="3" required>{{ $faq->answer }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Order</label>
                                            <input type="number" name="order_position" class="form-control" value="{{ $faq->order_position }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-orange">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr><td colspan="3" class="text-center py-3 text-muted">No FAQs added yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .btn-hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .btn-hover-lift:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important; }
    .form-switch .form-check-input:checked { background-color: var(--bs-primary); border-color: var(--bs-primary); }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Remember active tab on reload
        let activeTab = localStorage.getItem('courseActiveTab');
        if (activeTab) {
            let tab = new bootstrap.Tab(document.querySelector(activeTab));
            tab.show();
        }

        document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(function(el) {
            el.addEventListener('shown.bs.tab', function (e) {
                localStorage.setItem('courseActiveTab', '#' + e.target.id);
            });
        });

        // Tech Tags Logic
        const techInput = document.getElementById('techInput');
        if (techInput) {
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
                        span.innerHTML = <i class="fas fa-code me-1 text-muted"></i> + tag;
                        tagsContainer.appendChild(span);
                    });
                } else {
                    previewContainer.classList.add('d-none');
                }
            }
            techInput.addEventListener('input', updateTags);
            updateTags(); // Init
        }

        // SEO Counters Logic
        const titleInput = document.getElementById('seoTitle');
        const titleCount = document.getElementById('seoTitleCount');
        const descInput = document.getElementById('seoDesc');
        const descCount = document.getElementById('seoDescCount');

        const updateCount = (input, counter, max) => {
            if(!input || !counter) return;
            const len = input.value.length;
            counter.textContent = len;
            if (len > max) {
                counter.classList.add('text-danger', 'fw-bold');
            } else {
                counter.classList.remove('text-danger', 'fw-bold');
            }
        };

        if(titleInput) {
            titleInput.addEventListener('input', () => updateCount(titleInput, titleCount, 60));
            updateCount(titleInput, titleCount, 60);
        }
        if(descInput) {
            descInput.addEventListener('input', () => updateCount(descInput, descCount, 160));
            updateCount(descInput, descCount, 160);
        }

        // Submit Loader
        const form = document.getElementById('courseForm');
        const btn = document.getElementById('submitBtn');
        if(form && btn) {
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


