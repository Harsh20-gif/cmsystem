@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Dashboard Overview</h4>
    <div class="text-muted small">
        <i class="far fa-calendar-alt me-1"></i> {{ date('F d, Y') }}
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="admin-card p-3 border-start border-4 border-primary shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Students</h6>
                    <h3 class="fw-bold mb-0 text-navy">{{ number_format($stats['total_students']) }}</h3>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                    <i class="fas fa-user-graduate fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="admin-card p-3 border-start border-4 border-success shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Active Courses</h6>
                    <h3 class="fw-bold mb-0 text-navy">{{ number_format($stats['total_courses']) }}</h3>
                </div>
                <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                    <i class="fas fa-book-open fa-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="admin-card p-3 border-start border-4 border-info shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Partner Companies</h6>
                    <h3 class="fw-bold mb-0 text-navy">{{ number_format($stats['total_companies']) }}</h3>
                </div>
                <div class="bg-info bg-opacity-10 p-3 rounded-circle text-info">
                    <i class="fas fa-building fa-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="admin-card p-3 border-start border-4 border-danger shadow-sm h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">New Enquiries</h6>
                    <h3 class="fw-bold mb-0 text-navy">{{ number_format($stats['new_enquiries']) }}</h3>
                </div>
                <div class="bg-danger bg-opacity-10 p-3 rounded-circle text-danger">
                    <i class="fas fa-envelope fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Enquiries -->
    <div class="col-lg-6">
        <div class="admin-card h-100">
            <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="fas fa-envelope text-primary me-2"></i> Recent Enquiries</h6>
                <a href="{{ route('admin.enquiries.index') }}" class="btn btn-sm btn-outline-secondary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recent_enquiries as $enquiry)
                        <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="list-group-item list-group-item-action p-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 fw-bold text-navy">{{ $enquiry->name }}</h6>
                                <small class="text-muted">{{ $enquiry->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1 text-muted small">{{ Str::limit($enquiry->subject, 50) }}</p>
                            @if($enquiry->status == 'new')
                                <span class="badge bg-danger rounded-pill px-2" style="font-size: 0.65rem;">NEW</span>
                            @endif
                        </a>
                    @empty
                        <div class="p-4 text-center text-muted">No recent enquiries found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Students -->
    <div class="col-lg-6">
        <div class="admin-card h-100">
            <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="fas fa-user-graduate text-success me-2"></i> Recently Added Students</h6>
                <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-outline-secondary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            @forelse($recent_students as $student)
                                <tr>
                                    <td class="p-3">
                                        <div class="d-flex align-items-center">
                                            @if($student->photo)
                                                <img src="{{ Storage::url($student->photo) }}" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center text-secondary" style="width: 40px; height: 40px;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold text-navy">{{ $student->name }}</div>
                                                <div class="small text-muted">{{ $student->course->title ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3 text-end align-middle">
                                        <span class="badge bg-light text-dark border">{{ $student->batch_year }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="p-4 text-center text-muted">No students added recently.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
