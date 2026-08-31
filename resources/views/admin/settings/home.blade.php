@extends('layouts.admin')

@section('title', 'Home Page Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-home text-orange me-2"></i>Home Page Content Settings
    </h4>
</div>

<!-- Toast for successful save (instead of full alert block) -->
@if (session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
        <div id="liveToast" class="toast align-items-center text-white bg-success border-0 show shadow" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-bold">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

<div class="admin-card mb-4 shadow-sm border-0 rounded-3 overflow-hidden">
    <form action="{{ route('admin.settings.home.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
        @csrf
        
        <!-- Tabs Navigation -->
        <div class="bg-light px-4 pt-3 border-bottom">
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold px-4 py-3 border-0 border-bottom border-3 border-transparent" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero" type="button" role="tab" aria-controls="hero" aria-selected="true" style="border-radius: 0;">
                        <i class="fas fa-image me-1"></i> Hero Section
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4 py-3 border-0 border-bottom border-3 border-transparent text-muted" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="false" style="border-radius: 0;">
                        <i class="fas fa-chart-line me-1"></i> Stats Counter
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4 py-3 border-0 border-bottom border-3 border-transparent text-muted" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" style="border-radius: 0;">
                        <i class="fas fa-info-circle me-1"></i> About Section
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4 py-3 border-0 border-bottom border-3 border-transparent text-muted" id="training-tab" data-bs-toggle="tab" data-bs-target="#training" type="button" role="tab" aria-controls="training" aria-selected="false" style="border-radius: 0;">
                        <i class="fas fa-laptop-code me-1"></i> Training Section
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold px-4 py-3 border-0 border-bottom border-3 border-transparent text-muted" id="mission-tab" data-bs-toggle="tab" data-bs-target="#mission" type="button" role="tab" aria-controls="mission" aria-selected="false" style="border-radius: 0;">
                        <i class="fas fa-bullseye me-1"></i> Mission & Vision
                    </button>
                </li>
            </ul>
        </div>
        
        <!-- Tab Content -->
        <div class="tab-content p-4" id="myTabContent">
            
            <!-- HERO SECTION TAB -->
            <div class="tab-pane fade show active" id="hero" role="tabpanel" aria-labelledby="hero-tab">
                
                <x-form-section title="Hero Headline" icon="fas fa-heading">
                    <div class="row gy-4">
                        <div class="col-12">
                            <!-- Live Headline Preview -->
                            <div class="p-3 bg-light rounded-3 border mb-3">
                                <span class="text-muted small fw-bold d-block mb-2"><i class="fas fa-eye me-1"></i> Live Preview:</span>
                                <h3 class="fw-bold mb-0" style="color: #0b1c3e;">
                                    <span id="preview-title1">Build Technical Skills</span> 
                                    <span id="preview-title2" class="text-orange">Get Certified.</span> 
                                    <span id="preview-title3" class="text-primary">Get Placed.</span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Hero Title (Line 1)</label>
                            <input type="text" name="home_hero_title1" id="input-title1" class="form-control" value="{{ $settings['home_hero_title1'] ?? 'Build Technical Skills' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-orange">Hero Highlight Word (Orange)</label>
                            <input type="text" name="home_hero_title2_orange" id="input-title2" class="form-control" value="{{ $settings['home_hero_title2_orange'] ?? 'Get Certified.' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-primary">Hero Highlight Word (Blue)</label>
                            <input type="text" name="home_hero_title3_blue" id="input-title3" class="form-control" value="{{ $settings['home_hero_title3_blue'] ?? 'Get Placed.' }}">
                        </div>
                    </div>
                </x-form-section>
                
                <x-form-section title="Hero Description" icon="fas fa-align-left">
                    <div class="row">
                        <div class="col-12">
                            <textarea name="home_hero_desc" class="form-control" rows="4">{{ $settings['home_hero_desc'] ?? 'Skill Bridge India delivers practical Summer & Winter Industrial Training with live projects, expert mentorship, and guaranteed placement drives across BTech CS/IT, Electrical, Mechanical, Electronics, and Civil branches.' }}</textarea>
                        </div>
                    </div>
                </x-form-section>
                
                <x-form-section title="Hero Bullet Points" icon="fas fa-list-ul">
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-check-circle text-success me-1"></i> Feature 1
                            </label>
                            <input type="text" name="home_hero_feature1" class="form-control" value="{{ $settings['home_hero_feature1'] ?? '100% Placement Assistance' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-check-circle text-success me-1"></i> Feature 2
                            </label>
                            <input type="text" name="home_hero_feature2" class="form-control" value="{{ $settings['home_hero_feature2'] ?? 'Live Industrial Projects' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-check-circle text-success me-1"></i> Feature 3
                            </label>
                            <input type="text" name="home_hero_feature3" class="form-control" value="{{ $settings['home_hero_feature3'] ?? 'Centers: Lucknow • Noida • Bhopal' }}">
                            <div class="form-text"><i class="fas fa-info-circle"></i> E.g., 'Virtual & Offline Modes'</div>
                        </div>
                    </div>
                </x-form-section>

                <x-form-section title="Hero Image & Badges" icon="fas fa-image">
                    <div class="row gy-4">
                        <div class="col-md-12 mb-3">
                            <x-media-picker name="hero_image" id="hero_image" label="Hero Main Image" :value="$settings['home_hero_image'] ?? ''" />
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-light border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <label class="form-label fw-bold text-navy"><i class="fas fa-briefcase text-orange me-1"></i> Floating Badge 1 (Placement)</label>
                                    <input type="text" name="home_hero_badge1_value" class="form-control mb-2 fw-bold" placeholder="e.g. 12,500+ Placed" value="{{ $settings['home_hero_badge1_value'] ?? '12,500+ Placed' }}">
                                    <input type="text" name="home_hero_badge1_label" class="form-control text-muted" placeholder="e.g. Top MNCs & Core Industries" value="{{ $settings['home_hero_badge1_label'] ?? 'Top MNCs & Core Industries' }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card bg-light border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <label class="form-label fw-bold text-navy"><i class="fas fa-star text-warning me-1"></i> Floating Badge 2 (Rating)</label>
                                    <input type="text" name="home_hero_badge2_value" class="form-control mb-2 fw-bold" placeholder="e.g. 4.9 / 5 Rating" value="{{ $settings['home_hero_badge2_value'] ?? '4.9 / 5 Rating' }}">
                                    <input type="text" name="home_hero_badge2_label" class="form-control text-muted" placeholder="e.g. Verified Student Reviews" value="{{ $settings['home_hero_badge2_label'] ?? 'Verified Student Reviews' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </x-form-section>

            </div>
            
            <!-- STATS SECTION TAB -->
            <div class="tab-pane fade" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                
                <div class="row g-4">
                    <!-- Stat 1 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-sm border-0 h-100 bg-light">
                            <div class="card-body">
                                <label class="fw-bold text-navy mb-3">
                                    <i class="fas fa-user-graduate text-orange me-1"></i> Stat 1 (Students)
                                </label>
                                <input type="number" step="0.1" name="home_stat1_number" id="input-stat1-num" class="form-control mb-2 fw-bold" placeholder="e.g. 12500" value="{{ $settings['home_stat1_number'] ?? '12500' }}">
                                <input type="text" name="home_stat1_suffix" id="input-stat1-suf" class="form-control mb-2" placeholder="Suffix (e.g. +)" value="{{ $settings['home_stat1_suffix'] ?? '+' }}">
                                <input type="text" name="home_stat1_label" id="input-stat1-lab" class="form-control mb-3 text-muted" placeholder="Label (e.g. Students Trained)" value="{{ $settings['home_stat1_label'] ?? 'Students Trained' }}">
                                
                                <div class="p-2 bg-white rounded text-center border">
                                    <span class="small text-muted d-block mb-1">Preview:</span>
                                    <h5 class="fw-bold text-orange mb-0"><span id="prev-stat1-num">12500</span><span id="prev-stat1-suf">+</span></h5>
                                    <small class="text-navy fw-medium" id="prev-stat1-lab">Students Trained</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat 2 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-sm border-0 h-100 bg-light">
                            <div class="card-body">
                                <label class="fw-bold text-navy mb-3">
                                    <i class="fas fa-chart-line text-primary me-1"></i> Stat 2 (Placement)
                                </label>
                                <input type="number" step="0.1" name="home_stat2_number" id="input-stat2-num" class="form-control mb-2 fw-bold" placeholder="e.g. 96.8" value="{{ $settings['home_stat2_number'] ?? '96.8' }}">
                                <input type="text" name="home_stat2_suffix" id="input-stat2-suf" class="form-control mb-2" placeholder="Suffix (e.g. %)" value="{{ $settings['home_stat2_suffix'] ?? '%' }}">
                                <input type="text" name="home_stat2_label" id="input-stat2-lab" class="form-control mb-3 text-muted" placeholder="Label (e.g. Placement Record)" value="{{ $settings['home_stat2_label'] ?? 'Placement Record' }}">
                                
                                <div class="p-2 bg-white rounded text-center border">
                                    <span class="small text-muted d-block mb-1">Preview:</span>
                                    <h5 class="fw-bold text-orange mb-0"><span id="prev-stat2-num">96.8</span><span id="prev-stat2-suf">%</span></h5>
                                    <small class="text-navy fw-medium" id="prev-stat2-lab">Placement Record</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat 3 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-sm border-0 h-100 bg-light">
                            <div class="card-body">
                                <label class="fw-bold text-navy mb-3">
                                    <i class="fas fa-handshake text-success me-1"></i> Stat 3 (Partners)
                                </label>
                                <input type="number" step="0.1" name="home_stat3_number" id="input-stat3-num" class="form-control mb-2 fw-bold" placeholder="e.g. 350" value="{{ $settings['home_stat3_number'] ?? '350' }}">
                                <input type="text" name="home_stat3_suffix" id="input-stat3-suf" class="form-control mb-2" placeholder="Suffix (e.g. +)" value="{{ $settings['home_stat3_suffix'] ?? '+' }}">
                                <input type="text" name="home_stat3_label" id="input-stat3-lab" class="form-control mb-3 text-muted" placeholder="Label (e.g. Corporate Partners)" value="{{ $settings['home_stat3_label'] ?? 'Corporate Partners' }}">
                                
                                <div class="p-2 bg-white rounded text-center border">
                                    <span class="small text-muted d-block mb-1">Preview:</span>
                                    <h5 class="fw-bold text-orange mb-0"><span id="prev-stat3-num">350</span><span id="prev-stat3-suf">+</span></h5>
                                    <small class="text-navy fw-medium" id="prev-stat3-lab">Corporate Partners</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stat 4 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-sm border-0 h-100 bg-light">
                            <div class="card-body">
                                <label class="fw-bold text-navy mb-3">
                                    <i class="fas fa-rupee-sign text-info me-1"></i> Stat 4 (Package)
                                </label>
                                <input type="number" step="0.1" name="home_stat4_number" id="input-stat4-num" class="form-control mb-2 fw-bold" placeholder="e.g. 8.5" value="{{ $settings['home_stat4_number'] ?? '8.5' }}">
                                <input type="text" name="home_stat4_suffix" id="input-stat4-suf" class="form-control mb-2" placeholder="Suffix (e.g. LPA)" value="{{ $settings['home_stat4_suffix'] ?? ' LPA' }}">
                                <input type="text" name="home_stat4_label" id="input-stat4-lab" class="form-control mb-3 text-muted" placeholder="Label (e.g. Average Package)" value="{{ $settings['home_stat4_label'] ?? 'Average Package' }}">
                                
                                <div class="p-2 bg-white rounded text-center border">
                                    <span class="small text-muted d-block mb-1">Preview:</span>
                                    <h5 class="fw-bold text-orange mb-0"><span id="prev-stat4-num">8.5</span><span id="prev-stat4-suf"> LPA</span></h5>
                                    <small class="text-navy fw-medium" id="prev-stat4-lab">Average Package</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ABOUT SECTION TAB -->
            <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                <x-form-section title="About Section Content" icon="fas fa-info-circle">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Section Heading</label>
                            <input type="text" name="home_about_title" class="form-control" value="{{ $settings['home_about_title'] ?? 'About Skill Bridge India Technologies' }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Short Intro Paragraph</label>
                            <textarea name="home_about_text" class="form-control" rows="3">{{ $settings['home_about_text'] ?? '' }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Button Text</label>
                            <input type="text" name="home_about_btn_text" class="form-control" value="{{ $settings['home_about_btn_text'] ?? 'Read More' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Button Link</label>
                            <input type="text" name="home_about_btn_link" class="form-control" value="{{ $settings['home_about_btn_link'] ?? '/about' }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">About Image (Optional)</label>
                            @if(!empty($settings['home_about_image']))
                                <div class="mb-2">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($settings['home_about_image']) }}" alt="About Image" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                            <input type="file" name="about_image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </x-form-section>
                
                <x-form-section title="About Highlights (Checkmarks)" icon="fas fa-list-ul">
                    <div id="aboutHighlightsContainer">
                        @if(isset($aboutHighlights) && count($aboutHighlights) > 0)
                            @foreach($aboutHighlights as $index => $highlight)
                            <div class="card mb-3 highlight-item">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0 fw-bold">Highlight #{{ $index + 1 }}</h6>
                                        <button type="button" class="btn btn-sm btn-danger remove-highlight"><i class="fas fa-trash"></i> Remove</button>
                                    </div>
                                    <input type="hidden" name="about_highlights[{{ $index }}][id]" value="{{ $highlight->id }}">
                                    <div class="row">
                                        <div class="col-md-8 mb-2">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="about_highlights[{{ $index }}][title]" class="form-control" value="{{ $highlight->title }}" required>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label">Icon Class</label>
                                            <input type="text" name="about_highlights[{{ $index }}][icon_class]" class="form-control" value="{{ $highlight->icon_class ?? 'fas fa-check-circle' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-success" id="addHighlightBtn"><i class="fas fa-plus"></i> Add Highlight</button>
                </x-form-section>
            </div>

            <!-- TRAINING SECTION TAB -->
            <div class="tab-pane fade" id="training" role="tabpanel" aria-labelledby="training-tab">
                <x-form-section title="Training Section Header" icon="fas fa-laptop-code">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Section Heading</label>
                            <input type="text" name="home_training_title" class="form-control" value="{{ $settings['home_training_title'] ?? 'Hands-on Training with 100% Placement Assistance' }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Short Description</label>
                            <textarea name="home_training_text" class="form-control" rows="2">{{ $settings['home_training_text'] ?? '' }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">CTA Button Text</label>
                            <input type="text" name="home_training_btn_text" class="form-control" value="{{ $settings['home_training_btn_text'] ?? 'Explore Courses' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">CTA Button Link</label>
                            <input type="text" name="home_training_btn_link" class="form-control" value="{{ $settings['home_training_btn_link'] ?? '/courses' }}">
                        </div>
                    </div>
                </x-form-section>

                <x-form-section title="Training Feature Cards" icon="fas fa-th-large">
                    <div id="trainingFeaturesContainer">
                        @if(isset($trainingFeatures) && count($trainingFeatures) > 0)
                            @foreach($trainingFeatures as $index => $feature)
                            <div class="card mb-3 t-feature-item">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0 fw-bold">Card #{{ $index + 1 }}</h6>
                                        <button type="button" class="btn btn-sm btn-danger remove-t-feature"><i class="fas fa-trash"></i> Remove</button>
                                    </div>
                                    <input type="hidden" name="training_features[{{ $index }}][id]" value="{{ $feature->id }}">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="training_features[{{ $index }}][title]" class="form-control" value="{{ $feature->title }}" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Icon Class</label>
                                            <input type="text" name="training_features[{{ $index }}][icon_class]" class="form-control" value="{{ $feature->icon_class ?? 'fas fa-star' }}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Description</label>
                                            <textarea name="training_features[{{ $index }}][description]" class="form-control" rows="2">{{ $feature->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-success" id="addTFeatureBtn"><i class="fas fa-plus"></i> Add Card</button>
                </x-form-section>
            </div>

            <!-- MISSION & VISION TAB -->
            <div class="tab-pane fade" id="mission" role="tabpanel" aria-labelledby="mission-tab">
                <x-form-section title="Mission & Vision" icon="fas fa-bullseye">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light">
                                <h5 class="fw-bold mb-3 text-navy"><i class="fas fa-rocket me-2 text-orange"></i>Mission</h5>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Heading</label>
                                    <input type="text" name="home_mission_title" class="form-control" value="{{ $settings['home_mission_title'] ?? 'Our Mission' }}">
                                </div>
                                <div>
                                    <label class="form-label fw-semibold">Mission Statement</label>
                                    <textarea name="home_mission_text" class="form-control" rows="4">{{ $settings['home_mission_text'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light">
                                <h5 class="fw-bold mb-3 text-navy"><i class="fas fa-eye me-2 text-primary"></i>Vision</h5>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Heading</label>
                                    <input type="text" name="home_vision_title" class="form-control" value="{{ $settings['home_vision_title'] ?? 'Our Vision' }}">
                                </div>
                                <div>
                                    <label class="form-label fw-semibold">Vision Statement</label>
                                    <textarea name="home_vision_text" class="form-control" rows="4">{{ $settings['home_vision_text'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-form-section>
            </div>
            
        </div>

        <div class="p-4 bg-light border-top d-flex justify-content-end position-sticky bottom-0" style="z-index: 10;">
            <button type="submit" class="btn btn-orange px-5 py-2 fw-bold shadow-sm btn-hover-lift" id="submitSettingsBtn">
                <span class="normal-state"><i class="fas fa-save me-2"></i> Save Settings</span>
                <span class="loading-state d-none">
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Saving...
                </span>
            </button>
        </div>
    </form>
</div>

<style>
    .nav-tabs .nav-link {
        color: #6c757d;
        background: transparent;
    }
    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: var(--bs-primary);
    }
    .nav-tabs .nav-link.active {
        color: var(--bs-primary) !important;
        border-color: transparent transparent var(--bs-primary) transparent !important;
        background: transparent;
    }
    .btn-hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .btn-hover-lift:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Custom Tab Active State Styling
        const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabEls.forEach(tab => {
            tab.addEventListener('show.bs.tab', function (event) {
                // Remove active classes from all
                tabEls.forEach(t => {
                    t.classList.remove('text-primary');
                    t.classList.add('text-muted');
                });
                // Add to current
                event.target.classList.add('text-primary');
                event.target.classList.remove('text-muted');
            });
        });

        // -----------------------------------------
        // LIVE PREVIEW LOGIC
        // -----------------------------------------
        
        // 1. Headline Preview
        const t1 = document.getElementById('input-title1');
        const t2 = document.getElementById('input-title2');
        const t3 = document.getElementById('input-title3');
        
        const pt1 = document.getElementById('preview-title1');
        const pt2 = document.getElementById('preview-title2');
        const pt3 = document.getElementById('preview-title3');
        
        const updateHeadline = () => {
            pt1.textContent = t1.value;
            pt2.textContent = t2.value;
            pt3.textContent = t3.value;
        };
        
        [t1, t2, t3].forEach(input => input.addEventListener('input', updateHeadline));
        updateHeadline();

        // 2. Stats Preview
        for(let i = 1; i <= 4; i++) {
            const num = document.getElementById(`input-stat${i}-num`);
            const suf = document.getElementById(`input-stat${i}-suf`);
            const lab = document.getElementById(`input-stat${i}-lab`);
            
            const pnum = document.getElementById(`prev-stat${i}-num`);
            const psuf = document.getElementById(`prev-stat${i}-suf`);
            const plab = document.getElementById(`prev-stat${i}-lab`);
            
            const updateStat = () => {
                pnum.textContent = num.value;
                psuf.textContent = suf.value;
                plab.textContent = lab.value;
            };
            
            [num, suf, lab].forEach(input => input.addEventListener('input', updateStat));
            updateStat();
        }

        // -----------------------------------------
        // FORM SUBMIT LOADER
        // -----------------------------------------
        const form = document.getElementById('settingsForm');
        const btn = document.getElementById('submitSettingsBtn');
        
        form.addEventListener('submit', function() {
            const normalState = btn.querySelector('.normal-state');
            const loadingState = btn.querySelector('.loading-state');
            
            btn.disabled = true;
            normalState.classList.add('d-none');
            loadingState.classList.remove('d-none');
        });

        // -----------------------------------------
        // REPEATABLE FIELDS LOGIC
        // -----------------------------------------
        let highlightIndex = {{ isset($aboutHighlights) ? count($aboutHighlights) : 0 }};
        const highlightsContainer = document.getElementById('aboutHighlightsContainer');
        const addHighlightBtn = document.getElementById('addHighlightBtn');
        if(addHighlightBtn) {
            addHighlightBtn.addEventListener('click', function() {
                const html = `
                    <div class="card mb-3 highlight-item">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0 fw-bold">New Highlight</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-highlight"><i class="fas fa-trash"></i> Remove</button>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="about_highlights[${highlightIndex}][title]" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label">Icon Class</label>
                                    <input type="text" name="about_highlights[${highlightIndex}][icon_class]" class="form-control" value="fas fa-check-circle">
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                highlightsContainer.insertAdjacentHTML('beforeend', html);
                highlightIndex++;
            });
        }
        
        if (highlightsContainer) {
            highlightsContainer.addEventListener('click', function(e) {
                if(e.target.closest('.remove-highlight')) {
                    e.target.closest('.highlight-item').remove();
                }
            });
        }

        let tFeatureIndex = {{ isset($trainingFeatures) ? count($trainingFeatures) : 0 }};
        const tFeaturesContainer = document.getElementById('trainingFeaturesContainer');
        const addTFeatureBtn = document.getElementById('addTFeatureBtn');
        if(addTFeatureBtn) {
            addTFeatureBtn.addEventListener('click', function() {
                const html = `
                    <div class="card mb-3 t-feature-item">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0 fw-bold">New Card</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-t-feature"><i class="fas fa-trash"></i> Remove</button>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="training_features[${tFeatureIndex}][title]" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Icon Class</label>
                                    <input type="text" name="training_features[${tFeatureIndex}][icon_class]" class="form-control" value="fas fa-star">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Description</label>
                                    <textarea name="training_features[${tFeatureIndex}][description]" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                tFeaturesContainer.insertAdjacentHTML('beforeend', html);
                tFeatureIndex++;
            });
        }
        
        if (tFeaturesContainer) {
            tFeaturesContainer.addEventListener('click', function(e) {
                if(e.target.closest('.remove-t-feature')) {
                    e.target.closest('.t-feature-item').remove();
                }
            });
        }

        // Initialize Toast if present
        const toastEl = document.getElementById('liveToast');
        if (toastEl) {
            const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
            toast.show();
        }
    });
</script>
@endpush
@endsection
