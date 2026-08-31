@extends('layouts.admin')

@section('title', 'Corporate Trainings Page Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-chalkboard-teacher text-primary me-2"></i> Trainings Page Settings</h2>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.settings.trainings.update') }}" method="POST">
            @csrf
            
            <h5 class="fw-bold mb-3 text-primary">Hero Banner Section</h5>
            <div class="mb-3">
                <label class="form-label fw-bold">Hero Title</label>
                <input type="text" name="trainings_hero_title" class="form-control" value="{{ $settings['trainings_hero_title'] ?? 'Corporate & Industrial Trainings' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Hero Subtitle</label>
                <textarea name="trainings_hero_subtitle" class="form-control" rows="2">{{ $settings['trainings_hero_subtitle'] ?? 'We offer customized training solutions to help your workforce stay ahead in the fast-paced tech world.' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Breadcrumb Text</label>
                <input type="text" name="trainings_hero_breadcrumb" class="form-control" value="{{ $settings['trainings_hero_breadcrumb'] ?? 'Corporate Training' }}">
            </div>

            <hr class="my-4">
            
            <h5 class="fw-bold mb-3 text-primary">Content Area</h5>
            <div class="mb-3">
                <label class="form-label fw-bold">Section Badge</label>
                <input type="text" name="trainings_section_badge" class="form-control" value="{{ $settings['trainings_section_badge'] ?? 'Internship Tracks' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Section Title</label>
                <input type="text" name="trainings_section_title" class="form-control" value="{{ $settings['trainings_section_title'] ?? 'Seasonal Training Tracks (2026 Batch)' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Empty State Text</label>
                <input type="text" name="trainings_empty_text" class="form-control" value="{{ $settings['trainings_empty_text'] ?? 'No trainings available at the moment. Please check back later.' }}">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold"><i class="fas fa-save me-2"></i> Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
