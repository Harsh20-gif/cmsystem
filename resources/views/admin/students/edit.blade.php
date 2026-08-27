@extends('layouts.admin')

@section('title', 'Edit Student')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-user-edit text-orange me-2"></i>Edit Student: {{ $student->name }}
    </h4>
    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.students.update', $student) }}" method="POST" id="studentForm">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Main Form Column (Desktop) -->
        <div class="col-lg-8 col-12">
            
            <!-- Basic Info Section -->
            <x-form-section title="Basic Info" icon="fas fa-user-circle">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-user text-muted me-1"></i> Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $student->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-envelope text-muted me-1"></i> Email Address
                        </label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-phone text-muted me-1"></i> Phone Number
                        </label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $student->phone) }}">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>
            
            <!-- Education & Course Section -->
            <x-form-section title="Education & Course" icon="fas fa-graduation-cap">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-university text-muted me-1"></i> College / University
                        </label>
                        <input type="text" name="college" class="form-control @error('college') is-invalid @enderror" value="{{ old('college', $student->college) }}">
                        @error('college')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-book text-muted me-1"></i> Course Enrolled <small class="text-muted fw-normal">(at Skill Bridge India Technologies)</small>
                        </label>
                        <input type="text" name="course_enrolled" class="form-control @error('course_enrolled') is-invalid @enderror" value="{{ old('course_enrolled', $student->course_enrolled) }}" placeholder="e.g. Full Stack Web Development">
                        @error('course_enrolled')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>
            
        </div>

        <!-- Right Column (Desktop) -->
        <div class="col-lg-4 col-12">
            
            <!-- Photo Section -->
            <x-form-section title="Student Photo" icon="fas fa-image">
                <div class="row gy-4">
                    <div class="col-12">
                        <x-media-picker name="photo" id="photo" label="Select Photo" :value="old('photo', $student->photo)" />
                        @error('photo')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Actions Area -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold btn-hover-lift" id="submitBtn">
                        <span class="normal-state"><i class="fas fa-save me-1"></i> Update Student</span>
                        <span class="loading-state d-none">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Saving...
                        </span>
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-light w-100 text-muted">
                        Cancel
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</form>

<style>
    .btn-hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .btn-hover-lift:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Submit Loader
        const form = document.getElementById('studentForm');
        const btn = document.getElementById('submitBtn');
        if (form && btn) {
            form.addEventListener('submit', function() {
                btn.disabled = true;
                btn.querySelector('.normal-state').classList.add('d-none');
                btn.querySelector('.loading-state').classList.remove('d-none');
            });
        }
    });
</script>
@endpush
@endsection
