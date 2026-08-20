@extends('layouts.admin')

@section('title', 'Edit Placement')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Edit Placement</h4>
    <a href="{{ route('admin.placements.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.placements.update', $placement) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            
            <div class="col-md-6">
                <label class="form-label">Select Student <span class="text-danger">*</span></label>
                <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                    <option value="">Choose Student...</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id', $placement->student_id) == $student->id ? 'selected' : '' }}>
                            {{ $student->name }} ({{ $student->course_enrolled }})
                        </option>
                    @endforeach
                </select>
                @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label">Select Company <span class="text-danger">*</span></label>
                <select name="company_id" class="form-select @error('company_id') is-invalid @enderror" required>
                    <option value="">Choose Company...</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id', $placement->company_id) == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
                @error('company_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Position / Job Title <span class="text-danger">*</span></label>
                <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $placement->position) }}" required placeholder="e.g. Software Engineer">
                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Package (Optional)</label>
                <input type="text" name="package" class="form-control @error('package') is-invalid @enderror" value="{{ old('package', $placement->package) }}" placeholder="e.g. 5 LPA">
                @error('package')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Placement Date (Optional)</label>
                <input type="date" name="placement_date" class="form-control @error('placement_date') is-invalid @enderror" value="{{ old('placement_date', $placement->placement_date ? $placement->placement_date->format('Y-m-d') : '') }}">
                @error('placement_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Testimonial Text (Optional)</label>
                <textarea name="testimonial_text" class="form-control @error('testimonial_text') is-invalid @enderror" rows="4" placeholder="Student's feedback about their placement...">{{ old('testimonial_text', $placement->testimonial_text) }}</textarea>
                @error('testimonial_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange">Update Placement</button>
            </div>
        </div>
    </form>
</div>
@endsection
