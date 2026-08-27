@extends('layouts.admin')

@section('title', 'Trainings & Programs')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-graduation-cap text-orange me-2"></i>Trainings & Programs
    </h4>
    <a href="{{ route('admin.trainings.create') }}" class="btn btn-orange">
        <i class="fas fa-plus-circle me-1"></i> Add New Training
    </a>
</div>

<div class="admin-card p-4 mb-4">
    <form action="{{ route('admin.trainings.index') }}" method="GET" class="row gy-3 gx-3 align-items-center">
        <div class="col-12 col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Search by title..." value="{{ request('q') }}">
            </div>
        </div>
        <div class="col-12 col-md-4">
            <select name="type" class="form-select">
                <option value="">All Types</option>
                <option value="summer" {{ request('type') == 'summer' ? 'selected' : '' }}>Summer</option>
                <option value="winter" {{ request('type') == 'winter' ? 'selected' : '' }}>Winter</option>
                <option value="industrial" {{ request('type') == 'industrial' ? 'selected' : '' }}>Industrial</option>
                <option value="internship" {{ request('type') == 'internship' ? 'selected' : '' }}>Internship</option>
                <option value="corporate" {{ request('type') == 'corporate' ? 'selected' : '' }}>Corporate</option>
                <option value="workshop" {{ request('type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
            </select>
        </div>
        <div class="col-12 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
            @if(request('q') || request('type'))
                <a href="{{ route('admin.trainings.index') }}" class="btn btn-outline-secondary">Clear</a>
            @endif
        </div>
    </form>
</div>

<div class="admin-card">
    @if($trainings->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Title & Type</th>
                        <th>Course Link</th>
                        <th>Dates</th>
                        <th>Registration</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($trainings as $training)
                    <tr>
                        <td class="ps-4">
                            <strong class="text-navy d-block mb-1">{{ $training->title }}</strong>
                            @php
                                $typeIcons = [
                                    'summer' => 'fa-sun text-warning',
                                    'winter' => 'fa-snowflake text-info',
                                    'industrial' => 'fa-industry text-secondary',
                                    'internship' => 'fa-briefcase text-primary',
                                    'corporate' => 'fa-building text-dark',
                                    'workshop' => 'fa-tools text-danger',
                                ];
                                $iconClass = $typeIcons[strtolower($training->type)] ?? 'fa-graduation-cap text-muted';
                            @endphp
                            <span class="badge bg-light text-dark border px-2 py-1 shadow-sm">
                                <i class="fas {{ $iconClass }} me-1"></i> {{ ucfirst($training->type) }}
                            </span>
                        </td>
                        <td>
                            @if($training->course)
                                <a href="{{ route('admin.courses.edit', $training->course) }}" class="badge bg-primary-subtle text-primary border border-primary border-opacity-25 px-2 py-1 shadow-sm text-decoration-none btn-hover-lift d-inline-block">
                                    <i class="fas fa-link" style="font-size: 0.7rem;"></i> {{ $training->course->title }}
                                </a>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td>
                            @if($training->start_date || $training->end_date)
                                <span class="text-dark fw-medium">
                                    <i class="fas fa-calendar-alt text-muted me-1"></i>
                                    {{ $training->start_date ? $training->start_date->format('M d, Y') : '?' }} - 
                                    {{ $training->end_date ? $training->end_date->format('M d, Y') : '?' }}
                                </span>
                            @else
                                <span class="text-muted small"><i class="fas fa-calendar-times me-1 opacity-50"></i>Not specified</span>
                            @endif
                        </td>
                        <td>
                            @if($training->registration_status == 'open')
                                <span class="badge bg-success-subtle text-success border-0 px-2 py-1 shadow-sm">
                                    <i class="fas fa-door-open ms-1" style="font-size: 0.7rem; vertical-align: middle;"></i> Open
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border-0 px-2 py-1 shadow-sm">
                                    <i class="fas fa-door-closed ms-1" style="font-size: 0.7rem; vertical-align: middle;"></i> Closed
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($training->status == 'published')
                                <span class="badge bg-success-subtle text-success border-0 px-2 py-1 shadow-sm">
                                    <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Published
                                </span>
                            @elseif($training->status == 'draft')
                                <span class="badge bg-secondary-subtle text-secondary border-0 px-2 py-1 shadow-sm">
                                    <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Draft
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning-emphasis border-0 px-2 py-1 shadow-sm">
                                    <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Archived
                                </span>
                            @endif
                        </td>
                        <td class="text-end pe-4 text-nowrap">
                            <a href="{{ route('admin.trainings.edit', $training) }}" class="btn btn-sm btn-outline-primary fw-medium me-1 btn-hover-lift">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger px-3 delete-btn btn-hover-lift" 
                                data-id="{{ $training->id }}" 
                                data-title="{{ $training->title }}" 
                                title="Delete Training" data-bs-toggle="tooltip">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $training->id }}" action="{{ route('admin.trainings.destroy', $training) }}" method="POST" class="d-none">
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
            {{ $trainings->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center">
            <div class="mb-3">
                <i class="fas fa-graduation-cap fa-4x text-muted opacity-25"></i>
            </div>
            <h5 class="fw-bold text-navy">No Trainings Found</h5>
            <p class="text-muted mb-4">You haven't added any trainings yet, or your search returned no results.</p>
            <a href="{{ route('admin.trainings.create') }}" class="btn btn-orange">
                <i class="fas fa-plus me-1"></i> Add Your First Training
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
                <h4 class="fw-bold mb-3">Delete Training?</h4>
                <p class="text-muted mb-4">Are you sure you want to delete the training "<span id="deleteTrainingTitle" class="fw-bold text-dark"></span>"? This action cannot be undone.</p>
                <div class="d-flex gap-2 justify-content-center">
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
                
                document.getElementById('deleteTrainingTitle').textContent = title;
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
