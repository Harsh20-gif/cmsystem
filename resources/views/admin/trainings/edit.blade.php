@extends('layouts.admin')

@section('title', 'Edit Training')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Edit Training</h4>
    <a href="{{ route('admin.trainings.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.trainings.update', $training) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            
            <div class="col-md-8">
                <label class="form-label">Training Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $training->title) }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-4">
                <label class="form-label">Type <span class="text-danger">*</span></label>
                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                    <option value="">Select Type</option>
                    @foreach(['summer', 'winter', 'industrial', 'internship', 'corporate', 'workshop'] as $type)
                        <option value="{{ $type }}" {{ old('type', $training->type) == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Link to Course (Optional)</label>
                <select name="course_id" class="form-select @error('course_id') is-invalid @enderror">
                    <option value="">-- No linked course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $training->course_id) == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                    @endforeach
                </select>
                @error('course_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <x-media-picker name="image" id="image" label="Training Image (Banner)" :value="old('image', $training->image)" />
            </div>

            <div class="col-12 mt-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Schedule & Details</h5>
            </div>

            <div class="col-md-3">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $training->start_date ? $training->start_date->format('Y-m-d') : '') }}">
                @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $training->end_date ? $training->end_date->format('Y-m-d') : '') }}">
                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">Duration</label>
                <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $training->duration) }}" placeholder="e.g. 45 Days">
                @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">Mode</label>
                <input type="text" name="mode" class="form-control @error('mode') is-invalid @enderror" value="{{ old('mode', $training->mode) }}" placeholder="e.g. Offline">
                @error('mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $training->location) }}">
                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Trainer / Instructor</label>
                <input type="text" name="trainer" class="form-control @error('trainer') is-invalid @enderror" value="{{ old('trainer', $training->trainer) }}">
                @error('trainer')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Total Seats</label>
                <input type="number" name="seats" class="form-control @error('seats') is-invalid @enderror" value="{{ old('seats', $training->seats) }}">
                @error('seats')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description', $training->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 mt-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Status Settings</h5>
            </div>

            <div class="col-md-6">
                <label class="form-label">Registration Status <span class="text-danger">*</span></label>
                <select name="registration_status" class="form-select @error('registration_status') is-invalid @enderror" required>
                    <option value="open" {{ old('registration_status', $training->registration_status) == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ old('registration_status', $training->registration_status) == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
                @error('registration_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Visibility Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="draft" {{ old('status', $training->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $training->status) == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ old('status', $training->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange">Update Training</button>
            </div>
        </div>
    </form>
</div>
@endsection
