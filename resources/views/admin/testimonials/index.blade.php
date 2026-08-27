@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-quote-left text-orange me-2"></i>Testimonials
    </h4>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-orange">
        <i class="fas fa-plus-circle me-1"></i> Add Testimonial
    </a>
</div>

<div class="admin-card p-4 mb-4">
    <form action="{{ route('admin.testimonials.index') }}" method="GET" class="row gy-3 gx-3 align-items-center">
        <div class="col-12 col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                <input type="text" name="q" class="form-control border-start-0 ps-0" placeholder="Search by name or role..." value="{{ request('q') }}">
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
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary w-100">Clear</a>
            </div>
        @endif
    </form>
</div>

<div class="admin-card">
    @if($testimonials->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Reviewer</th>
                        <th>Content</th>
                        <th>Rating</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                @if($testimonial->photo)
                                    <img src="{{ Storage::url($testimonial->photo) }}" class="rounded-circle me-3 border border-2 border-orange" style="width: 48px; height: 48px; object-fit: cover; padding: 2px;">
                                @else
                                    <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center text-secondary border border-2 border-orange" style="width: 48px; height: 48px; padding: 2px;">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <strong class="text-navy">{{ $testimonial->name }}</strong><br>
                                    <small class="text-muted">{{ $testimonial->role_or_company ?? '—' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if(!empty($testimonial->content))
                                <span class="text-muted small" title="{{ $testimonial->content }}">
                                    "{{ Str::limit($testimonial->content, 45, '...') }}"
                                </span>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="text-warning me-2">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'text-light' }}"></i>
                                    @endfor
                                </div>
                                <span class="small fw-bold text-dark">{{ $testimonial->rating }}/5</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-2 fw-medium shadow-sm">
                                <i class="fas fa-sort-amount-down-alt text-muted me-1"></i> {{ $testimonial->order_position }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $testimonial->status == 'published' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} border-0 px-2 py-1">
                                <i class="fas fa-circle ms-1" style="font-size: 0.5rem; vertical-align: middle;"></i> {{ ucfirst($testimonial->status) }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-primary fw-medium me-1">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger px-3 delete-btn" data-id="{{ $testimonial->id }}" data-title="{{ $testimonial->name }}" title="Delete Testimonial" data-bs-toggle="tooltip">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $testimonial->id }}" action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-none">
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
            {{ $testimonials->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center">
            <div class="mb-3">
                <i class="fas fa-comment-dots fa-4x text-muted opacity-25"></i>
            </div>
            <h5 class="fw-bold text-navy">No Testimonials Found</h5>
            <p class="text-muted mb-4">You haven't added any testimonials yet, or your search returned no results.</p>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-orange">
                <i class="fas fa-plus me-1"></i> Add Your First Testimonial
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
                    <i class="fas fa-exclamation-circle fa-4x"></i>
                </div>
                <h4 class="fw-bold mb-3">Delete Testimonial?</h4>
                <p class="text-muted mb-4">Are you sure you want to remove the testimonial from "<span id="deleteReviewerName" class="fw-bold text-dark"></span>"? This action cannot be undone.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

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
                
                document.getElementById('deleteReviewerName').textContent = title;
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
