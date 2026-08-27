@extends('layouts.app')

@section('title', 'Alumni Placement Wall | Skill Bridge India Technologies')

@section('content')

<x-page-hero 
    title="Placement Wall & Corporate Network"
    subtitle="Meet our successful alumni working in top MNCs and explore our extensive hiring network."
    breadcrumbItem="Placements"
/>

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

  <!-- Student Success Wall Marquee -->
  <section class="overflow-hidden pb-5">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag coral-tag"><i class="fas fa-trophy"></i> Alumni Achievements</div>
        <h2 class="section-title">Recent Student <span class="highlight">Placement Wall</span></h2>
        <p class="section-subtitle">Verified alumni placements with company details, designation, and salary packages.</p>
      </div>
    </div>

    <!-- 100% Full Width Marquee Container (Outside .container) -->
    <div id="placementMarqueeContainer" class="placement-marquee-container w-100">
      <div id="placementMarqueeTrack" class="placement-marquee-track">
        @forelse($placements as $placement)
        <div class="student-card marquee-card">
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
        <div class="col-12 text-center py-5 no-placements">
            <p>No placements available at the moment.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

@endsection

@push('styles')
<style>
  .placement-marquee-container {
    overflow: hidden;
    width: 100vw;
    position: relative;
    padding: 1rem 0 2rem 0;
    margin-left: calc(-50vw + 50%); /* Force absolute full width even if parent has restrictions */
    /* Soft fade on edges for a polished look */
    -webkit-mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
    mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
  }
  .placement-marquee-track {
    display: flex;
    width: max-content;
  }
  .marquee-group {
    display: flex;
    gap: 2rem;
    padding-right: 2rem; /* Replaces track gap, ensures perfect looping math */
  }
  .marquee-animating {
    animation: scrollMarquee linear infinite;
  }
  /* Pause animation completely on hover */
  .placement-marquee-container:hover .marquee-animating {
    animation-play-state: paused;
  }
  @keyframes scrollMarquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); } /* Exactly half the total track width */
  }
  .marquee-card {
    width: 340px;
    flex-shrink: 0;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
  }
  /* Small lift effect on hover (while paused) */
  .marquee-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('placementMarqueeTrack');
    if (!track) return;
    
    const cards = Array.from(track.children);
    if (cards.length === 0 || cards[0].classList.contains('no-placements')) return;

    // Card width (340px) + gap (2rem = 32px)
    const cardWidthWithGap = 340 + 32;
    const singleSetWidth = cards.length * cardWidthWithGap;
    
    // We want the primary group to be at least as wide as the screen 
    // to ensure the -50% loop shift happens completely off-screen.
    let copiesNeeded = Math.ceil(window.innerWidth / singleSetWidth);
    if (copiesNeeded < 1) copiesNeeded = 1;

    // Build Group 1 (Original items + enough duplicates to cover >100vw)
    const group1 = document.createElement('div');
    group1.className = 'marquee-group';
    
    for (let i = 0; i < copiesNeeded; i++) {
        cards.forEach(card => {
            const clone = card.cloneNode(true);
            group1.appendChild(clone);
        });
    }

    // Build Group 2 (Exact duplicate of Group 1 for flawless 50% shift trick)
    const group2 = group1.cloneNode(true);
    group2.setAttribute('aria-hidden', 'true'); // Hide from screen readers

    // Inject the groups back into the track
    track.innerHTML = '';
    track.appendChild(group1);
    track.appendChild(group2);
    
    // Dynamically calculate animation duration based on track width
    // Target speed: approx 40 pixels per second, min duration 30s.
    const totalGroupWidth = copiesNeeded * singleSetWidth;
    const duration = Math.max(30, totalGroupWidth / 40); 
    
    track.style.animationDuration = `${duration}s`;
    
    // Trigger animation
    track.classList.add('marquee-animating');
});
</script>
@endpush