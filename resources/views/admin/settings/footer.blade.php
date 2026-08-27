@extends('layouts.admin')

@section('title', 'Footer Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-shoe-prints text-orange me-2"></i>Footer Settings
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
    <form action="{{ route('admin.settings.footer.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
        @csrf
        
        <div class="p-4">
            
            <x-form-section title="Brand Column" icon="fas fa-building">
                <div class="row gy-4">
                    <div class="col-md-4">
                        <x-media-picker name="footer_logo" id="footer_logo" label="Footer Logo (Optional)" :value="$settings['footer_logo'] ?? ''" />
                        <div class="form-text mt-1 text-muted">Leave empty to use main site logo.</div>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">About / Description Text</label>
                        <textarea name="footer_about_text" class="form-control" rows="5">{{ $settings['footer_about_text'] ?? 'Skill Bridge India Technologies is a premier virtual job-oriented BTech training and industrial placement institute delivering job-guaranteed skill transformation across CS/IT, Electrical, Mechanical, Electronics, and Civil branches through online programs and virtual placement support.' }}</textarea>
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Quick Links" icon="fas fa-link">
                <div class="row gy-4">
                    <div class="col-12">
                        <div id="quickLinksContainer">
                            <!-- JS will populate rows here -->
                        </div>
                        <button type="button" class="btn btn-outline-orange btn-sm mt-3" id="addQuickLinkBtn">
                            <i class="fas fa-plus me-1"></i> Add Link
                        </button>
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Contact Info" icon="fas fa-address-card">
                <div class="row gy-4">
                    <!-- Note: This reuses contact_helpline_value and contact_email_value from Contact Settings -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Phone Number / Helpline</label>
                        <input type="text" name="contact_helpline_value" class="form-control" value="{{ $settings['contact_helpline_value'] ?? '24x7 Helpline: +91 8467912807' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="text" name="contact_email_value" class="form-control" value="{{ $settings['contact_email_value'] ?? 'info@skillbridgeindiatechnologies.com' }}">
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Bottom Bar" icon="fas fa-window-minimize">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Copyright Text</label>
                        <input type="text" name="footer_copyright_text" class="form-control" value="{{ $settings['footer_copyright_text'] ?? '© {year} Skill Bridge India Technologies Pvt Ltd. All Rights Reserved.' }}">
                        <div class="form-text"><i class="fas fa-info-circle"></i> Use <code>{year}</code> token to automatically insert the current year.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Powered By Text</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">Text</span>
                            <input type="text" name="footer_powered_by" class="form-control" value="{{ $settings['footer_powered_by'] ?? 'Powered by Dashandots Technology' }}">
                        </div>
                        <div class="input-group mt-2">
                            <span class="input-group-text bg-light">URL</span>
                            <input type="text" name="footer_powered_by_url" class="form-control" placeholder="https://..." value="{{ $settings['footer_powered_by_url'] ?? 'https://dashandots.com/' }}">
                        </div>
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
    
    .quick-link-row {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-bottom: 0.5rem;
        transition: background 0.2s;
    }
    .quick-link-row:hover {
        background: #f1f3f5;
    }
    .drag-handle {
        cursor: grab;
        color: #adb5bd;
    }
    .drag-handle:active {
        cursor: grabbing;
    }
    .sortable-ghost {
        opacity: 0.4;
        background-color: #e9ecef;
    }
</style>

@push('scripts')
<!-- Include SortableJS for drag and drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

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

        // Quick Links Logic
        const container = document.getElementById('quickLinksContainer');
        const addBtn = document.getElementById('addQuickLinkBtn');
        let linkIndex = 0;

        // Existing links from backend
        const existingLinks = @json($footerLinks);

        function renderRow(link = null) {
            const id = link ? link.id : '';
            const label = link ? link.label : '';
            const url = link ? link.url : '';
            const status = link ? link.status : 'published';
            
            const row = document.createElement('div');
            row.className = 'quick-link-row d-flex align-items-center gap-3';
            row.innerHTML = `
                <div class="drag-handle p-2"><i class="fas fa-grip-vertical"></i></div>
                <input type="hidden" name="quick_links[${linkIndex}][id]" value="${id}">
                
                <div class="flex-grow-1">
                    <input type="text" name="quick_links[${linkIndex}][label]" class="form-control form-control-sm" placeholder="Label (e.g. About Us)" value="${label}" required>
                </div>
                
                <div class="flex-grow-1">
                    <input type="text" name="quick_links[${linkIndex}][url]" class="form-control form-control-sm" placeholder="URL (e.g. /about)" value="${url}" required>
                </div>
                
                <div style="width: 120px;">
                    <select name="quick_links[${linkIndex}][status]" class="form-select form-select-sm">
                        <option value="published" ${status === 'published' ? 'selected' : ''}>Published</option>
                        <option value="draft" ${status === 'draft' ? 'selected' : ''}>Draft</option>
                    </select>
                </div>
                
                <button type="button" class="btn btn-outline-danger btn-sm remove-link-btn" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            container.appendChild(row);
            linkIndex++;

            // Bind remove button
            row.querySelector('.remove-link-btn').addEventListener('click', function() {
                row.remove();
            });
        }

        // Load existing
        if (existingLinks.length > 0) {
            existingLinks.forEach(link => renderRow(link));
        } else {
            // Add defaults if empty
            [
                {label: 'Courses', url: '{{ route("courses") }}', status: 'published'},
                {label: 'Trainings', url: '{{ route("corporate-training") }}', status: 'published'},
                {label: 'Placements', url: '{{ route("placements") }}', status: 'published'},
                {label: 'Gallery', url: '{{ route("gallery") }}', status: 'published'},
                {label: 'About Us', url: '{{ route("about") }}', status: 'published'},
                {label: 'Contact Us', url: '{{ route("contact") }}', status: 'published'}
            ].forEach(link => renderRow(link));
        }

        // Add new
        addBtn.addEventListener('click', () => renderRow());

        // Make sortable
        new Sortable(container, {
            animation: 150,
            handle: '.drag-handle',
            ghostClass: 'sortable-ghost'
        });
    });
</script>
@endpush
@endsection
