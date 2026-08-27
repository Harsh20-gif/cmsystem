@extends('layouts.admin')

@section('title', 'Placements')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-briefcase text-orange me-2"></i>Placements
    </h4>
    <a href="{{ route('admin.placements.create') }}" class="btn btn-orange">
        <i class="fas fa-plus-circle me-1"></i> Add New Placement
    </a>
</div>

<div class="admin-card p-4 mb-4">
    <form action="{{ route('admin.placements.index') }}" method="GET" class="row gy-3 gx-3 align-items-center">
        <div class="col-12 col-md-5">
            <select name="student_id" class="form-select" onchange="this.form.submit()">
                <option value="">Filter by Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-5">
            <select name="company_id" class="form-select" onchange="this.form.submit()">
                <option value="">Filter by Company</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-2">
            <a href="{{ route('admin.placements.index') }}" class="btn btn-outline-secondary w-100 {{ (!request('student_id') && !request('company_id')) ? 'disabled' : '' }}">
                <i class="fas fa-times me-1"></i> Clear
            </a>
        </div>
    </form>
</div>

<div class="admin-card">
    @if($placements->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Student</th>
                        <th>Company</th>
                        <th>Position & Package</th>
                        <th>Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($placements as $placement)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center py-2">
                                @if($placement->student->photo)
                                    <img src="{{ Storage::url($placement->student->photo) }}" alt="{{ $placement->student->name }}" class="rounded-circle me-3 border border-2 border-primary p-1 shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle me-3 border border-2 border-primary d-flex align-items-center justify-content-center bg-primary-subtle text-primary fw-bold shadow-sm" style="width: 45px; height: 45px; font-size: 1.1rem;">
                                        {{ strtoupper(substr($placement->student->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <strong class="text-navy fs-6 d-block">{{ $placement->student->name }}</strong>
                                    <span class="badge bg-light text-dark border mt-1 fw-normal shadow-sm">
                                        <i class="fas fa-book-open text-muted me-1" style="font-size: 0.7rem;"></i>{{ $placement->student->course_enrolled }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($placement->company->logo)
                                    <img src="{{ Storage::url($placement->company->logo) }}" alt="{{ $placement->company->name }}" class="rounded border border-2 border-primary border-opacity-10 shadow-sm bg-white me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="rounded bg-light text-muted d-flex align-items-center justify-content-center shadow-sm border me-2" style="width: 40px; height: 40px;">
                                        <i class="fas fa-building fs-6 opacity-50"></i>
                                    </div>
                                @endif
                                <span class="fw-medium text-dark">{{ $placement->company->name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1"><strong class="text-dark">{{ $placement->position }}</strong></div>
                            @if($placement->package)
                                <span class="badge bg-success-subtle text-success border-0 px-2 py-1 shadow-sm">
                                    <i class="fas fa-rupee-sign ms-1" style="font-size: 0.7rem; vertical-align: middle;"></i> {{ $placement->package }}
                                </span>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td>
                            @if($placement->placement_date)
                                <span class="text-dark fw-medium">
                                    <i class="fas fa-calendar-alt text-muted me-1"></i>
                                    {{ $placement->placement_date->format('M Y') }}
                                </span>
                            @else
                                <span class="text-muted small"><i class="fas fa-calendar-times me-1 opacity-50"></i>—</span>
                            @endif
                        </td>
                        <td class="text-end pe-4 text-nowrap">
                            <a href="{{ route('admin.placements.edit', $placement) }}" class="btn btn-sm btn-outline-primary fw-medium me-1 btn-hover-lift">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger px-3 delete-btn btn-hover-lift" 
                                data-id="{{ $placement->id }}" 
                                data-title="{{ $placement->student->name }}'s Placement" 
                                title="Delete Placement" data-bs-toggle="tooltip">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $placement->id }}" action="{{ route('admin.placements.destroy', $placement) }}" method="POST" class="d-none">
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
            {{ $placements->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center">
            <div class="mb-3">
                <i class="fas fa-briefcase fa-4x text-muted opacity-25"></i>
            </div>
            <h5 class="fw-bold text-navy">No Placements Found</h5>
            <p class="text-muted mb-4">You haven't added any placements yet, or your filters returned no results.</p>
            <a href="{{ route('admin.placements.create') }}" class="btn btn-orange">
                <i class="fas fa-plus me-1"></i> Add Your First Placement
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
                <h4 class="fw-bold mb-3">Delete Placement?</h4>
                <p class="text-muted mb-4">Are you sure you want to delete <span id="deletePlacementTitle" class="fw-bold text-dark"></span>? This action cannot be undone.</p>
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
                
                document.getElementById('deletePlacementTitle').textContent = title;
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
