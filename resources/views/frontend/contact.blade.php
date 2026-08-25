<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Contact Skill Bridge India Technologies - Training centers in Lucknow, Noida, and Bhopal. Get in touch for BTech training, counseling, and placement drives.">
  <title>Contact Us & Branch Locations | Skill Bridge India Technologies</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('frontend/styles.css') }}">
</head>
<body>

  <!-- Top Bar -->
  <div class="top-bar">
    <div class="container top-bar-content">
      <div class="top-info">
        <div class="top-info-item"><i class="fas fa-phone-alt"></i> <span>Lucknow: <strong>+91 85428 41114</strong></span></div>
        <div class="top-info-item"><i class="fas fa-phone-alt"></i> <span>Noida: <strong>+91 98385 03859</strong></span></div>
        <div class="top-info-item"><i class="fas fa-envelope"></i> <span>info@skillbridgeindia.com</span></div>
      </div>
      <div class="top-links">
        <a href="{{ route('placements') }}"><i class="fas fa-trophy"></i> Placement Wall</a>
        <a href="{{ route('contact') }}" class="active"><i class="fas fa-map-marker-alt"></i> Centers: Lucknow • Noida • Bhopal</a>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="container navbar-container">
      <a href="{{ route('home') }}" class="logo-wrapper">
        <img src="{{ asset('frontend/assets/logo.svg') }}" alt="Skill Bridge India Logo" class="logo-img">
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
        <div class="nav-dropdown">
          <a href="{{ route('about') }}" class="nav-link">About Us <i class="fas fa-chevron-down text-xs"></i></a>
          <div class="dropdown-menu-custom">
            <a href="{{ route('about') }}" class="dropdown-item-custom"><i class="fas fa-building"></i> About Our Institute</a>
            <a href="{{ route('about') }}#team" class="dropdown-item-custom"><i class="fas fa-users-gear"></i> Leadership Team</a>
            <a href="{{ route('about') }}#infra" class="dropdown-item-custom"><i class="fas fa-microchip"></i> Lab Infrastructure</a>
          </div>
        </div>
        <a href="{{ route('contact') }}" class="nav-link active">Contact Us</a>
      </div>
      <div class="nav-actions">
        <button class="btn btn-primary" onclick="openEnrollModal('Contact Counseling')">
          <i class="fas fa-headset"></i> Call Center
        </button>
        <div class="mobile-toggle" id="mobileToggle"><i class="fas fa-bars"></i></div>
      </div>
    </div>
  </nav>

  <!-- Page Hero Header -->
  <section class="page-hero">
    <div class="container">
      <h1 class="page-hero-title">Contact Us & Virtual Support</h1>
      <p class="page-hero-subtitle">Reach out for free virtual career counseling, seat booking, and online internship admissions.</p>
      <div class="breadcrumb-list">
        <a href="{{ route('home') }}">Home</a> <i class="fas fa-chevron-right" style="font-size: 0.75rem;"></i> <span>Contact Us</span>
      </div>
    </div>
  </section>



  <!-- Interactive Contact Form & Map Section -->
  <section class="section-padding" style="background: var(--bg-surface);">
    <div class="container">
      <div class="hero-grid" style="align-items: start; gap: 3.5rem;">
        <div>
          <span class="badge-tag coral-tag" style="text-transform: uppercase;"><i class="fas fa-paper-plane"></i> Direct Inquiry</span>
          <h2 class="section-title" style="text-align: left;">Send Us a <span class="highlight">Message</span></h2>
          <p style="color: var(--slate-body); margin-bottom: 2rem;">Fill out the form below to connect with a senior career counselor within 30 minutes.</p>

          <form id="contactPageForm" onsubmit="handleEnrollSubmit(event)" style="background: var(--bg-pure-white); padding: 2.2rem; border-radius: var(--radius-lg); border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
            <div class="form-group">
              <label class="form-label">Full Name *</label>
              <input type="text" class="form-control" placeholder="Enter your full name" required>
            </div>
            <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Phone Number *</label>
                <input type="tel" class="form-control" placeholder="+91 98765 43210" required>
              </div>
              <div class="form-group">
                <label class="form-label">Email Address *</label>
                <input type="email" class="form-control" placeholder="name@domain.com" required>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Engineering Branch / Stream *</label>
              <select class="form-control" required>
                <option value="">Select Engineering Branch</option>
                <option value="CS">Computer Science & IT</option>
                <option value="EE">Electrical Engineering</option>
                <option value="ME">Mechanical Engineering</option>
                <option value="EC">Electronics & Communication</option>
                <option value="CE">Civil Engineering</option>
                <option value="Other">Other Graduate / Student</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Your Message or Inquiry</label>
              <textarea class="form-control" rows="4" placeholder="Tell us about your learning goals or batch queries..."></textarea>
            </div>
            <button type="submit" class="btn btn-outline" style="width: 100%;"><i class="fas fa-paper-plane"></i> Submit Inquiry</button>
          </form>
        </div>

        <div>
          <span class="badge-tag" style="background: var(--accent-cyan-light); color: var(--accent-cyan-dark); border-color: rgba(14, 165, 233, 0.25); text-transform: uppercase;"><i class="fas fa-clock"></i> Working Hours & Support</span>
          <h2 class="section-title" style="text-align: left;">Counseling <span class="highlight">Desk</span></h2>

          <div class="bg-pure-white" style="padding: 2rem; border-radius: var(--radius-lg); border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
            <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1.2rem;">
              <i class="fas fa-clock" style="font-size: 1.6rem; color: var(--accent-coral);"></i>
              <div>
                <strong style="display: block; color: var(--navy-dark); font-size: 1.05rem;">Center Timings</strong>
                <span style="color: var(--slate-muted); font-size: 0.9rem;">Monday - Saturday: 9:00 AM to 7:00 PM</span>
              </div>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1.2rem;">
              <i class="fas fa-headset" style="font-size: 1.6rem; color: var(--accent-cyan-dark);"></i>
              <div>
                <strong style="display: block; color: var(--navy-dark); font-size: 1.05rem;">Student Helpline</strong>
                <span style="color: var(--slate-muted); font-size: 0.9rem;">24x7 Helpline: +91 96492 40944</span>
              </div>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center;">
              <i class="fas fa-envelope-open-text" style="font-size: 1.6rem; color: var(--navy-primary);"></i>
              <div>
                <strong style="display: block; color: var(--navy-dark); font-size: 1.05rem;">Admissions Email</strong>
                <span style="color: var(--slate-muted); font-size: 0.9rem;">info@skillbridgeindiatechnologies.com</span>
              </div>
            </div>
          </div>

          <div style="background: var(--navy-dark); color: #FFFFFF; padding: 2.2rem; border-radius: var(--radius-lg); text-align: center;">
            <i class="fas fa-video" style="font-size: 3rem; color: var(--accent-cyan); margin-bottom: 1rem;"></i>
            <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Virtual Counseling</h3>
            <p style="color: rgba(255,255,255,0.85); font-size: 0.95rem; margin-bottom: 1.5rem;">Connect instantly with our mentors online for a live counseling session!</p>
            <button class="btn btn-outline" style="background: #FFFFFF; color: var(--navy-dark); border-color: transparent;" onclick="openEnrollModal('Online Demo Pass')"><i class="fas fa-desktop"></i> Get Online Demo Pass</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modals -->
  @include('frontend.partials.enroll_modal')

  <div class="toast-notification" id="toastNotification">
    <i class="fas fa-check-circle" style="color: var(--accent-cyan); font-size: 1.4rem;"></i>
    <span id="toastText">Action successful!</span>
  </div>

  <!-- Footer -->
  @include('frontend.partials.footer')

  <script src="{{ asset('frontend/script.js') }}"></script>
</body>
</html>