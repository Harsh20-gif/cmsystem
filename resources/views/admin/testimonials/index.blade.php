@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Testimonials</h4>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-orange">Add Testimonial</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.testimonials.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Search by name or role..." value="{{ request('q') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Reviewer</th>
                    <th>Content</th>
                    <th>Rating</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($testimonial->photo)
                                <img src="{{ Storage::url($testimonial->photo) }}" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle me-3 d-flex align-items-center justify-content-center text-secondary" style="width: 45px; height: 45px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <div>
                                <strong>{{ $testimonial->name }}</strong><br>
                                <small class="text-muted">{{ $testimonial->role_or_company }}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="mb-0 small text-truncate" style="max-width: 250px;">{{ $testimonial->content }}</p>
                    </td>
                    <td>
                        <div class="text-warning">
                            @for($i=1; $i<=5; $i++)
                                <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'text-light' }}"></i>
                            @endfor
                        </div>
                    </td>
                    <td>{{ $testimonial->order_position }}</td>
                    <td>
                        <span class="badge bg-{{ $testimonial->status == 'published' ? 'success' : 'secondary' }}">
                            {{ ucfirst($testimonial->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this testimonial?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No testimonials found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $testimonials->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
