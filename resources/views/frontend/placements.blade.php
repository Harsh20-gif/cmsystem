<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Skill Bridge India Placement Wall - 350+ corporate hiring partners, alumni success stories, packages up to 18 LPA, college MOUs & appreciation certificates.">
  <title>Placement Wall & Success Stories | Skill Bridge India Technologies</title>
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
        <a href="{{ route('placements') }}" class="active"><i class="fas fa-trophy"></i> Placement Wall</a>
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
        <a href="{{ route('corporate-training') }}" class="nav-link">Trainings</a>
        <a href="{{ route('placements') }}" class="nav-link active">Placements</a>
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
        <button class="btn btn-primary" onclick="openEnrollModal('Placement Drive Registration')">
          <i class="fas fa-briefcase"></i> <span class="btn-label">Join Placement Drive</span>
        </button>
        <div class="mobile-toggle" id="mobileToggle"><i class="fas fa-bars"></i></div>
      </div>
    </div>
  </nav>

  <!-- Page Hero Header -->
  <section class="page-hero">
    <div class="container">
      <h1 class="page-hero-title">100% Placement Wall</h1>
      <p class="page-hero-subtitle">Discover how 12,500+ BTech graduates launched their dream careers across 350+
        Fortune 500 companies and IT unicorns.</p>
      <div class="breadcrumb-list">
        <a href="{{ route('home') }}">Home</a> <i class="fas fa-chevron-right text-xs"></i>
        <span>Placements</span>
      </div>
    </div>
  </section>

  <!-- Corporate Partners Showcase -->
  <section class="section-padding">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-building"></i> Hiring Ecosystem</div>
        <h2 class="section-title">350+ Corporate <span class="highlight">Hiring Network</span></h2>
        <p class="section-subtitle">Our students are hired directly through on-campus drives, pooled placement sessions,
          and referral networks.</p>
      </div>

      <div class="partners-ticker" style="margin-bottom: 2rem;">
        @forelse($companies as $company)
          @if($company->logo)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($company->logo) }}" alt="{{ $company->name }}" class="partner-logo" style="height: 40px; width: auto; object-fit: contain;">
          @else
            <span class="partner-logo">{{ $company->name }}</span>
          @endif
        @empty
            <span class="partner-logo">TCS</span>
            <span class="partner-logo">INFOSYS</span>
            <span class="partner-logo">WIPRO</span>
            <span class="partner-logo">HCL TECH</span>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Student Success Wall Grid -->
  <section>
    <div class="container">
      <div class="section-header">
        <div class="badge-tag coral-tag"><i class="fas fa-trophy"></i> Alumni Achievements</div>
        <h2 class="section-title">Recent Student <span class="highlight">Placement Wall</span></h2>
        <p class="section-subtitle">Verified alumni placements with company details, designation, and salary packages.
        </p>
      </div>

      <div class="student-wall-grid">
        @forelse($placements as $placement)
        <div class="student-card">
          <div class="student-header">
            @if($placement->student && $placement->student->photo)
            <img src="{{ Storage::url($placement->student->photo) }}" alt="{{ $placement->student->name }}" class="student-avatar" style="object-fit: cover;">
            @else
            <img src="{{ asset('frontend/assets/hero.jpg') }}" alt="{{ $placement->student->name ?? 'Student' }}" class="student-avatar" style="object-fit: cover;">
            @endif
            <div class="student-info">
              <h4>{{ $placement->student->name ?? 'Unknown Student' }}</h4>
              <p>Placed at: <strong>{{ $placement->company->name ?? 'Unknown Company' }}</strong></p>
            </div>
          </div>
          <div class="placement-badge">
            @if($placement->package)
                <i class="fas fa-rupee-sign"></i> {{ $placement->package }} •
            @endif
            {{ $placement->position ?? ($placement->job_role ?? '') }}
          </div>
          @if($placement->testimonial_text)
          <p class="student-quote">"{{ $placement->testimonial_text }}"</p>
          @endif
        </div>
        @empty
        <div class="col-12 text-center py-5" style="grid-column: 1 / -1;">
            <p>No placements available at the moment.</p>
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