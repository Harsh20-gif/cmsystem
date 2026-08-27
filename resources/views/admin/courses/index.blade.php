@extends('layouts.admin')

@section('title', 'Courses')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-book-open text-orange me-2"></i>Courses
    </h4>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-orange">
        <i class="fas fa-plus-circle me-1"></i> Add New Course
    </a>
</div>

<div class="admin-card p-4 mb-4">
    <form action="{{ route('admin.courses.index') }}" method="GET" class="row gy-3 gx-3 align-items-center">
        <div class="col-12 col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Search by title..." value="{{ request('q') }}">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <select name="category_id" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-3">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>
        <div class="col-12 col-md-2">
            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
        </div>
    </form>
</div>

<div class="admin-card">
    @if($courses->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Title</th>
                        <th>Category</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($courses as $course)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center py-1">
                                @if($course->thumbnail)
                                    <img src="{{ Storage::url($course->thumbnail) }}" alt="Thumbnail" class="rounded me-3 shadow-sm border" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center border shadow-sm" style="width: 50px; height: 50px;">
                                        <i class="fas fa-image text-muted opacity-50"></i>
                                    </div>
                                @endif
                                <div>
                                    <strong class="text-navy fs-6">{{ $course->title }}</strong><br>
                                    <small class="text-muted font-monospace bg-light px-1 rounded">{{ $course->slug }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($course->category)
                                <span class="badge bg-info-subtle text-info border border-info border-opacity-25 px-2 py-1 rounded-pill shadow-sm">
                                    <i class="fas fa-tag me-1" style="font-size: 0.7rem;"></i>{{ $course->category->name }}
                                </span>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-dark fw-medium">
                                <i class="fas fa-clock text-muted me-1"></i>{{ $course->duration }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1 flex-wrap">
                                @if($course->status == 'published')
                                    <span class="badge bg-success-subtle text-success border-0 px-2 py-1 shadow-sm">
                                        <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Published
                                    </span>
                                @elseif($course->status == 'draft')
                                    <span class="badge bg-secondary-subtle text-secondary border-0 px-2 py-1 shadow-sm">
                                        <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Draft
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning-emphasis border-0 px-2 py-1 shadow-sm">
                                        <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Archived
                                    </span>
                                @endif
                                
                                @if($course->featured)
                                    <span class="badge bg-primary-subtle text-primary border border-primary border-opacity-25 px-2 py-1 shadow-sm">
                                        <i class="fas fa-star text-warning" style="font-size: 0.7rem;"></i> Featured
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="text-end pe-4 text-nowrap">
                            <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-outline-primary fw-medium me-1 btn-hover-lift">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger px-3 delete-btn btn-hover-lift" 
                                data-id="{{ $course->id }}" 
                                data-title="{{ $course->title }}" 
                                title="Delete Course" data-bs-toggle="tooltip">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $course->id }}" action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $courses->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center">
            <div class="mb-3">
                <i class="fas fa-book-open fa-4x text-muted opacity-25"></i>
            </div>
            <h5 class="fw-bold text-navy">No Courses Found</h5>
            <p class="text-muted mb-4">You haven't added any courses yet, or your search returned no results.</p>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-orange">
                <i class="fas fa-plus me-1"></i> Add Your First Course
            </a>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pt-0 px-4 pb-4">
                <div class="mb-3 text-danger">
                    <i class="fas fa-exclamation-triangle fa-4x"></i>
                </div>
                <h4 class="fw-bold mb-3">Delete Course?</h4>
                <p class="text-muted mb-2">Are you sure you want to delete the course "<span id="deleteCourseTitle" class="fw-bold text-dark"></span>"?</p>
                <div class="alert alert-danger py-2 mb-4">
                    <i class="fas fa-exclamation-circle me-1"></i> 
                    <strong>Warning:</strong> Deleting this course will also remove all its modules and associated data. This cannot be undone.
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .btn-hover-lift:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Delete Modal Logic
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        let currentFormId = null;

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                
                document.getElementById('deleteCourseTitle').textContent = title;
                currentFormId = 'delete-form-' + id;
                
                deleteModal.show();
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (currentFormId) {
                const form = document.getElementById(currentFormId);
                const clone = form.cloneNode(true);
                form.parentNode.replaceChild(clone, form);
                clone.submit();
            }
        });
    });
</script>
@endpush
@endsection
