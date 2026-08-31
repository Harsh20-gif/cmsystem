@extends('layouts.admin')

@section('title', 'Contact Page Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-address-book text-orange me-2"></i>Contact Page Settings
    </h4>
</div>

<!-- Toast for successful save -->
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
    <form action="{{ route('admin.settings.contact.update') }}" method="POST" id="settingsForm">
        @csrf
        
        <div class="p-4">
            
            <x-form-section title="Hero Banner Section" icon="fas fa-image">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Hero Title</label>
                        <input type="text" name="contact_hero_title" class="form-control" value="{{ $settings['contact_hero_title'] ?? 'Contact Us & Virtual Support' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Breadcrumb Text</label>
                        <input type="text" name="contact_hero_breadcrumb" class="form-control" value="{{ $settings['contact_hero_breadcrumb'] ?? 'Contact Us' }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Hero Subtitle</label>
                        <textarea name="contact_hero_subtitle" class="form-control" rows="2">{{ $settings['contact_hero_subtitle'] ?? 'Reach out for free virtual career counseling, seat booking, and online internship admissions.' }}</textarea>
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Page Content" icon="fas fa-align-left">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Page Intro Text</label>
                        <textarea name="contact_intro_text" class="form-control" rows="3">{{ $settings['contact_intro_text'] ?? 'Fill out the form below to connect with a senior career counselor within 30 minutes.' }}</textarea>
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Contact Info Card" icon="fas fa-address-card">
                <div class="row gy-4">
                    <!-- Center Timings -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Center Timings Label</label>
                        <input type="text" name="contact_timings_label" class="form-control" value="{{ $settings['contact_timings_label'] ?? 'Center Timings' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Center Timings Value</label>
                        <input type="text" name="contact_timings_value" class="form-control" value="{{ $settings['contact_timings_value'] ?? 'Monday - Saturday: 9:00 AM to 5:00 PM' }}">
                    </div>

                    <!-- Student Helpline -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Student Helpline Label</label>
                        <input type="text" name="contact_helpline_label" class="form-control" value="{{ $settings['contact_helpline_label'] ?? 'Student Helpline' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Student Helpline Value</label>
                        <input type="text" name="contact_helpline_value" class="form-control" value="{{ $settings['contact_helpline_value'] ?? '24x7 Helpline: +91 8467912807' }}">
                    </div>

                    <!-- Admissions Email -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Admissions Email Label</label>
                        <input type="text" name="contact_email_label" class="form-control" value="{{ $settings['contact_email_label'] ?? 'Admissions Email' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Admissions Email Value</label>
                        <input type="text" name="contact_email_value" class="form-control" value="{{ $settings['contact_email_value'] ?? 'info@skillbridgeindiatechnologies.com' }}">
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Virtual Counseling Box" icon="fas fa-video">
                <div class="row gy-4">
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Heading</label>
                        <input type="text" name="contact_virtual_heading" class="form-control" value="{{ $settings['contact_virtual_heading'] ?? 'Virtual Counseling' }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="contact_virtual_desc" class="form-control" rows="2">{{ $settings['contact_virtual_desc'] ?? 'Connect instantly with our mentors online for a live counseling session!' }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Button Label</label>
                        <input type="text" name="contact_virtual_btn_label" class="form-control" value="{{ $settings['contact_virtual_btn_label'] ?? 'Get Online Demo Pass' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Button Action (JavaScript or Link)</label>
                        <input type="text" name="contact_virtual_btn_link" class="form-control" value="{{ $settings['contact_virtual_btn_link'] ?? 'openEnrollModal(\'Online Demo Pass\')' }}">
                        <div class="form-text"><i class="fas fa-info-circle"></i> E.g., openEnrollModal('Online Demo Pass') or https://...</div>
                    </div>
                </div>
            </x-form-section>

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
    .btn-hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .btn-hover-lift:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // FORM SUBMIT LOADER
        const form = document.getElementById('settingsForm');
        const btn = document.getElementById('submitSettingsBtn');
        
        if(form && btn) {
            form.addEventListener('submit', function() {
                const normalState = btn.querySelector('.normal-state');
                const loadingState = btn.querySelector('.loading-state');
                
                btn.disabled = true;
                if(normalState) normalState.classList.add('d-none');
                if(loadingState) loadingState.classList.remove('d-none');
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
