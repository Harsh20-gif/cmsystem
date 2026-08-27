@extends('layouts.admin')

@section('title', 'Add Training')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-plus-circle text-orange me-2"></i>Add Training
    </h4>
    <a href="{{ route('admin.trainings.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.trainings.store') }}" method="POST">
    @csrf
    
    <div class="row">
        <!-- Main Form Column (Desktop) -->
        <div class="col-lg-8 col-12">
            
            <!-- Basic Info Section -->
            <x-form-section title="Basic Info" icon="fas fa-info-circle">
                <div class="row gy-4">
                    <div class="col-md-8 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-heading text-muted me-1"></i> Training Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-4 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-tag text-muted me-1"></i> Type <span class="text-danger">*</span>
                        </label>
                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">Select Type</option>
                            @foreach(['summer', 'winter', 'industrial', 'internship', 'corporate', 'workshop'] as $type)
                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-link text-muted me-1"></i> Link to Course <small class="text-muted fw-normal">(Optional)</small>
                        </label>
                        <select name="course_id" class="form-select @error('course_id') is-invalid @enderror">
                            <option value="">-- No linked course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-12">
                        <x-media-picker name="image" id="image" label="Training Image (Banner)" :value="old('image')" />
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-align-left text-muted me-1"></i> Description
                        </label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="6">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Schedule & Details Section -->
            <x-form-section title="Schedule & Details" icon="fas fa-calendar-alt">
                <div class="row gy-4">
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-calendar-day text-muted me-1"></i> Start Date
                        </label>
                        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                        @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-calendar-check text-muted me-1"></i> End Date
                        </label>
                        <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                        @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-clock text-muted me-1"></i> Duration
                        </label>
                        <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" placeholder="e.g. 45 Days">
                        @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-laptop-house text-muted me-1"></i> Mode
                        </label>
                        <input type="text" name="mode" class="form-control @error('mode') is-invalid @enderror" value="{{ old('mode') }}" placeholder="e.g. Offline / Online">
                        @error('mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-map-marker-alt text-muted me-1"></i> Location
                        </label>
                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
                        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-user-tie text-muted me-1"></i> Trainer / Instructor
                        </label>
                        <input type="text" name="trainer" class="form-control @error('trainer') is-invalid @enderror" value="{{ old('trainer') }}">
                        @error('trainer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-users text-muted me-1"></i> Total Seats
                        </label>
                        <input type="number" name="seats" class="form-control @error('seats') is-invalid @enderror" value="{{ old('seats') }}" placeholder="e.g. 50">
                        @error('seats')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>
        </div>

        <!-- Right Column (Desktop) -->
        <div class="col-lg-4 col-12">
            
            <!-- Status Settings Section -->
            <x-form-section title="Status Settings" icon="fas fa-cog">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-door-open text-muted me-1"></i> Registration Status <span class="text-danger">*</span>
                        </label>
                        <select name="registration_status" class="form-select @error('registration_status') is-invalid @enderror" required>
                            <option value="open" {{ old('registration_status') == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="closed" {{ old('registration_status') == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        @error('registration_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-eye text-muted me-1"></i> Visibility Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Actions Area -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold">
                        <i class="fas fa-save me-1"></i> Save Training
                    </button>
                    <a href="{{ route('admin.trainings.index') }}" class="btn btn-light w-100 text-muted">
                        Cancel
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</form>

@endsection
