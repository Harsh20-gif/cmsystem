@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Home Page Content Settings</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Home Page Text & Images</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.home.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero" type="button" role="tab" aria-controls="hero" aria-selected="true">Hero Section</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="false">Stats Counter</button>
                  </li>
                </ul>
                
                <div class="tab-content" id="myTabContent">
                  <!-- HERO SECTION TAB -->
                  <div class="tab-pane fade show active" id="hero" role="tabpanel" aria-labelledby="hero-tab">
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Hero Title (Line 1)</label>
                            <input type="text" name="home_hero_title1" class="form-control" value="{{ $settings['home_hero_title1'] ?? 'Build Technical Skills' }}">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Hero Highlight Word (Orange)</label>
                            <input type="text" name="home_hero_title2_orange" class="form-control" value="{{ $settings['home_hero_title2_orange'] ?? 'Get Certified.' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hero Highlight Word (Blue)</label>
                            <input type="text" name="home_hero_title3_blue" class="form-control" value="{{ $settings['home_hero_title3_blue'] ?? 'Get Placed.' }}">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Hero Description</label>
                        <textarea name="home_hero_desc" class="form-control" rows="3">{{ $settings['home_hero_desc'] ?? 'Skill Bridge India delivers practical Summer & Winter Industrial Training with live projects, expert mentorship, and guaranteed placement drives across BTech CS/IT, Electrical, Mechanical, Electronics, and Civil branches.' }}</textarea>
                    </div>
                    
                    <hr>
                    <h5 class="mb-3">Hero Bullet Points</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Feature 1</label>
                            <input type="text" name="home_hero_feature1" class="form-control" value="{{ $settings['home_hero_feature1'] ?? '100% Placement Assistance' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Feature 2</label>
                            <input type="text" name="home_hero_feature2" class="form-control" value="{{ $settings['home_hero_feature2'] ?? 'Live Industrial Projects' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Feature 3</label>
                            <input type="text" name="home_hero_feature3" class="form-control" value="{{ $settings['home_hero_feature3'] ?? 'Centers: Lucknow • Noida • Bhopal' }}">
                        </div>
                    </div>

                    <hr>
                    <h5 class="mb-3">Hero Image & Floating Badges</h5>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Hero Main Image</label>
                            <input type="file" name="hero_image" class="form-control">
                            @if(isset($settings['home_hero_image']) && $settings['home_hero_image'])
                                <div class="mt-2">
                                    <img src="{{ Storage::url($settings['home_hero_image']) }}" alt="Hero Image" style="height: 100px; object-fit: contain;">
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Floating Badge 1 (Placement)</label>
                            <input type="text" name="home_hero_badge1_value" class="form-control mb-2" placeholder="e.g. 12,500+ Placed" value="{{ $settings['home_hero_badge1_value'] ?? '12,500+ Placed' }}">
                            <input type="text" name="home_hero_badge1_label" class="form-control" placeholder="e.g. Top MNCs & Core Industries" value="{{ $settings['home_hero_badge1_label'] ?? 'Top MNCs & Core Industries' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Floating Badge 2 (Rating)</label>
                            <input type="text" name="home_hero_badge2_value" class="form-control mb-2" placeholder="e.g. 4.9 / 5 Rating" value="{{ $settings['home_hero_badge2_value'] ?? '4.9 / 5 Rating' }}">
                            <input type="text" name="home_hero_badge2_label" class="form-control" placeholder="e.g. Verified Student Reviews" value="{{ $settings['home_hero_badge2_label'] ?? 'Verified Student Reviews' }}">
                        </div>
                    </div>

                  </div>
                  
                  <!-- STATS SECTION TAB -->
                  <div class="tab-pane fade" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                      <div class="row mb-3">
                          <div class="col-md-3">
                              <label class="fw-bold">Stat 1 (Students)</label>
                              <input type="number" step="0.1" name="home_stat1_number" class="form-control mb-1" placeholder="e.g. 12500" value="{{ $settings['home_stat1_number'] ?? '12500' }}">
                              <input type="text" name="home_stat1_suffix" class="form-control mb-1" placeholder="Suffix (e.g. +)" value="{{ $settings['home_stat1_suffix'] ?? '+' }}">
                              <input type="text" name="home_stat1_label" class="form-control" placeholder="Label (e.g. Students Trained)" value="{{ $settings['home_stat1_label'] ?? 'Students Trained' }}">
                          </div>
                          
                          <div class="col-md-3">
                              <label class="fw-bold">Stat 2 (Placement)</label>
                              <input type="number" step="0.1" name="home_stat2_number" class="form-control mb-1" placeholder="e.g. 96.8" value="{{ $settings['home_stat2_number'] ?? '96.8' }}">
                              <input type="text" name="home_stat2_suffix" class="form-control mb-1" placeholder="Suffix (e.g. %)" value="{{ $settings['home_stat2_suffix'] ?? '%' }}">
                              <input type="text" name="home_stat2_label" class="form-control" placeholder="Label (e.g. Placement Record)" value="{{ $settings['home_stat2_label'] ?? 'Placement Record' }}">
                          </div>
                          
                          <div class="col-md-3">
                              <label class="fw-bold">Stat 3 (Partners)</label>
                              <input type="number" step="0.1" name="home_stat3_number" class="form-control mb-1" placeholder="e.g. 350" value="{{ $settings['home_stat3_number'] ?? '350' }}">
                              <input type="text" name="home_stat3_suffix" class="form-control mb-1" placeholder="Suffix (e.g. +)" value="{{ $settings['home_stat3_suffix'] ?? '+' }}">
                              <input type="text" name="home_stat3_label" class="form-control" placeholder="Label (e.g. Corporate Partners)" value="{{ $settings['home_stat3_label'] ?? 'Corporate Partners' }}">
                          </div>
                          
                          <div class="col-md-3">
                              <label class="fw-bold">Stat 4 (Package)</label>
                              <input type="number" step="0.1" name="home_stat4_number" class="form-control mb-1" placeholder="e.g. 8.5" value="{{ $settings['home_stat4_number'] ?? '8.5' }}">
                              <input type="text" name="home_stat4_suffix" class="form-control mb-1" placeholder="Suffix (e.g. LPA)" value="{{ $settings['home_stat4_suffix'] ?? ' LPA' }}">
                              <input type="text" name="home_stat4_label" class="form-control" placeholder="Label (e.g. Average Package)" value="{{ $settings['home_stat4_label'] ?? 'Average Package' }}">
                          </div>
                      </div>
                  </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
