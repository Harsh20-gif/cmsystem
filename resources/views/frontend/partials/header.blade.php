<!-- ==========================================================================
     Top Contact Bar
     ========================================================================== -->
<div class="top-bar">
  <div class="container top-bar-content" style="justify-content: flex-end;">
    <div class="top-info">
      <div class="top-info-item"><i class="fas fa-phone" style="color: #0ea5e9;"></i> <span><strong>+91 8467912807</strong></span></div>
      <div class="top-info-item"><i class="fas fa-envelope" style="color: #0ea5e9;"></i> <span>info@skillbridgeindiatechnology.com</span></div>
    </div>
  </div>
</div>

<!-- ==========================================================================
     Sticky Navigation Bar with Custom Dropdowns
     ========================================================================== -->
<nav class="navbar">
  <div class="container navbar-container">
    <a href="{{ route('home') }}" class="logo-wrapper">
      <img src="{{ asset('frontend/assets/logo_v1.png') }}" alt="Skill Bridge India Technologies Logo" class="logo-img">
    </a>

    <div class="nav-menu" id="navMenu">
      <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
      <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
      <div class="nav-dropdown">
        <a href="{{ route('courses') }}" class="nav-link {{ request()->routeIs('courses') ? 'active' : '' }}">Courses <i class="fas fa-chevron-down text-xs" style="margin-left: 0.2rem;"></i></a>
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
          <div class="dropdown-divider-custom"></div>
          <a href="{{ route('courses') }}" class="dropdown-item-custom text-accent-coral"><i class="fas fa-th-large"></i> Explore All Courses</a>
        </div>
      </div>

      <a href="{{ route('corporate-training') }}" class="nav-link {{ request()->routeIs('corporate-training') ? 'active' : '' }}">Trainings</a>
      <a href="{{ route('placements') }}" class="nav-link {{ request()->routeIs('placements') ? 'active' : '' }}">Placements</a>
      <a href="{{ route('gallery') }}" class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
      <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
    </div>

    <div class="nav-actions">
      <button type="button" class="btn btn-primary" onclick="openEnquiryModal('Free Demo Class')">
        <i class="fas fa-briefcase"></i> <span class="btn-label">Enquire Now</span>
      </button>
      <div class="mobile-toggle" id="mobileToggle">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </div>
</nav>
