@extends('layouts.admin')

@section('title', 'Companies')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-building text-orange me-2"></i>Companies <span class="text-muted fw-normal fs-6">(Partners & Recruiters)</span>
    </h4>
    <a href="{{ route('admin.companies.create') }}" class="btn btn-orange">
        <i class="fas fa-plus-circle me-1"></i> Add New Company
    </a>
</div>

<div class="admin-card p-4 mb-4">
    <form action="{{ route('admin.companies.index') }}" method="GET" class="row gy-3 gx-3 align-items-center">
        <div class="col-12 col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Search by name..." value="{{ request('q') }}">
            </div>
        </div>
        <div class="col-12 col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
            @if(request('q'))
                <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary">Clear</a>
            @endif
        </div>
    </form>
</div>

<div class="admin-card">
    @if($companies->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width: 80px;">Logo</th>
                        <th>Name</th>
                        <th>Website</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($companies as $company)
                    <tr>
                        <td class="ps-4 py-3">
                            @if($company->logo)
                                <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="rounded border border-2 border-primary border-opacity-10 shadow-sm bg-white" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="rounded bg-light text-muted d-flex align-items-center justify-content-center shadow-sm border" style="width: 50px; height: 50px;">
                                    <i class="fas fa-building fs-5 opacity-50"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong class="text-navy fs-6">{{ $company->name }}</strong>
                        </td>
                        <td>
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-medium text-primary d-inline-flex align-items-center">
                                    {{ $company->website }}
                                    <i class="fas fa-external-link-alt ms-2 text-muted" style="font-size: 0.7rem;"></i>
                                </a>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="text-end pe-4 text-nowrap">
                            <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm btn-outline-primary fw-medium me-1 btn-hover-lift">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger px-3 delete-btn btn-hover-lift" 
                                data-id="{{ $company->id }}" 
                                data-title="{{ $company->name }}" 
                                data-placements="{{ \App\Models\Placement::where('company_id', $company->id)->count() }}"
                                title="Delete Company" data-bs-toggle="tooltip">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $company->id }}" action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="d-none">
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
            {{ $companies->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center">
            <div class="mb-3">
                <i class="fas fa-building fa-4x text-muted opacity-25"></i>
            </div>
            <h5 class="fw-bold text-navy">No Companies Found</h5>
            <p class="text-muted mb-4">You haven't added any companies yet, or your search returned no results.</p>
            <a href="{{ route('admin.companies.create') }}" class="btn btn-orange">
                <i class="fas fa-plus me-1"></i> Add Your First Company
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
                <h4 class="fw-bold mb-3">Delete Company?</h4>
                <p class="text-muted mb-3">Are you sure you want to delete "<span id="deleteCompanyTitle" class="fw-bold text-dark"></span>"? This action cannot be undone.</p>
                <div id="placementWarning" class="alert alert-warning py-2 small d-none mb-4">
                    <i class="fas fa-info-circle me-1"></i> This company is linked to <strong><span id="placementCount">0</span> placements</strong>. Deleting it may affect those records.
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
                const placementCount = parseInt(this.getAttribute('data-placements') || 0);
                
                document.getElementById('deleteCompanyTitle').textContent = title;
                
                const warningDiv = document.getElementById('placementWarning');
                if (placementCount > 0) {
                    document.getElementById('placementCount').textContent = placementCount;
                    warningDiv.classList.remove('d-none');
                } else {
                    warningDiv.classList.add('d-none');
                }

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
