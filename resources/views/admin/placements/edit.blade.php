@extends('layouts.admin')

@section('title', 'Edit Placement')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">Edit Placement</h4>
    <a href="{{ route('admin.placements.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

<form action="{{ route('admin.placements.update', $placement) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row g-4">
        <!-- Placement Details Card -->
        <div class="col-lg-8">
            <div class="admin-card p-4 h-100">
                <h5 class="text-navy fw-bold mb-4 border-bottom pb-2">Placement Details</h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-user-graduate text-muted me-1"></i> Select Student <span class="text-danger">*</span></label>
                        <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                            <option value="">Choose Student...</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ (old('student_id') ?? $placement->student_id) == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} ({{ $student->course_enrolled }})
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-building text-muted me-1"></i> Select Company <span class="text-danger">*</span></label>
                        <select name="company_id" class="form-select @error('company_id') is-invalid @enderror" required>
                            <option value="">Choose Company...</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ (old('company_id') ?? $placement->company_id) == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label fw-bold"><i class="fas fa-briefcase text-muted me-1"></i> Position / Job Title <span class="text-danger">*</span></label>
                        <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $placement->position) }}" required placeholder="e.g. Software Engineer">
                        @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-rupee-sign text-muted me-1"></i> Package (Optional)</label>
                        <input type="text" name="package" class="form-control @error('package') is-invalid @enderror" value="{{ old('package', $placement->package) }}" placeholder="e.g. 5 LPA">
                        @error('package')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold"><i class="fas fa-calendar-alt text-muted me-1"></i> Placement Date (Optional)</label>
                        <input type="date" name="placement_date" class="form-control @error('placement_date') is-invalid @enderror" value="{{ old('placement_date', $placement->placement_date ? $placement->placement_date->format('Y-m-d') : '') }}">
                        @error('placement_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold"><i class="fas fa-comment-dots text-muted me-1"></i> Testimonial Text (Optional)</label>
                        <textarea name="testimonial_text" class="form-control @error('testimonial_text') is-invalid @enderror" rows="4" placeholder="Student's feedback about their placement...">{{ old('testimonial_text', $placement->testimonial_text) }}</textarea>
                        @error('testimonial_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Card -->
        <div class="col-lg-4">
            <div class="admin-card p-4 h-100">
                <h5 class="text-navy fw-bold mb-4 border-bottom pb-2">Media</h5>
                
                <div class="form-group mb-0">
                    <label class="form-label fw-bold"><i class="fas fa-image text-muted me-1"></i> Student Photo (Optional)</label>
                    
                    <div class="position-relative mt-2" style="border: 2px dashed #cbd5e1; border-radius: 8px; padding: {{ $placement->image_path ? '1rem' : '2rem' }}; text-align: center; cursor: pointer; transition: all 0.3s ease; background-color: #f8fafc;" onclick="document.getElementById('imageUpload').click()" id="dropzone">
                        
                        <div id="imagePreviewContainer" class="{{ $placement->image_path ? '' : 'd-none' }}">
                            <img id="imagePreview" src="{{ $placement->image_path ? Storage::url($placement->image_path) : '' }}" alt="Preview" style="max-width: 100%; max-height: 200px; border-radius: 4px; object-fit: contain;">
                            <p class="text-muted small mt-2 mb-0">Click to change image</p>
                        </div>
                        
                        <div id="uploadPrompt" class="{{ $placement->image_path ? 'd-none' : '' }}">
                            <i class="fas fa-cloud-upload-alt text-muted mb-2" style="font-size: 2.5rem;"></i>
                            <p class="mb-0 text-muted fw-bold">Click or drag image to upload</p>
                            <p class="text-muted small mt-1 mb-0">JPG, PNG, WEBP (Max: 2MB)</p>
                        </div>

                        <input type="file" name="image" id="imageUpload" class="d-none" accept="image/png, image/jpeg, image/jpg, image/webp" onchange="previewImage(this)">
                    </div>
                    @error('image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="col-12 mt-3 mb-5 d-flex gap-3 align-items-center">
            <button type="submit" class="btn btn-orange px-4 py-2 fw-bold"><i class="fas fa-save me-1"></i> Update Placement</button>
            <a href="{{ route('admin.placements.index') }}" class="btn btn-light px-4 py-2 border fw-bold text-muted">Cancel</a>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        const uploadPrompt = document.getElementById('uploadPrompt');
        const dropzone = document.getElementById('dropzone');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('d-none');
                uploadPrompt.classList.add('d-none');
                dropzone.style.padding = '1rem';
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            // Revert back to original DB image if any, otherwise hide
            const origSrc = "{{ $placement->image_path ? Storage::url($placement->image_path) : '' }}";
            if(origSrc) {
                previewImage.src = origSrc;
                previewContainer.classList.remove('d-none');
                uploadPrompt.classList.add('d-none');
                dropzone.style.padding = '1rem';
            } else {
                previewImage.src = '';
                previewContainer.classList.add('d-none');
                uploadPrompt.classList.remove('d-none');
                dropzone.style.padding = '2rem';
            }
        }
    }

    // Drag and drop support
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('imageUpload');

    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.style.borderColor = '#0ea5e9';
        dropzone.style.backgroundColor = '#e0f2fe';
    });

    dropzone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropzone.style.borderColor = '#cbd5e1';
        dropzone.style.backgroundColor = '#f8fafc';
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.style.borderColor = '#cbd5e1';
        dropzone.style.backgroundColor = '#f8fafc';
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            previewImage(fileInput);
        }
    });
</script>
@endpush
