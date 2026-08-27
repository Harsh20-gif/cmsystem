@extends('layouts.admin')

@section('title', 'Engineering Branches')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-tags text-orange me-2"></i>Engineering Branches
    </h4>
    <a href="{{ route('admin.engineering-branches.create') }}" class="btn btn-orange">
        <i class="fas fa-plus-circle me-1"></i> Add New Branch
    </a>
</div>

<div class="admin-card p-4 mb-4">
    <form action="{{ route('admin.engineering-branches.index') }}" method="GET" class="row gy-3 gx-3 align-items-center">
        <div class="col-12 col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Search by name..." value="{{ request('q') }}">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
        <div class="col-12 col-md-2">
            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
        </div>
        @if(request('q') || request('status'))
            <div class="col-12 col-md-2">
                <a href="{{ route('admin.engineering-branches.index') }}" class="btn btn-outline-secondary w-100">Clear</a>
            </div>
        @endif
    </form>
</div>

<div class="admin-card">
    @if($branches->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width: 60px;">ID</th>
                        <th>Branch Name</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($branches as $branch)
                    <tr>
                        <td class="ps-4">
                            <span class="text-muted small">#{{ $branch->id }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-tag text-orange bg-light p-2 rounded-circle me-3"></i>
                                <strong class="text-navy">{{ $branch->name }}</strong>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary border-opacity-25 px-2 py-1 rounded-pill">
                                <i class="fas fa-hashtag" style="font-size: 0.7rem;"></i> {{ $branch->order_position ?? 0 }}
                            </span>
                        </td>
                        <td>
                            @if($branch->status == 'published')
                                <span class="badge bg-success-subtle text-success border-0 px-2 py-1">
                                    <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Published
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border-0 px-2 py-1">
                                    <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Draft
                                </span>
                            @endif
                        </td>
                        <td class="text-end pe-4 text-nowrap">
                            <a href="{{ route('admin.engineering-branches.edit', $branch) }}" class="btn btn-sm btn-outline-primary fw-medium me-1 btn-hover-lift">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger px-3 delete-btn btn-hover-lift" 
                                data-id="{{ $branch->id }}" 
                                data-title="{{ $branch->name }}" 
                                data-unused="{{ $branch->id }}"
                                title="Delete branch" data-bs-toggle="tooltip">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $branch->id }}" action="{{ route('admin.engineering-branches.destroy', $branch) }}" method="POST" class="d-none">
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
            {{ $branches->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center">
            <div class="mb-3">
                <i class="fas fa-tags fa-4x text-muted opacity-25"></i>
            </div>
            <h5 class="fw-bold text-navy">No branches Found</h5>
            <p class="text-muted mb-4">You haven't added any Engineering Branches yet, or your search returned no results.</p>
            <a href="{{ route('admin.engineering-branches.create') }}" class="btn btn-orange">
                <i class="fas fa-plus me-1"></i> Add Your First branch
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
                <h4 class="fw-bold mb-3">Delete Branch?</h4>
                <p class="text-muted mb-2">Are you sure you want to delete the "<span id="deletebranchTitle" class="fw-bold text-dark"></span>" branch?</p>
                <div id="courseWarning" class="alert alert-warning py-2 mb-4 d-none">
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
                const coursesCount = parseInt(this.getAttribute('data-unused'), 10);
                
                document.getElementById('deletebranchTitle').textContent = title;
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
