@extends('layouts.admin')

@section('title', 'Enquiries')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-inbox text-orange me-2"></i>Contact Enquiries
    </h4>
</div>

<div class="admin-card p-4 mb-4">
    <form action="{{ route('admin.enquiries.index') }}" method="GET" class="row gy-3 gx-3 align-items-center">
        <div class="col-12 col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Search by name, email or phone..." value="{{ request('q') }}">
            </div>
        </div>
        <div class="col-12 col-md-3">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="converted" {{ request('status') == 'converted' ? 'selected' : '' }}>Converted</option>
                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>
        <div class="col-12 col-md-2">
            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
        </div>
        @if(request('q') || request('status'))
            <div class="col-12 col-md-2">
                <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary w-100">Clear</a>
            </div>
        @endif
    </form>
</div>

<div class="admin-card">
    @if($enquiries->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Location & Type</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($enquiries as $enquiry)
                    <tr class="{{ $enquiry->status == 'new' ? 'bg-light bg-opacity-50' : '' }}">
                        <td class="ps-4">
                            <div class="text-nowrap">
                                <i class="fas fa-calendar-alt text-muted me-1"></i> 
                                <span class="{{ $enquiry->status == 'new' ? 'fw-bold text-navy' : 'text-dark' }}">{{ $enquiry->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="small text-muted ms-4">{{ $enquiry->created_at->format('h:i A') }}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($enquiry->status == 'new')
                                    <span class="bg-danger rounded-circle d-inline-block" style="width: 8px; height: 8px;" title="New / Unread" data-bs-toggle="tooltip"></span>
                                @endif
                                <strong class="{{ $enquiry->status == 'new' ? 'text-navy' : 'text-dark' }}">{{ $enquiry->name }}</strong>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1 text-nowrap">
                                <i class="fas fa-envelope text-primary me-1" style="width: 14px;"></i> 
                                <a href="mailto:{{ $enquiry->email }}" class="text-decoration-none hover-primary {{ $enquiry->status == 'new' ? 'fw-bold' : '' }}">{{ $enquiry->email }}</a>
                            </div>
                            <div class="text-nowrap">
                                <i class="fas fa-phone text-orange me-1" style="width: 14px;"></i> 
                                <a href="tel:{{ $enquiry->phone }}" class="text-decoration-none text-muted hover-orange">{{ $enquiry->phone }}</a>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1 text-nowrap text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i> 
                                @if($enquiry->city || $enquiry->state)
                                    {{ $enquiry->city ? $enquiry->city . ', ' : '' }}{{ $enquiry->state }}
                                @else
                                    —
                                @endif
                            </div>
                            <div>
                                @php
                                    $type = strtolower($enquiry->type ?? '');
                                    $typeClass = 'bg-secondary-subtle text-secondary';
                                    if(str_contains($type, 'counseling')) $typeClass = 'bg-info-subtle text-info border-info';
                                    elseif(str_contains($type, 'admission')) $typeClass = 'bg-primary-subtle text-primary border-primary';
                                    elseif(str_contains($type, 'general')) $typeClass = 'bg-light text-dark border-secondary';
                                @endphp
                                @if(!empty($enquiry->type))
                                    <span class="badge {{ $typeClass }} border border-opacity-25 px-2 py-1 text-uppercase" style="font-size: 0.7rem;">
                                        <i class="fas fa-tag me-1"></i>{{ $enquiry->type }}
                                    </span>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($enquiry->status == 'new')
                                <span class="badge bg-danger-subtle text-danger border-0 px-2 py-1">
                                    <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> New
                                </span>
                            @elseif($enquiry->status == 'contacted')
                                <span class="badge bg-warning-subtle text-warning-emphasis border-0 px-2 py-1">
                                    <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Contacted
                                </span>
                            @elseif($enquiry->status == 'converted')
                                <span class="badge bg-success-subtle text-success border-0 px-2 py-1">
                                    <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Converted
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border-0 px-2 py-1">
                                    <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Closed
                                </span>
                            @endif
                        </td>
                        <td class="text-end pe-4 text-nowrap">
                            <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-sm btn-outline-primary fw-medium me-1">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger px-3 delete-btn" data-id="{{ $enquiry->id }}" data-title="{{ $enquiry->name }}" title="Delete Enquiry" data-bs-toggle="tooltip">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $enquiry->id }}" action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST" class="d-none">
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
            {{ $enquiries->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center">
            <div class="mb-3">
                <i class="fas fa-inbox fa-4x text-muted opacity-25"></i>
            </div>
            <h5 class="fw-bold text-navy">No Enquiries Found</h5>
            <p class="text-muted mb-4">You have no contact enquiries matching your criteria.</p>
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
                    <i class="fas fa-exclamation-circle fa-4x"></i>
                </div>
                <h4 class="fw-bold mb-3">Delete Enquiry?</h4>
                <p class="text-muted mb-4">Are you sure you want to delete the enquiry from "<span id="deleteEnquiryName" class="fw-bold text-dark"></span>"? This action cannot be undone.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-primary:hover { color: var(--bs-primary) !important; }
    .hover-orange:hover { color: #fd7e14 !important; }
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
                
                document.getElementById('deleteEnquiryName').textContent = title;
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
