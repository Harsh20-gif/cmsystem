@extends('layouts.admin')

@section('title', 'Companies')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Companies (Partners & Recruiters)</h4>
    <a href="{{ route('admin.companies.create') }}" class="btn btn-orange">Add New Company</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.companies.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="q" class="form-control" placeholder="Search by name..." value="{{ request('q') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Website</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                <tr>
                    <td>
                        @if($company->logo)
                            <img src="{{ Storage::url($company->logo) }}" alt="Logo" class="rounded" style="height: 40px; object-fit: contain; max-width: 100px;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <span class="text-muted small">Logo</span>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $company->name }}</strong></td>
                    <td>
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank" class="text-decoration-none">{{ $company->website }}</a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No companies found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $companies->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
