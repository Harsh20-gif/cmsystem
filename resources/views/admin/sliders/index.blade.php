@extends('layouts.admin')

@section('title', 'Sliders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Home Page Sliders</h4>
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-orange">Add New Slider</a>
</div>

<div class="admin-card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Image & Title</th>
                    <th>Link</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sliders as $slider)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ Storage::url($slider->image) }}" class="rounded me-3" style="width: 80px; height: 50px; object-fit: cover;">
                            <div>
                                <strong>{{ $slider->title ?? 'No Title' }}</strong>
                            </div>
                        </div>
                    </td>
                    <td>{{ $slider->link ?? '-' }}</td>
                    <td>{{ $slider->order_position }}</td>
                    <td>
                        <span class="badge bg-{{ $slider->status == 'published' ? 'success' : 'secondary' }}">
                            {{ ucfirst($slider->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No sliders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $sliders->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
