<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Summer & Winter Industrial Internship Training for BTech engineering students. University MOUs, Campus Workshops, and Corporate Training by Skill Bridge India.">
  <title>Summer & Winter Industrial Training | Skill Bridge India Technologies</title>
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
        <a href="{{ route('contact') }}"><i class="fas fa-map-marker-alt"></i> Branch Centers</a>
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
        <a href="{{ route('corporate-training') }}" class="nav-link active">Trainings</a>
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
        <button class="btn btn-primary" onclick="openEnrollModal('Summer/Winter Internship 2026')">
          <i class="fas fa-calendar-alt"></i> <span class="btn-label">Apply for 2026 Batch</span>
        </button>
        <div class="mobile-toggle" id="mobileToggle"><i class="fas fa-bars"></i></div>
      </div>
    </div>
  </nav>

  <!-- Page Hero Header -->
  <section class="page-hero">
    <div class="container">
      <h1 class="page-hero-title">Summer & Winter Industrial Training</h1>
      <p class="page-hero-subtitle">Comprehensive 4 to 8 week project-based industrial internship programs for BTech
        (2nd, 3rd, 4th year) and Polytechnic Diploma students.</p>
      <div class="breadcrumb-list">
        <a href="{{ route('home') }}">Home</a> <i class="fas fa-chevron-right text-xs"></i>
        <span>Institutional & Industrial Training</span>
      </div>
    </div>
  </section>

  <!-- Institutional Collaboration Overview -->
  <section class="section-padding">
    <div class="container">
      <div class="aktu-box" style="margin-bottom: 3.5rem;">
        <div class="aktu-header">
          <div>
            <span class="aktu-badge"><i class="fas fa-university"></i> University & College MOUs</span>
            <h2 class="heading-lg text-navy-dark" style="margin-bottom: 0.5rem;">
              AKTU & University Collaboration Programs 2026
            </h2>
            <p class="text-base text-slate-body">
              Skill Bridge India partners with engineering colleges across Uttar Pradesh, Delhi NCR, and Madhya Pradesh
              to deliver syllabus-aligned industrial training, faculty development (FDP), and on-campus placement
              drives.
            </p>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 2rem;">
          <div class="feature-card" style="padding: 1.5rem;">
            <i class="fas fa-certificate heading-lg text-accent-coral"
              style="margin-bottom: 0.8rem;"></i>
            <h4>Valid Certificate & Project Report</h4>
            <p>ISO certified 4/6/8 week training certificate with verified project report required for university
              submission.</p>
          </div>
          <div class="feature-card" style="padding: 1.5rem;">
            <i class="fas fa-laptop-code heading-lg text-accent-cyan-dark"
              style="margin-bottom: 0.8rem;"></i>
            <h4>Live Hardware & Software Labs</h4>
            <p>Hands-on practice on real industrial software (React, Python, AWS, AutoCad, Revit, PLC SCADA, MEP
              hardware).</p>
          </div>
          <div class="feature-card" style="padding: 1.5rem;">
            <i class="fas fa-briefcase heading-lg text-navy-primary" style="margin-bottom: 0.8rem;"></i>
            <h4>Direct Placement Drive Eligibility</h4>
            <p>All internship candidates gain lifetime access to our 350+ corporate hiring drives and interview prep
              calls.</p>
          </div>
        </div>
      </div>

      <!-- Training Tracks for Engineering Branches -->
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-graduation-cap"></i> Internship Tracks</div>
        <h2 class="section-title">Seasonal Training <span class="highlight">Tracks (2026 Batch)</span></h2>
        <p class="section-subtitle">Select your branch specialization for 4-Week, 6-Week, or 6-Month industrial
          internship modules.</p>
      </div>

      <div class="courses-grid">
        @forelse($trainings as $training)
        <div class="course-card">
          @if($training->image)
          <img src="{{ \Illuminate\Support\Facades\Storage::url($training->image) }}" alt="{{ $training->title }}" class="course-img" style="width: 100%; height: 200px; object-fit: cover;">
          @endif
          <div class="course-body">
            <h3 class="course-title">{{ $training->title }}</h3>
            <p class="course-desc">{!! Str::limit(strip_tags($training->description), 100) !!}</p>
            <div class="course-footer">
              <span class="font-bold text-navy-dark">Duration: {{ $training->duration ?? 'N/A' }}</span>
              <button class="btn btn-primary" onclick="openEnrollModal('{{ addslashes($training->title) }}')">Apply Now</button>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p>No trainings available at the moment.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Modals -->
    @include('frontend.partials.enroll_modal')

  <div class="toast-notification" id="toastNotification">
    <i class="fas fa-check-circle heading-md text-accent-cyan"></i>
    <span id="toastText">Action successful!</span>
  </div>

  <!-- Footer -->
  @include('frontend.partials.footer')

  <script src="{{ asset('frontend/script.js') }}"></script>
</body>

</html>