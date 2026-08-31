@extends('layouts.app')

@section('title', 'Photo Gallery & Events | Skill Bridge India')

@push('styles')
<style>
  /* Gallery Grid Specific Styles */
  .gallery-filter-bar {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
  }
  .filter-pill {
    background: transparent;
    border: 2px solid var(--accent-cyan);
    color: var(--accent-cyan);
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
  }
  .filter-pill:hover,
  .filter-pill.active {
    background: var(--accent-cyan);
    color: var(--navy-dark);
  }
  
  .gallery-img-wrapper {
    position: relative;
    aspect-ratio: 1/1;
    overflow: hidden;
    border-radius: 8px;
    cursor: pointer;
    box-shadow: var(--shadow-sm);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .gallery-img-wrapper:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
  }
  .gallery-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  .gallery-img-wrapper:hover img {
    transform: scale(1.1);
  }
  .gallery-overlay {
    position: absolute;
    inset: 0;
    background: rgba(15, 23, 42, 0.4);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .gallery-img-wrapper:hover .gallery-overlay {
    opacity: 1;
  }
  .gallery-overlay i {
    color: white;
    font-size: 2rem;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
    transform: scale(0.5);
    transition: transform 0.3s ease;
  }
  .gallery-img-wrapper:hover .gallery-overlay i {
    transform: scale(1);
  }

  /* Lightbox Styles */
  .lightbox-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.95);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
  }
  .lightbox-overlay.active {
    opacity: 1;
    pointer-events: auto;
  }
  .lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 90vh;
  }
  .lightbox-content img {
    max-width: 100%;
    max-height: 90vh;
    object-fit: contain;
    border-radius: 4px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
  }
  .lightbox-close {
    position: absolute;
    top: 20px;
    right: 30px;
    background: none;
    border: none;
    color: white;
    font-size: 2rem;
    cursor: pointer;
    transition: color 0.2s;
  }
  .lightbox-close:hover { color: var(--accent-cyan); }
  .lightbox-prev,
  .lightbox-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.1);
    border: none;
    color: white;
    font-size: 2rem;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
  }
  .lightbox-prev:hover,
  .lightbox-next:hover {
    background: rgba(255,255,255,0.3);
  }
  .lightbox-prev { left: 20px; }
  .lightbox-next { right: 20px; }
  .lightbox-counter {
    position: absolute;
    bottom: -30px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    font-weight: bold;
    font-size: 1.1rem;
    letter-spacing: 2px;
  }
  
  @media (max-width: 768px) {
    .lightbox-prev, .lightbox-next {
      width: 40px;
      height: 40px;
      font-size: 1.2rem;
    }
    .lightbox-prev { left: 10px; }
    .lightbox-next { right: 10px; }
  }
</style>
@endpush

@section('content')

<x-page-hero 
    title="{{ $siteSettings['gallery_hero_title'] ?? 'Campus & Training Gallery' }}"
    subtitle="{{ $siteSettings['gallery_hero_subtitle'] ?? 'Take a glimpse into our state-of-the-art infrastructure, classroom sessions, hardware labs, and student life.' }}"
    breadcrumbItem="{{ $siteSettings['gallery_hero_breadcrumb'] ?? 'Gallery' }}"
