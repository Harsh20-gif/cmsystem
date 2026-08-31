@extends('layouts.admin')

@section('title', 'Gallery Page Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-camera-retro text-primary me-2"></i> Gallery Page Settings</h2>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.settings.gallery.update') }}" method="POST">
            @csrf
            
            <h5 class="fw-bold mb-3 text-primary">Hero Banner Section</h5>
            <div class="mb-3">
                <label class="form-label fw-bold">Hero Title</label>
                <input type="text" name="gallery_hero_title" class="form-control" value="{{ $settings['gallery_hero_title'] ?? 'Campus & Training Gallery' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Hero Subtitle</label>
                <textarea name="gallery_hero_subtitle" class="form-control" rows="2">{{ $settings['gallery_hero_subtitle'] ?? 'Take a glimpse into our state-of-the-art infrastructure, classroom sessions, hardware labs, and student life.' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Breadcrumb Text</label>
                <input type="text" name="gallery_hero_breadcrumb" class="form-control" value="{{ $settings['gallery_hero_breadcrumb'] ?? 'Gallery' }}">
            </div>

            <hr class="my-4">
            
            <h5 class="fw-bold mb-3 text-primary">Content Area</h5>
            <div class="mb-3">
                <label class="form-label fw-bold">'All Photos' Filter Label</label>
                <input type="text" name="gallery_filter_all_label" class="form-control" value="{{ $settings['gallery_filter_all_label'] ?? 'All Photos' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Empty State Text</label>
                <input type="text" name="gallery_empty_text" class="form-control" value="{{ $settings['gallery_empty_text'] ?? 'No gallery albums found. Check back later for updates.' }}">
            </div>

            <hr class="my-4">
            
            <h5 class="fw-bold mb-3 text-primary">Bottom Call to Action</h5>
            <div class="mb-3">
                <label class="form-label fw-bold">CTA Title</label>
                <input type="text" name="gallery_cta_title" class="form-control" value="{{ $settings['gallery_cta_title'] ?? 'Experience Live Labs in Person' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">CTA Subtitle</label>
                <textarea name="gallery_cta_subtitle" class="form-control" rows="2">{{ $settings['gallery_cta_subtitle'] ?? 'Visit our campus to see the infrastructure and interact with our expert trainers before you enroll.' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">CTA Button Label</label>
                <input type="text" name="gallery_cta_button_label" class="form-control" value="{{ $settings['gallery_cta_button_label'] ?? 'Book a Free Campus Tour' }}">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold"><i class="fas fa-save me-2"></i> Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
