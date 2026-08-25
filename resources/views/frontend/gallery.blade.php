<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Skill Bridge India Technologies Photo Gallery - Practical Labs, Campus Seminars, Industrial Workshops, and On-Campus Placement Drives in Lucknow, Noida, and Bhopal.">
  <title>Photo Gallery | Skill Bridge India Technologies</title>

  <!-- Font Awesome Icons & Google Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('frontend/styles.css') }}">
  <style>
    .gallery-filter-bar {
      display: flex;
      justify-content: center;
      gap: 1rem;
      flex-wrap: wrap;
      margin-bottom: 2.5rem;
    }

    .filter-tab {
      padding: 0.6rem 1.4rem;
      border-radius: 30px;
      background: var(--navy-surface);
      color: var(--navy-dark);
      border: 1px solid var(--border-light);
      font-weight: 600;
      font-size: 0.9rem;
      cursor: pointer;
      transition: var(--transition-fast);
    }

    .filter-tab.active,
    .filter-tab:hover {
      background: var(--primary-gradient);
      color: white;
      border-color: transparent;
      box-shadow: var(--shadow-sm);
    }

    .full-gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 1.8rem;
    }

    .gallery-item-card {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--border-light);
      transition: var(--transition-normal);
      display: flex;
      flex-direction: column;
    }

    .gallery-item-card:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-md);
    }

    .gallery-img-box {
      position: relative;
      height: 220px;
      overflow: hidden;
    }

    .gallery-img-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .gallery-item-card:hover .gallery-img-box img {
      transform: scale(1.08);
    }

    .gallery-badge {
      position: absolute;
      top: 12px;
      left: 12px;
      background: rgba(15, 23, 42, 0.85);
      color: white;
      padding: 0.35rem 0.8rem;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      backdrop-filter: blur(4px);
    }

    .gallery-body {
      padding: 1.2rem;
    }

    .gallery-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--navy-dark);
      margin-bottom: 0.4rem;
    }

    .gallery-desc {
      font-size: 0.88rem;
      color: var(--slate-body);
      line-height: 1.5;
    }
  </style>
</head>

