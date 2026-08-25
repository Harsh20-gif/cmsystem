@extends('layouts.admin')

@section('title', 'View Enquiry')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Enquiry Details</h4>
    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="admin-card p-4 h-100">
            <h5 class="fw-bold border-bottom pb-3 mb-4">Message Details</h5>
            
            <div class="row mb-3">
                <div class="col-sm-3 text-muted">From:</div>
                <div class="col-sm-9 fw-bold">{{ $enquiry->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted">Email:</div>
                <div class="col-sm-9"><a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted">Phone:</div>
                <div class="col-sm-9">{{ $enquiry->phone }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted">Date Received:</div>
                <div class="col-sm-9">{{ $enquiry->created_at->format('F d, Y h:i A') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted">Location:</div>
                <div class="col-sm-9">{{ $enquiry->city ? $enquiry->city . ', ' : '' }}{{ $enquiry->state ?? 'N/A' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted">College/Org:</div>
                <div class="col-sm-9">{{ $enquiry->college ?? 'N/A' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 text-muted">Type:</div>
                <div class="col-sm-9 text-uppercase">{{ $enquiry->type ?? 'N/A' }}</div>
            </div>
            
            <div class="mt-4 pt-4 border-top">
                <h6 class="fw-bold text-muted mb-3">Message / Query Details:</h6>
                <div class="p-3 bg-light rounded" style="white-space: pre-line;">
                    {{ $enquiry->message }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="admin-card p-4 h-100 bg-light border-0">
            <h5 class="fw-bold border-bottom pb-3 mb-4">Update Status</h5>
            
            <form action="{{ route('admin.enquiries.update_status', $enquiry) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="new" {{ $enquiry->status == 'new' ? 'selected' : '' }}>New</option>
                        <option value="contacted" {{ $enquiry->status == 'contacted' ? 'selected' : '' }}>Contacted (In Progress)</option>
                        <option value="converted" {{ $enquiry->status == 'converted' ? 'selected' : '' }}>Converted (Admitted)</option>
                        <option value="closed" {{ $enquiry->status == 'closed' ? 'selected' : '' }}>Closed (Not Interested)</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Admin Notes</label>
                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="5" placeholder="Add internal notes about this enquiry...">{{ old('notes', $enquiry->notes) }}</textarea>
                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-orange w-100">Update Enquiry</button>
            </form>
            
            <div class="mt-4 pt-4 border-top text-center">
                <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100">Delete Enquiry</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
