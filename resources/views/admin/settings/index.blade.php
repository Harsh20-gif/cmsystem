@extends('layouts.admin')

@section('title', 'Global Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Global Settings</h4>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row g-4">
        
        <!-- General Info -->
        <div class="col-md-6">
            <div class="admin-card p-4 h-100">
                <h5 class="fw-bold mb-4 border-bottom pb-2">General Information</h5>
                
                <div class="mb-3">
                    <label class="form-label">Site Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'Skill Bridge India Technologies CMS' }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Primary Email</label>
                    <input type="email" name="site_email" class="form-control" value="{{ $settings['site_email'] ?? '' }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Primary Phone</label>
                    <input type="text" name="site_phone" class="form-control" value="{{ $settings['site_phone'] ?? '' }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="site_address" class="form-control" rows="3">{{ $settings['site_address'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Social Links -->
        <div class="col-md-6">
            <div class="admin-card p-4 h-100">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Social Media Links</h5>
                
                <div class="mb-3">
                    <label class="form-label"><i class="fab fa-facebook text-primary me-2"></i> Facebook URL</label>
                    <input type="url" name="facebook_url" class="form-control" value="{{ $settings['facebook_url'] ?? '' }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label"><i class="fab fa-twitter text-info me-2"></i> Twitter / X URL</label>
                    <input type="url" name="twitter_url" class="form-control" value="{{ $settings['twitter_url'] ?? '' }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label"><i class="fab fa-instagram text-danger me-2"></i> Instagram URL</label>
                    <input type="url" name="instagram_url" class="form-control" value="{{ $settings['instagram_url'] ?? '' }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label"><i class="fab fa-linkedin text-primary me-2"></i> LinkedIn URL</label>
                    <input type="url" name="linkedin_url" class="form-control" value="{{ $settings['linkedin_url'] ?? '' }}">
                </div>
                
                <div class="mb-3">
                    <label class="form-label"><i class="fab fa-youtube text-danger me-2"></i> YouTube URL</label>
                    <input type="url" name="youtube_url" class="form-control" value="{{ $settings['youtube_url'] ?? '' }}">
                </div>
            </div>
        </div>

        <!-- Assets & Configuration -->
        <div class="col-12">
            <div class="admin-card p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">System Configuration</h5>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <x-media-picker name="site_logo" id="site_logo" label="Site Logo (Header)" :value="$settings['site_logo'] ?? ''" />
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <x-media-picker name="site_favicon" id="site_favicon" label="Site Favicon" :value="$settings['site_favicon'] ?? ''" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Google Analytics ID</label>
                        <input type="text" name="google_analytics_id" class="form-control" value="{{ $settings['google_analytics_id'] ?? '' }}" placeholder="e.g. G-XXXXXXX">
                    </div>
                    
                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" name="maintenance_mode" id="maintenance_mode" value="1" {{ isset($settings['maintenance_mode']) && $settings['maintenance_mode'] == '1' ? 'checked' : '' }}>
                            <label class="form-check-label text-danger fw-bold" for="maintenance_mode">Enable Maintenance Mode (Hides public site)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12">
            <button type="submit" class="btn btn-orange btn-lg px-5">Save All Settings</button>
        </div>
    </div>
</form>
@endsection
