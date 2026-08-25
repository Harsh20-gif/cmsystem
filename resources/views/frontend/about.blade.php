<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="{{ isset($page) && $page->seo_description ? $page->seo_description : 'About Skill Bridge India Technologies - Leader in BTech engineering training, practical lab skilling, and placement programs across Noida, Lucknow, and Bhopal.' }}">
  <title>{{ isset($page) && $page->seo_title ? $page->seo_title : (isset($page) ? $page->title : 'About Us | Skill Bridge India Technologies') }}</title>
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
        <a href="{{ route('corporate-training') }}" class="nav-link">Trainings</a>
        <a href="{{ route('placements') }}" class="nav-link">Placements</a>
        <a href="{{ route('gallery') }}" class="nav-link">Gallery</a>
        <a href="{{ route('about') }}" class="nav-link active">About Us</a>
        <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
      </div>
      <div class="nav-actions">
        <button class="btn btn-primary" onclick="openEnrollModal('General Inquiry')">
          <i class="fas fa-paper-plane"></i> <span class="btn-label">Quick Inquiry</span>
        </button>
        <div class="mobile-toggle" id="mobileToggle"><i class="fas fa-bars"></i></div>
      </div>
    </div>
  </nav>

  <!-- Page Hero Header -->
  <section class="page-hero">
    <div class="container">
      <h1 class="page-hero-title">{{ isset($page) ? $page->title : 'About Skill Bridge India' }}</h1>
      <p class="page-hero-subtitle">Transforming engineering education into real industry capabilities through practical
        labs, live projects, and 100% placement support.</p>
      <div class="breadcrumb-list">
        <a href="{{ route('home') }}">Home</a> <i class="fas fa-chevron-right text-xs"></i>
        <span>About Us</span>
      </div>
    </div>
  </section>

  @if(isset($page) && $page->content)
  <section class="section-padding">
    <div class="container">
      {!! $page->content !!}
    </div>
  </section>
  @else
  <!-- Company Overview -->
  <section class="section-padding">
    <div class="container">
      <div class="hero-grid" style="align-items: center; gap: 3.5rem;">
        <div>
          <span class="badge-tag"><i class="fas fa-shield-alt"></i> ISO 9001:2015 Certified Institute</span>
          <h2 class="section-title" style="text-align: left;">Bridging Academic Knowledge & <span
              class="highlight">Corporate Execution</span></h2>
          <p class="text-lg text-slate-body" style="margin-bottom: 1.2rem;">
            Established with a vision to eliminate the skill gap among engineering graduates, Skill Bridge India
            Technologies Pvt Ltd delivers industry-aligned training across CS/IT, Electrical, Mechanical, Electronics,
            and Civil streams.
          </p>
          <p class="text-base text-slate-muted" style="margin-bottom: 2rem;">
            With state-of-the-art training centers in Noida, Lucknow, and Bhopal, we equip students with real-world
            project exposure, hands-on PLC SCADA & MEP hardware labs, cloud computing pipelines, and AI frameworks.
          </p>

          <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.2rem;">
            <div style="display: flex; gap: 0.8rem; align-items: center;">
              <i class="fas fa-check-circle text-accent-cyan-dark heading-md"></i>
              <strong class="text-navy-dark">350+ Hiring Tie-ups</strong>
            </div>
            <div style="display: flex; gap: 0.8rem; align-items: center;">
              <i class="fas fa-check-circle text-accent-cyan-dark heading-md"></i>
              <strong class="text-navy-dark">12,500+ Alumni Placed</strong>
            </div>
            <div style="display: flex; gap: 0.8rem; align-items: center;">
              <i class="fas fa-check-circle text-accent-cyan-dark heading-md"></i>
              <strong class="text-navy-dark">1-on-1 Mentor Support</strong>
            </div>
            <div style="display: flex; gap: 0.8rem; align-items: center;">
              <i class="fas fa-check-circle text-accent-cyan-dark heading-md"></i>
              <strong class="text-navy-dark">Summer & Winter Batches</strong>
            </div>
          </div>
        </div>

        <div class="hero-image-card">
          <img src="{{ asset('frontend/assets/hero.jpg') }}" alt="Scortek Inspired Skill Bridge India Lab Facility">
        </div>
      </div>
    </div>
  </section>
  @endif

  <!-- Leadership Team -->
  <section class="section-padding bg-surface" id="team">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-users-gear"></i> Expert Leadership</div>
        <h2 class="section-title">Our Directors & <span class="highlight">Industry Mentors</span></h2>
        <p class="section-subtitle">Guiding engineering students toward career excellence with decades of corporate tech
          experience.</p>
      </div>

      <div class="team-grid">
        @forelse($teamMembers as $member)
        <div class="team-card">
          <img src="{{ $member->photo ? \Illuminate\Support\Facades\Storage::url($member->photo) : asset('frontend/assets/hero.jpg') }}" alt="{{ $member->name }}" class="team-avatar">
          <div class="team-body">
            <div class="team-name">{{ $member->name }}</div>
            <div class="team-role">{{ $member->designation }}</div>
            <p class="team-bio">{{ $member->bio }}</p>
          </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted w-100" style="padding: 2rem;">
          <p>No leadership team members available yet.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Lab Infrastructure Section -->
  <section class="section-padding" id="infra">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-microchip"></i> Hands-On Facilities</div>
        <h2 class="section-title">State-of-the-Art <span class="highlight">Lab Infrastructure</span></h2>
        <p class="section-subtitle">Modern practical workstations equipped for software development, cloud computing,
          and core engineering setups.</p>
      </div>

      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon-wrapper navy"><i class="fas fa-desktop"></i></div>
          <h3>Fullstack & AI High-End Computer Labs</h3>
          <p>High-performance workstations with cloud sandbox environments, GPU acceleration for AI/ML models, and
            fullstack dev suites.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon-wrapper orange"><i class="fas fa-bolt"></i></div>
          <h3>Siemens & Allen Bradley PLC SCADA Stations</h3>
          <p>Industrial automation training hardware with real PLC panels, SCADA monitors, sensors, and pneumatic
            actuators.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon-wrapper green"><i class="fas fa-building-gear"></i></div>
          <h3>HVAC & MEP Engineering Workstations</h3>
          <p>Complete MEP design tools, HVAC chiller systems, duct sizing software, and building management system (BMS)
            hardware.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  @include('frontend.partials.footer')

  <script src="{{ asset('frontend/script.js') }}"></script>
</body>

</html>