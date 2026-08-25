<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Explore all job-guaranteed training programs across CS/IT, Electrical, Mechanical, Electronics, and Civil branches at Skill Bridge India Technologies.">
  <title>All Courses Catalog | Skill Bridge India Technologies</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('frontend/styles.css') }}">
</head>

<body>

  <!-- Top Bar -->
  <div class="top-bar">
    <div class="container top-bar-content">
      <div class="top-info">
        <div class="top-info-item"><i class="fas fa-phone-alt" style="color: #0ea5e9;"></i> <span>Helpline: <strong>+91 96492 40944</strong></span></div>
        <div class="top-info-item"><i class="fas fa-envelope" style="color: #0ea5e9;"></i> <span>info@skillbridgeindiatechnologies.com</span></div>
      </div>
      <div class="top-links">
        <a href="{{ route('placements') }}"><i class="fas fa-trophy"></i> Placement Wall</a>
        <a href="{{ route('contact') }}"><i class="fas fa-map-marker-alt"></i> Centers: Lucknow • Noida • Bhopal</a>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="container navbar-container">
      <a href="{{ route('home') }}" class="logo-wrapper">
        <img src="{{ asset('frontend/assets/logo_v1.png') }}" alt="Skill Bridge India Logo" class="logo-img">
      </a>
      <div class="nav-menu" id="navMenu">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
        <div class="nav-dropdown">
          <a href="{{ route('courses') }}" class="nav-link active">Courses <i class="fas fa-chevron-down text-xs"></i></a>
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
        <a href="{{ route('gallery') }}" class="nav-link">Gallery</a>
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
        <button class="btn btn-primary" onclick="openEnrollModal('All Courses Counselor Call')">
          <i class="fas fa-headset"></i> <span class="btn-label">Counseling</span>
        </button>
        <div class="mobile-toggle" id="mobileToggle"><i class="fas fa-bars"></i></div>
      </div>
    </div>
  </nav>

  <!-- Page Hero Header -->
  <section class="page-hero">
    <div class="container">
      <h1 class="page-hero-title">All Training Programs</h1>
      <p class="page-hero-subtitle">Comprehensive BTech-aligned industrial training programs with placement assistance
        across all engineering streams.</p>
      <div class="breadcrumb-list">
        <a href="{{ route('home') }}">Home</a> <i class="fas fa-chevron-right text-xs"></i>
        <span>Course Catalog</span>
      </div>
    </div>
  </section>

  <!-- Branch Categories Bar -->
  <section class="section-padding" style="padding-bottom: 2rem;">
    <div class="container">
      <div style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center; margin-bottom: 2rem;">
        <button class="btn btn-secondary filter-btn active" data-filter="all" style="padding: 0.7rem 1.4rem;">
          <i class="fas fa-list"></i> All Programs
        </button>
        @foreach($courseCategories as $category)
        <button class="btn btn-outline filter-btn" data-filter="{{ $category->slug }}" style="padding: 0.7rem 1.4rem;">
          @if($category->icon && \Illuminate\Support\Str::contains($category->icon, ['/', '.png', '.jpg', '.jpeg', '.svg', '.webp']))
              <img src="{{ \Illuminate\Support\Facades\Storage::url($category->icon) }}" alt="" style="width: 16px; height: 16px; object-fit: contain; display: inline-block; vertical-align: middle; margin-right: 0.2rem;">
            @else
              <i class="{{ $category->icon ?? 'fas fa-book' }}"></i>
            @endif {{ $category->name }}
        </button>
        @endforeach
      </div>

      <!-- Live Search Box -->
      <div class="search-box" style="max-width: 500px; margin: 0 auto 3rem auto;">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="search-input text-base" id="courseSearchInput"
          placeholder="Search any program (e.g. Python, PLC SCADA, MERN)..."
          style="width: 100%; padding-left: 2.8rem;">
      </div>

      <!-- Course Cards Container -->
      <div class="courses-grid" id="coursesContainer">
        <!-- Dynamically rendered via script.js -->
      </div>
    </div>
  </section>

  <!-- Modals -->
  <div class="modal-overlay" id="courseModalOverlay">
    <div class="modal-card">
      <button class="modal-close" onclick="closeModal('courseModalOverlay')"><i class="fas fa-times"></i></button>
      <div class="modal-header">
        <h3 id="courseModalTitle">Course Details</h3>
      </div>
      <div class="modal-body" id="courseModalBody"></div>
    </div>
  </div>

    @include('frontend.partials.enroll_modal')

  <div class="toast-notification" id="toastNotification">
    <i class="fas fa-check-circle heading-md text-accent-cyan"></i>
    <span id="toastText">Action successful!</span>
  </div>

  <!-- Footer -->
  @include('frontend.partials.footer')

  <script>
    window.coursesData = @json($formattedCourses);
  </script>
  <script src="{{ asset('frontend/script.js') }}"></script>
</body>

</html>