<body>

  <!-- Top Contact Bar -->
  <div class="top-bar">
    <div class="container top-bar-content">
      <div class="top-info">
        <div class="top-info-item"><i class="fas fa-phone-alt" style="color: #0ea5e9;"></i> <span>Helpline: <strong>+91 96492 40944</strong></span></div>
        <div class="top-info-item"><i class="fas fa-envelope" style="color: #0ea5e9;"></i> <span>info@skillbridgeindiatechnologies.com</span></div>
      </div>
      <div class="top-links">
        <a href="{{ route('placements') }}"><i class="fas fa-trophy"></i> 100% Placement Wall</a>
        <a href="javascript:void(0)" onclick="openEnrollModal('Gallery Inquiry')"><i class="fas fa-headset"></i> Student
          Helpdesk</a>
      </div>
    </div>
  </div>

  <!-- Sticky Navigation Bar -->
  <nav class="navbar">
    <div class="container navbar-container">
      <a href="{{ route('home') }}" class="logo-wrapper">
        <img src="{{ asset('frontend/assets/logo_v1.png') }}" alt="Skill Bridge India Logo" class="logo-img">
      </a>
      <div class="nav-menu" id="navMenu">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
        <div class="nav-dropdown">
          <a href="{{ route('courses') }}" class="nav-link">Courses <i class="fas fa-chevron-down text-xs"></i></a>
          <div class="dropdown-menu-custom">
            @foreach($courseCategories as $category)
            <a href="{{ route('courses') }}?category={{ $category->slug }}" class="dropdown-item-custom">
              @if($category->icon && \Illuminate\Support\Str::contains($category->icon, ['/', '.png', '.jpg', '.jpeg', '.svg', '.webp']))
              <img src="{{ \Illuminate\Support\Facades\Storage::url($category->icon) }}" alt="" style="width: 16px; height: 16px; object-fit: contain; display: inline-block; vertical-align: middle; margin-right: 0.2rem;">
            @else
              <i class="{{ $category->icon ?? 'fas fa-book' }}"></i>
            @endif {{ $category->name }}
            </a>
            @endforeach
          </div>
        </div>
        <a href="{{ route('corporate-training') }}" class="nav-link">Trainings</a>
        <a href="{{ route('placements') }}" class="nav-link">Placements</a>
        <a href="{{ route('gallery') }}" class="nav-link active">Gallery</a>
        <div class="nav-dropdown">
          <a href="{{ route('about') }}" class="nav-link">About Us <i class="fas fa-chevron-down text-xs"></i></a>
          <div class="dropdown-menu-custom">
            <a href="{{ route('about') }}" class="dropdown-item-custom"><i class="fas fa-building"></i> About Our
              Institute</a>
            <a href="about.html#team" class="dropdown-item-custom"><i class="fas fa-users-gear"></i> Leadership Team</a>
            <a href="about.html#infra" class="dropdown-item-custom"><i class="fas fa-microchip"></i> Lab
              Infrastructure</a>
          </div>
        </div>
        <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
      </div>
      <div class="nav-actions">
        <button class="btn btn-primary" onclick="openEnrollModal('Gallery Page Booking')">
          <i class="fas fa-images"></i> <span class="btn-label">Visit Campus</span>
        </button>
        <div class="mobile-toggle" id="mobileToggle"><i class="fas fa-bars"></i></div>
      </div>
    </div>
  </nav>

  <!-- Page Hero Header -->
  <section class="page-hero">
    <div class="container">
      <h1 class="page-hero-title">Campus & Training Photo Gallery</h1>
      <p class="page-hero-subtitle">Explore live practical lab sessions, university MOU campus drives, industrial
        workshops, and student success celebrations at Skill Bridge India.</p>
    </div>
  </section>

  <!-- Main Gallery Section -->
  <section class="bg-navy-alt" style="padding: 4rem 0;">
    <div class="container">

      <!-- Filter Tabs -->
      <div class="gallery-filter-bar">
        <button class="filter-tab active" onclick="filterGallery('all', this)">All Photos</button>
        @php
            $categories = $albums->pluck('category')->unique()->filter();
        @endphp
        @foreach($categories as $category)
            <button class="filter-tab" onclick="filterGallery('{{ Str::slug($category) }}', this)">{{ $category }}</button>
        @endforeach
      </div>

      <!-- Gallery Grid -->
      <div class="full-gallery-grid" id="galleryGrid">
        @forelse($albums as $album)
        <div class="gallery-item-card" data-category="{{ Str::slug($album->category) }}">
          <div class="gallery-img-box">
            <img src="{{ $album->cover_image ? \Illuminate\Support\Facades\Storage::url($album->cover_image) : asset('frontend/assets/logo_v1.png') }}" alt="{{ $album->title }}">
            <span class="gallery-badge"><i class="fas fa-camera"></i> {{ $album->category ?? 'Gallery' }}</span>
          </div>
          <div class="gallery-body">
            <h3 class="gallery-title">{{ $album->title }}</h3>
            <p class="gallery-desc">{{ Str::limit(strip_tags($album->description), 100) }}</p>
          </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">No gallery albums available at the moment.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- CTA Banner Section -->
  <section class="text-white bg-primary-gradient" style="padding: 4rem 0; text-align: center;">
    <div class="container">
      <h2 class="heading-lg font-extrabold" style="margin-bottom: 1rem;">Experience Live Labs at Our Campus Centers
      </h2>
      <p class="text-lg" style="max-width: 700px; margin: 0 auto 2rem auto; opacity: 0.95;">Visit our training
        centers in Lucknow, Noida, or Bhopal for a free hands-on demo class and lab orientation before enrolling.</p>
      <button class="btn btn-secondary font-bold text-navy-dark bg-white" onclick="openEnrollModal('Campus Tour Request')">
        <i class="fas fa-calendar-check"></i> Book a Free Campus Tour
      </button>
    </div>
  </section>

  <!-- Enrollment Modal -->
  <div class="modal-overlay" id="enrollModal">
    <div class="modal-card">
      <button class="modal-close" onclick="closeEnrollModal()"><i class="fas fa-times"></i></button>
      <h3 class="heading-md font-extrabold text-navy-dark" style="margin-bottom: 0.5rem;" id="modalTitle">
        Book Demo / Inquiry</h3>
      <p class="text-sm text-slate-body" style="margin-bottom: 1.5rem;">Fill out the form below to connect
        with our academic counselors.</p>

      <form onsubmit="handleFormSubmit(event, 'enrollModal')">
        <div class="form-group">
          <label class="form-label">Full Name *</label>
          <input type="text" class="form-control" placeholder="e.g. Rahul Sharma" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Mobile Number *</label>
            <input type="tel" class="form-control" placeholder="+91 98765 43210" required>
          </div>
          <div class="form-group">
            <label class="form-label">Branch Center *</label>
            <select class="form-control" required>
              <option value="Lucknow">Lucknow Center</option>
              <option value="Noida">Noida Center</option>
              <option value="Bhopal">Bhopal Center</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Interested Field</label>
          <select class="form-control">
            <option value="CS & IT">Computer Science & IT (Fullstack / AI)</option>
            <option value="Electrical">Electrical & Automation (PLC SCADA)</option>
            <option value="Mechanical">Mechanical & MEP / HVAC Design</option>
            <option value="Electronics">Electronics & Embedded / IoT</option>
            <option value="Civil">Civil & AutoCad / Revit</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
          <i class="fas fa-paper-plane"></i> Submit Request
        </button>
      </form>
    </div>
  </div>

  <!-- Toast Notification -->
  <div class="toast-notification" id="toastNotification">
    <i class="fas fa-check-circle heading-md text-accent-cyan"></i>
    <span id="toastText">Action successful!</span>
  </div>

  <!-- Footer -->
  @include('frontend.partials.footer')

  <script src="{{ asset('frontend/script.js') }}"></script>
  <script>
    function filterGallery(category, btn) {
      const tabs = document.querySelectorAll('.filter-tab');
      tabs.forEach(t => t.classList.remove('active'));
      if (btn) btn.classList.add('active');

      const items = document.querySelectorAll('.gallery-item-card');
      items.forEach(item => {
        if (category === 'all' || item.getAttribute('data-category') === category) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });
    }
  </script>
</body>

</html>