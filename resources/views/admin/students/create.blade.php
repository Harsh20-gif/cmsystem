@extends('layouts.admin')

@section('title', 'Add Student')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Add Student</h4>
    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="admin-card p-4">
    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            
            <div class="col-md-6">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">College / University</label>
                <input type="text" name="college" class="form-control @error('college') is-invalid @enderror" value="{{ old('college') }}">
                @error('college')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Course Enrolled (at EduSkill)</label>
                <input type="text" name="course_enrolled" class="form-control @error('course_enrolled') is-invalid @enderror" value="{{ old('course_enrolled') }}" placeholder="e.g. Full Stack Web Development">
                @error('course_enrolled')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6">
                <x-media-picker name="photo" id="photo" label="Student Photo" :value="old('photo')" />
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-orange">Save Student</button>
            </div>
        </div>
    </form>
</div>
@endsection