/>

  <!-- Main Gallery Section -->
  <section class="bg-navy-alt" style="padding: 4rem 0; min-height: 60vh;">
    <div class="container">

      @php
          // Only show albums that have images
          $validAlbums = $albums->filter(function($album) {
              return $album->images->count() > 0;
          });
      @endphp

      @if($validAlbums->count() > 0)
          <!-- Filter Tabs -->
          <div class="gallery-filter-bar">
            <button class="filter-pill active" data-filter="all">{{ $siteSettings['gallery_filter_all_label'] ?? 'All Photos' }}</button>
            @foreach($validAlbums as $album)
                <button class="filter-pill" data-filter="{{ $album->id }}">{{ $album->title }}</button>
            @endforeach
          </div>

          <!-- Gallery Grid -->
          <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 g-4" id="galleryGrid">
            @foreach($validAlbums as $album)
                @foreach($album->images as $image)
                    <div class="col gallery-image-item" data-album-id="{{ $album->id }}">
                        <div class="gallery-img-wrapper" data-img-src="{{ Str::startsWith($image->image_path, 'http') ? $image->image_path : Storage::url($image->image_path) }}">
                            <img src="{{ Str::startsWith($image->image_path, 'http') ? $image->image_path : Storage::url($image->image_path) }}" alt="{{ $album->title }} photo" loading="lazy">
                            <div class="gallery-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
          </div>
      @else
          <div class="text-center py-5">
              <p class="text-muted fs-5"><i class="fas fa-camera text-secondary me-2"></i> {{ $siteSettings['gallery_empty_text'] ?? 'No gallery albums found. Check back later for updates.' }}</p>
          </div>
      @endif

    </div>
  </section>

  <!-- CTA Banner Section -->
  <section class="text-white bg-primary-gradient" style="padding: 4rem 0; text-align: center;">
    <div class="container">
      <h2 class="heading-lg font-extrabold" style="margin-bottom: 1rem;">{{ $siteSettings['gallery_cta_title'] ?? 'Experience Live Labs at Our Campus Centers' }}</h2>
      <p class="text-lg" style="max-width: 700px; margin: 0 auto 2rem auto; opacity: 0.95;">{{ $siteSettings['gallery_cta_subtitle'] ?? 'Visit our training centers in Lucknow, Noida, or Bhopal for a free hands-on demo class and lab orientation before enrolling.' }}</p>
      <button class="btn btn-secondary font-bold text-navy-dark bg-white" onclick="openEnrollModal('Campus Tour Request')">
        <i class="fas fa-calendar-check"></i> {{ $siteSettings['gallery_cta_button_label'] ?? 'Book a Free Campus Tour' }}
      </button>
    </div>
  </section>

  <!-- Fullscreen Lightbox Modal -->
  <div class="lightbox-overlay" id="lightboxModal">
    <button class="lightbox-close" id="lbClose"><i class="fas fa-times"></i></button>
    <button class="lightbox-prev" id="lbPrev"><i class="fas fa-chevron-left"></i></button>
    <button class="lightbox-next" id="lbNext"><i class="fas fa-chevron-right"></i></button>
    
    <div class="lightbox-content">
      <img src="" alt="Gallery Preview" id="lightboxImage">
      <div class="lightbox-counter" id="lightboxCounter">1 / 10</div>
    </div>
  </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const filterBtns = document.querySelectorAll('.filter-pill');
    const galleryItems = document.querySelectorAll('.gallery-image-item');
    
    // Lightbox Elements
    const lightboxModal = document.getElementById('lightboxModal');
    const lightboxImg = document.getElementById('lightboxImage');
    const lightboxCounter = document.getElementById('lightboxCounter');
    const lbClose = document.getElementById('lbClose');
    const lbNext = document.getElementById('lbNext');
    const lbPrev = document.getElementById('lbPrev');
    
    let visibleImages = [];
    let currentImageIndex = 0;

    // Filter Logic
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active state
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const filterValue = btn.getAttribute('data-filter');
            
            // Show/Hide items based on filter
            galleryItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-album-id') === filterValue) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Lightbox Logic
    const openLightbox = (index) => {
        // Collect currently visible image elements dynamically
        visibleImages = Array.from(document.querySelectorAll('.gallery-image-item')).filter(el => el.style.display !== 'none');
        
        // Find the index of the clicked item within the visible array
        // The index passed here is the absolute index across ALL items, so we match by src instead.
        // Or better yet, we just attach a click listener to the wrapper and build the visible array on click.
    };

    // Attach click to image wrappers
    document.querySelectorAll('.gallery-img-wrapper').forEach(wrapper => {
        wrapper.addEventListener('click', function() {
            // On click, gather only currently visible items
            visibleImages = Array.from(document.querySelectorAll('.gallery-image-item')).filter(el => el.style.display !== 'none');
            
            // Find which index we just clicked within the visible array
            const parentItem = this.closest('.gallery-image-item');
            currentImageIndex = visibleImages.indexOf(parentItem);
            
            updateLightbox();
            lightboxModal.classList.add('active');
        });
    });

    const updateLightbox = () => {
        if (visibleImages.length === 0) return;
        
        // Wrap around logic
        if (currentImageIndex >= visibleImages.length) currentImageIndex = 0;
        if (currentImageIndex < 0) currentImageIndex = visibleImages.length - 1;
        
        // Get image source from the data attribute of the wrapper
        const wrapper = visibleImages[currentImageIndex].querySelector('.gallery-img-wrapper');
        const src = wrapper.getAttribute('data-img-src');
        
        lightboxImg.src = src;
        lightboxCounter.textContent = (currentImageIndex + 1) + " / " + visibleImages.length;
    };

    const closeLightbox = () => {
        lightboxModal.classList.remove('active');
    };

    const nextImage = () => {
        currentImageIndex++;
        updateLightbox();
    };

    const prevImage = () => {
        currentImageIndex--;
        updateLightbox();
    };

    // Event Listeners for controls
    lbClose.addEventListener('click', closeLightbox);
    lbNext.addEventListener('click', nextImage);
    lbPrev.addEventListener('click', prevImage);
    lightboxModal.addEventListener('click', (e) => {
        if(e.target === lightboxModal) closeLightbox(); // Click outside to close
    });

    // Keyboard support
    document.addEventListener('keydown', (e) => {
        if (!lightboxModal.classList.contains('active')) return;
        
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
    });

    // Basic swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    lightboxModal.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    lightboxModal.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 50) { // Threshold
            if (diff > 0) nextImage();
            else prevImage();
        }
    }
});
</script>
@endpush
