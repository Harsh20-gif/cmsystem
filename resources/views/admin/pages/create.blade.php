@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-plus-circle text-orange me-2"></i>Create Static Page
    </h4>
    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.pages.store') }}" method="POST">
    @csrf
    
    <div class="row">
        <!-- Main Form Column (Desktop) -->
        <div class="col-lg-8 col-12">
            
            <x-form-section title="Page Content" icon="fas fa-pen-nib">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-heading text-muted me-1"></i> Page Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-file-code text-muted me-1"></i> Page Body
                        </label>
                        <textarea name="content" id="page-content" class="form-control @error('content') is-invalid @enderror" rows="20">{{ old('content') }}</textarea>
                        @error('content')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        <div class="form-text mt-2"><i class="fas fa-info-circle"></i> You can use the rich text editor to format your page or switch to HTML view.</div>
                    </div>
                </div>
            </x-form-section>
            
        </div>

        <!-- Right Column (Desktop) -->
        <div class="col-lg-4 col-12">
            
            <x-form-section title="Publish Settings" icon="fas fa-globe">
                <div class="col-12">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </x-form-section>

            <x-form-section title="Featured Image" icon="fas fa-image">
                <div class="col-12">
                    <x-media-picker name="featured_image" id="featured_image" label="" :value="old('featured_image')" />
                </div>
            </x-form-section>

            <x-form-section title="SEO Settings" icon="fas fa-search">
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label fw-semibold mb-0">SEO Title</label>
                            <span class="small text-muted" id="seo-title-count">0/60</span>
                        </div>
                        <input type="text" name="seo_title" id="seo_title" class="form-control mt-2 @error('seo_title') is-invalid @enderror" value="{{ old('seo_title') }}" placeholder="Leave blank to use page title" maxlength="60">
                        @error('seo_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label fw-semibold mb-0">Meta Description</label>
                            <span class="small text-muted" id="seo-desc-count">0/160</span>
                        </div>
                        <textarea name="seo_description" id="seo_description" class="form-control mt-2 @error('seo_description') is-invalid @enderror" rows="3" maxlength="160">{{ old('seo_description') }}</textarea>
                        @error('seo_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Actions Area -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold">
                        <i class="fas fa-save me-1"></i> Save Page
                    </button>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-light w-100 text-muted">
                        Cancel
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</form>

@push('scripts')
<!-- TinyMCE CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Initialize TinyMCE Editor
        tinymce.init({
            selector: '#page-content',
            height: 500,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | link image | code | help',
            content_style: 'body { font-family: Inter, Helvetica, Arial, sans-serif; font-size:16px }',
            branding: false,
            promotion: false
        });

        // SEO Character Counters
        const seoTitle = document.getElementById('seo_title');
        const seoTitleCount = document.getElementById('seo-title-count');
        const seoDesc = document.getElementById('seo_description');
        const seoDescCount = document.getElementById('seo-desc-count');

        function updateCount(input, counterEl, max) {
            if(!input || !counterEl) return;
            const current = input.value.length;
            counterEl.textContent = current + '/' + max;
            if (current >= max) {
                counterEl.classList.add('text-danger');
                counterEl.classList.remove('text-muted');
            } else if (current > max * 0.9) {
                counterEl.classList.add('text-warning');
                counterEl.classList.remove('text-danger', 'text-muted');
            } else {
                counterEl.classList.remove('text-danger', 'text-warning');
                counterEl.classList.add('text-muted');
            }
        }

        if(seoTitle) {
            seoTitle.addEventListener('input', () => updateCount(seoTitle, seoTitleCount, 60));
            updateCount(seoTitle, seoTitleCount, 60);
        }
        if(seoDesc) {
            seoDesc.addEventListener('input', () => updateCount(seoDesc, seoDescCount, 160));
            updateCount(seoDesc, seoDescCount, 160);
        }
    });
</script>
@endpush
@endsection
