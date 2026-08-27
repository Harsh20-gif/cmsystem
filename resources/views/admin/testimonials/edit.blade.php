@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-navy fw-bold">
        <i class="fas fa-edit text-orange me-2"></i>Edit Testimonial
    </h4>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to List
    </a>
</div>

<form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Main Form Column (Desktop) -->
        <div class="col-lg-8 col-12">
            
            <x-form-section title="Reviewer Info" icon="fas fa-user-circle">
                <div class="row gy-4">
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-user text-muted me-1"></i> Reviewer Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $testimonial->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-briefcase text-muted me-1"></i> Role / Company <small class="text-muted fw-normal">(Optional)</small>
                        </label>
                        <input type="text" name="role_or_company" class="form-control @error('role_or_company') is-invalid @enderror" value="{{ old('role_or_company', $testimonial->role_or_company) }}" placeholder="e.g. Student / CEO at TechCorp">
                        @error('role_or_company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <x-form-section title="Testimonial Content" icon="fas fa-quote-left">
                <div class="row gy-4">
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-comment-alt text-muted me-1"></i> Testimonial Content <span class="text-danger">*</span>
                        </label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="6" required>{{ old('content', $testimonial->content) }}</textarea>
                        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fab fa-youtube text-danger me-1"></i> Video URL <small class="text-muted fw-normal">(Optional)</small>
                        </label>
                        <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url', $testimonial->video_url) }}" placeholder="https://www.youtube.com/watch?v=...">
                        <div class="form-text"><i class="fas fa-info-circle me-1"></i> Paste a valid YouTube or Vimeo URL. Leave blank for a text-only testimonial.</div>
                        @error('video_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>
            
        </div>

        <!-- Right Column (Desktop) -->
        <div class="col-lg-4 col-12">
            
            <x-form-section title="Reviewer Photo" icon="fas fa-image">
                <div class="col-12">
                    <x-media-picker name="photo" id="photo" label="" :value="old('photo', $testimonial->photo)" />
                </div>
            </x-form-section>

            <x-form-section title="Rating & Display" icon="fas fa-star-half-alt">
                <div class="row gy-4">
                    
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-star text-warning me-1"></i> Rating <span class="text-danger">*</span>
                        </label>
                        
                        <!-- Interactive Star Picker UI -->
                        <div id="star-rating-container" class="d-flex align-items-center mb-2" style="cursor: pointer;">
                            @for($i=1; $i<=5; $i++)
                                <i class="fas fa-star fa-2x star-icon {{ old('rating', $testimonial->rating) >= $i ? 'text-warning' : 'text-light' }}" data-value="{{ $i }}"></i>
                            @endfor
                            <span id="rating-text" class="ms-3 fw-bold text-dark fs-5">{{ old('rating', $testimonial->rating) }}/5</span>
                        </div>
                        
                        <!-- Hidden underlying input -->
                        <select name="rating" id="rating-select" class="d-none @error('rating') is-invalid @enderror" required>
                            <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>5 Stars</option>
                            <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>4 Stars</option>
                            <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>3 Stars</option>
                            <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>2 Stars</option>
                            <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>1 Star</option>
                        </select>
                        @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-sort-numeric-down text-muted me-1"></i> Order Position <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="order_position" class="form-control @error('order_position') is-invalid @enderror" value="{{ old('order_position', $testimonial->order_position) }}" required>
                        <div class="form-text"><i class="fas fa-info-circle me-1"></i> Lower numbers appear first.</div>
                        @error('order_position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-eye text-muted me-1"></i> Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="published" {{ old('status', $testimonial->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ old('status', $testimonial->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </x-form-section>

            <!-- Actions Area -->
            <div class="card shadow-sm border-0 mb-4 bg-white rounded-3 position-sticky" style="top: 20px;">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-orange w-100 mb-3 py-2 fw-semibold">
                        <i class="fas fa-save me-1"></i> Update Testimonial
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light w-100 text-muted">
                        Cancel
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Interactive Star Rating Logic
        const stars = document.querySelectorAll('.star-icon');
        const select = document.getElementById('rating-select');
        const ratingText = document.getElementById('rating-text');
        
        let currentRating = parseInt(select.value);

        function updateStars(rating) {
            stars.forEach(star => {
                const val = parseInt(star.getAttribute('data-value'));
                if (val <= rating) {
                    star.classList.remove('text-light');
                    star.classList.add('text-warning');
                } else {
                    star.classList.remove('text-warning');
                    star.classList.add('text-light');
                }
            });
        }

        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const val = parseInt(this.getAttribute('data-value'));
                updateStars(val);
                ratingText.textContent = val + '/5';
            });

            star.addEventListener('mouseout', function() {
                updateStars(currentRating);
                ratingText.textContent = currentRating + '/5';
            });

            star.addEventListener('click', function() {
                currentRating = parseInt(this.getAttribute('data-value'));
                select.value = currentRating;
                updateStars(currentRating);
                ratingText.textContent = currentRating + '/5';
            });
        });
    });
</script>
@endpush
@endsection
