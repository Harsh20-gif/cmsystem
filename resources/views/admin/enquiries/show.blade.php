@extends('layouts.admin')

@section('title', 'View Enquiry')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-inbox text-orange me-2"></i>Enquiry Details
    </h4>
    <div class="d-flex gap-2">
        <a href="mailto:{{ $enquiry->email }}?subject={{ urlencode('Re: Your Enquiry at Skillbridge India Technologies') }}" class="btn btn-primary">
            <i class="fas fa-reply me-1"></i> Reply via Email
        </a>
        <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8 col-12">
        <div class="admin-card p-4 h-100 shadow-sm border-0 rounded-3">
            <h5 class="fw-bold border-bottom pb-3 mb-4 text-navy">
                <i class="fas fa-info-circle text-muted me-2"></i>Message Details
            </h5>
            
            <div class="row mb-3 align-items-center">
                <div class="col-sm-4 col-md-3 text-muted fw-semibold">
                    <i class="fas fa-user me-2 text-primary"></i>From:
                </div>
                <div class="col-sm-8 col-md-9 fw-bold text-dark fs-5">{{ $enquiry->name }}</div>
            </div>
            
            <div class="row mb-3 align-items-center">
                <div class="col-sm-4 col-md-3 text-muted fw-semibold">
                    <i class="fas fa-envelope me-2 text-primary"></i>Email:
                </div>
                <div class="col-sm-8 col-md-9">
                    <a href="mailto:{{ $enquiry->email }}" class="text-decoration-none hover-primary fw-medium">{{ $enquiry->email }}</a>
                </div>
            </div>
            
            <div class="row mb-3 align-items-center">
                <div class="col-sm-4 col-md-3 text-muted fw-semibold">
                    <i class="fas fa-phone me-2 text-orange"></i>Phone:
                </div>
                <div class="col-sm-8 col-md-9">
                    <a href="tel:{{ $enquiry->phone }}" class="text-decoration-none text-dark hover-orange fw-medium">{{ $enquiry->phone }}</a>
                </div>
            </div>
            
            <div class="row mb-3 align-items-center">
                <div class="col-sm-4 col-md-3 text-muted fw-semibold">
                    <i class="fas fa-calendar-alt me-2 text-muted"></i>Date Received:
                </div>
                <div class="col-sm-8 col-md-9 text-dark">
                    {{ $enquiry->created_at->format('F d, Y h:i A') }}
                </div>
            </div>
            
            <div class="row mb-3 align-items-center">
                <div class="col-sm-4 col-md-3 text-muted fw-semibold">
                    <i class="fas fa-map-marker-alt me-2 text-muted"></i>Location:
                </div>
                <div class="col-sm-8 col-md-9 text-dark">
                    @if($enquiry->city || $enquiry->state)
                        {{ $enquiry->city ? $enquiry->city . ', ' : '' }}{{ $enquiry->state }}
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </div>
            </div>
            
            <div class="row mb-3 align-items-center">
                <div class="col-sm-4 col-md-3 text-muted fw-semibold">
                    <i class="fas fa-building me-2 text-muted"></i>College/Org:
                </div>
                <div class="col-sm-8 col-md-9 text-dark">
                    {{ $enquiry->college ?: '—' }}
                </div>
            </div>
            
            <div class="row mb-3 align-items-center">
                <div class="col-sm-4 col-md-3 text-muted fw-semibold">
                    <i class="fas fa-tag me-2 text-muted"></i>Type:
                </div>
                <div class="col-sm-8 col-md-9">
                    @php
                        $type = strtolower($enquiry->type ?? '');
                        $typeClass = 'bg-secondary-subtle text-secondary';
                        if(str_contains($type, 'counseling')) $typeClass = 'bg-info-subtle text-info border-info';
                        elseif(str_contains($type, 'admission')) $typeClass = 'bg-primary-subtle text-primary border-primary';
                        elseif(str_contains($type, 'general')) $typeClass = 'bg-light text-dark border-secondary';
                    @endphp
                    @if(!empty($enquiry->type))
                        <span class="badge {{ $typeClass }} border border-opacity-25 px-3 py-2 text-uppercase rounded-pill shadow-sm">
                            {{ $enquiry->type }}
                        </span>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-top">
                <h6 class="fw-bold text-navy mb-3">
                    <i class="fas fa-comment-dots text-muted me-2"></i>Message / Query Details:
                </h6>
                <div class="p-4 bg-light rounded-3 border-start border-4 border-orange" style="white-space: pre-line; font-size: 1.05rem; line-height: 1.6; color: #444;">
{{ $enquiry->message }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="admin-card p-4 h-100 bg-light border-0 shadow-sm rounded-3">
            <h5 class="fw-bold border-bottom pb-3 mb-4 text-navy">
                <i class="fas fa-sliders-h text-muted me-2"></i>Update Status
            </h5>
            
            <form action="{{ route('admin.enquiries.update_status', $enquiry) }}" method="POST" id="updateStatusForm">
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-tasks text-muted me-1"></i> Status
                    </label>
                    <select name="status" class="form-select border-0 shadow-sm @error('status') is-invalid @enderror" style="height: 45px;">
                        <option value="new" {{ $enquiry->status == 'new' ? 'selected' : '' }}>New</option>
                        <option value="contacted" {{ $enquiry->status == 'contacted' ? 'selected' : '' }}>Contacted (In Progress)</option>
                        <option value="converted" {{ $enquiry->status == 'converted' ? 'selected' : '' }}>Converted (Admitted)</option>
                        <option value="closed" {{ $enquiry->status == 'closed' ? 'selected' : '' }}>Closed (Not Interested)</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        <i class="fas fa-sticky-note text-muted me-1"></i> Admin Notes
                    </label>
                    <textarea name="notes" class="form-control border-0 shadow-sm @error('notes') is-invalid @enderror" rows="6" placeholder="Add internal notes about this enquiry...">{{ old('notes', $enquiry->notes) }}</textarea>
                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-orange w-100 py-2 fw-bold shadow-sm btn-hover-lift" id="submitUpdateBtn">
                    <span class="normal-state"><i class="fas fa-save me-1"></i> Update Enquiry</span>
                    <span class="loading-state d-none">
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Updating...
                    </span>
                </button>
            </form>
            
            <div class="mt-4 pt-4 border-top text-center">
                <button type="button" class="btn btn-outline-danger w-100 py-2 fw-medium btn-hover-lift" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fas fa-trash-alt me-1"></i> Delete Enquiry
                </button>
            </div>
        </div>
    </div>
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
                <p class="text-muted mb-4">Are you sure you want to delete this enquiry from "<span class="fw-bold text-dark">{{ $enquiry->name }}</span>"? This action cannot be undone.</p>
                <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger px-4">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-primary:hover { color: var(--bs-primary) !important; }
    .hover-orange:hover { color: #fd7e14 !important; }
    .btn-hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .btn-hover-lift:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('updateStatusForm');
        const btn = document.getElementById('submitUpdateBtn');
        
        form.addEventListener('submit', function() {
            const normalState = btn.querySelector('.normal-state');
            const loadingState = btn.querySelector('.loading-state');
            
            // Disable button to prevent double submission
            btn.disabled = true;
            
            // Show loading UI
            normalState.classList.add('d-none');
            loadingState.classList.remove('d-none');
        });
    });
</script>
@endpush
@endsection
