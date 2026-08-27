@extends('layouts.admin')

@section('title', 'Edit Team Member')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-user-edit text-orange me-2"></i>Edit Team Member
    </h4>
    <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.team-members.update', $teamMember) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Main Form Column (Desktop) -->
        <div class="col-lg-8 col-12">
            
            <x-form-section title="Basic Info" icon="fas fa-info-circle">
                <div class="row gy-4">
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-user text-muted me-1"></i> Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $teamMember->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-briefcase text-muted me-1"></i> Role / Designation <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation', $teamMember->designation) }}" required>
                        @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Social Links" icon="fas fa-link">
                <div class="row gy-4">
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fab fa-linkedin text-primary me-1"></i> LinkedIn URL
                        </label>
                        <input type="url" name="linkedin_url" class="form-control @error('linkedin_url') is-invalid @enderror" value="{{ old('linkedin_url', $teamMember->linkedin_url) }}" placeholder="https://linkedin.com/in/username">
                        @error('linkedin_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fab fa-twitter text-info me-1"></i> Twitter / X URL
                        </label>
                        <input type="url" name="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" value="{{ old('twitter_url', $teamMember->twitter_url) }}" placeholder="https://twitter.com/username">
                        @error('twitter_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Bio" icon="fas fa-align-left">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-paragraph text-muted me-1"></i> Biography <small class="text-muted fw-normal">(Optional)</small>
                        </label>
                        <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4">{{ old('bio', $teamMember->bio) }}</textarea>
                        @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>
            
        </div>

        <!-- Right Column (Desktop) -->
        <div class="col-lg-4 col-12">
            
            <x-form-section title="Profile Photo" icon="fas fa-image">
                <div class="col-12">
                    <x-media-picker name="photo" id="photo" label="" :value="old('photo', $teamMember->photo)" />
                </div>
            </x-form-section>

            <x-form-section title="Display Settings" icon="fas fa-sliders-h">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-sort-numeric-down text-muted me-1"></i> Order Position <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="order_position" class="form-control @error('order_position') is-invalid @enderror" value="{{ old('order_position', $teamMember->order_position) }}" required>
                        <div class="form-text"><i class="fas fa-info-circle me-1"></i> Lower numbers appear first.</div>
                        @error('order_position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-eye text-muted me-1"></i> Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="published" {{ old('status', $teamMember->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ old('status', $teamMember->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Actions Area -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold">
                        <i class="fas fa-save me-1"></i> Update Team Member
                    </button>
                    <a href="{{ route('admin.team-members.index') }}" class="btn btn-light w-100 text-muted">
                        Cancel
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</form>

@endsection
