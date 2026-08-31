@extends('layouts.admin')

@section('title', 'Placements Page Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-award text-primary me-2"></i> Placements Page Settings</h2>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <form action="{{ route('admin.settings.placements.update') }}" method="POST">
            @csrf
            
            <h5 class="fw-bold mb-3 text-primary">Hero Banner Section</h5>
            <div class="mb-3">
                <label class="form-label fw-bold">Hero Title</label>
                <input type="text" name="placements_hero_title" class="form-control" value="{{ $settings['placements_hero_title'] ?? 'Placements & Alumni' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Hero Subtitle</label>
                <textarea name="placements_hero_subtitle" class="form-control" rows="2">{{ $settings['placements_hero_subtitle'] ?? 'We are proud to have successfully placed hundreds of students in top IT and Core Engineering companies.' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Breadcrumb Text</label>
                <input type="text" name="placements_hero_breadcrumb" class="form-control" value="{{ $settings['placements_hero_breadcrumb'] ?? 'Placements' }}">
            </div>

            <hr class="my-4">
            
            <h5 class="fw-bold mb-3 text-primary">Partners Section</h5>
            <div class="mb-3">
                <label class="form-label fw-bold">Section Badge</label>
                <input type="text" name="placements_partners_badge" class="form-control" value="{{ $settings['placements_partners_badge'] ?? 'Hiring Ecosystem' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Section Title</label>
                <input type="text" name="placements_partners_title" class="form-control" value="{{ $settings['placements_partners_title'] ?? 'Our Top Recruiting Partners' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Section Subtitle</label>
                <textarea name="placements_partners_subtitle" class="form-control" rows="2">{{ $settings['placements_partners_subtitle'] ?? 'Our students are driving innovation at some of the best companies globally.' }}</textarea>
            </div>

            <hr class="my-4">
            
            <h5 class="fw-bold mb-3 text-primary">Marquee Section</h5>
            <div class="mb-3">
                <label class="form-label fw-bold">Section Badge</label>
                <input type="text" name="placements_marquee_badge" class="form-control" value="{{ $settings['placements_marquee_badge'] ?? 'Alumni Achievements' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Section Title</label>
                <input type="text" name="placements_marquee_title" class="form-control" value="{{ $settings['placements_marquee_title'] ?? 'Recent Placement Records' }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Section Subtitle</label>
                <textarea name="placements_marquee_subtitle" class="form-control" rows="2">{{ $settings['placements_marquee_subtitle'] ?? 'Here are our recent stars who successfully cracked their dream jobs through Skill Bridge India.' }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Empty State Text</label>
                <input type="text" name="placements_empty_text" class="form-control" value="{{ $settings['placements_empty_text'] ?? 'New placement records will be updated soon.' }}">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold"><i class="fas fa-save me-2"></i> Save Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
