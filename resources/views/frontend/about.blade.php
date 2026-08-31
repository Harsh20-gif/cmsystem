@extends('layouts.app')

@section('title', isset($page) ? $page->title . ' | Skill Bridge India Technologies' : 'About Us | Skill Bridge India Technologies')

@section('content')

<x-page-hero 
    title="{{ $siteSettings['about_hero_title'] ?? (isset($page) ? $page->title : 'About Skill Bridge India') }}"
    subtitle="{{ $siteSettings['about_hero_subtitle'] ?? 'Transforming engineering education into real industry capabilities through practical labs, live projects, and 100% placement support.' }}"
    breadcrumbItem="About Us"
/>

  @if(isset($page) && $page->content)
  <section class="section-padding">
    <div class="container">
      {!! $page->content !!}
    </div>
  </section>
  @else
  <!-- Company Overview -->
  <!-- <section class="section-padding">
    <div class="container">
      <div class="hero-grid" style="align-items: center; gap: 3.5rem;">
        <div>
          <span class="badge-tag"><i class="fas fa-shield-alt"></i> {{ $siteSettings['about_intro_badge'] ?? 'ISO 9001:2015 Certified Institute' }}</span>
          <h2 class="section-title" style="text-align: left;">{{ $siteSettings['about_intro_heading_1'] ?? 'Bridging Academic Knowledge &' }} <span
              class="highlight">{{ $siteSettings['about_intro_heading_2'] ?? 'Corporate Execution' }}</span></h2>
          <p class="text-lg text-slate-body" style="margin-bottom: 1.2rem;">
            {{ $siteSettings['about_intro_p1'] ?? 'Established with a vision to eliminate the skill gap among engineering graduates, Skill Bridge India Technologies Pvt Ltd delivers industry-aligned training across CS/IT, Electrical, Mechanical, Electronics, and Civil streams.' }}
          </p>
          <p class="text-base text-slate-muted" style="margin-bottom: 2rem;">
            {{ $siteSettings['about_intro_p2'] ?? 'With state-of-the-art training centers in Noida, Lucknow, and Bhopal, we equip students with real-world project exposure, hands-on PLC SCADA & MEP hardware labs, cloud computing pipelines, and AI frameworks.' }}
          </p>

          <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.2rem;">
            @if(isset($aboutFeatures) && $aboutFeatures->count() > 0)
                @foreach($aboutFeatures as $feature)
                <div style="display: flex; gap: 0.8rem; align-items: center;">
                  <i class="{{ $feature->icon_class }} text-accent-cyan-dark heading-md"></i>
                  <strong class="text-navy-dark">{{ $feature->title }}</strong>
                </div>
                @endforeach
            @else
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
            @endif
          </div>
        </div>

        <div class="hero-image-card">
          <img src="{{ !empty($siteSettings['about_intro_image']) ? \Illuminate\Support\Facades\Storage::url($siteSettings['about_intro_image']) : asset('frontend/assets/hero.jpg') }}" alt="Skill Bridge India Facility">
        </div>
      </div>
    </div>
  </section>
  @endif -->


  <!-- Lab Infrastructure Section -->
  <!-- <section class="section-padding" id="infra">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-microchip"></i> {{ $siteSettings['about_lab_badge'] ?? 'Hands-On Facilities' }}</div>
        <h2 class="section-title">{{ $siteSettings['about_lab_heading_1'] ?? 'State-of-the-Art' }} <span class="highlight">{{ $siteSettings['about_lab_heading_2'] ?? 'Lab Infrastructure' }}</span></h2>
        <p class="section-subtitle">{{ $siteSettings['about_lab_subtitle'] ?? 'Modern practical workstations equipped for software development, cloud computing, and core engineering setups.' }}</p>
      </div>

      <div class="features-grid">
        @if(isset($aboutFacilityCards) && $aboutFacilityCards->count() > 0)
            @foreach($aboutFacilityCards as $card)
            <div class="feature-card">
              <div class="feature-icon-wrapper {{ $card->color_class }}"><i class="{{ $card->icon_class }}"></i></div>
              <h3>{{ $card->title }}</h3>
              <p>{{ $card->description }}</p>
            </div>
            @endforeach
        @else
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
        @endif
      </div>
    </div>
  </section> -->
  <!-- ==========================================================================
       Mission and Vision Section
       ========================================================================== -->
  <section class="section-padding bg-navy-alt text-white" id="mission-vision">
    <div class="container">
      <div class="row g-5">
        <!-- Mission -->
        <div class="col-md-6">
          <div class="p-4 p-lg-5 h-100 rounded" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
            <div class="d-flex align-items-center mb-4">
              <div style="width: 60px; height: 60px; background: var(--accent-orange); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin-right: 1.5rem;">
                <i class="fas fa-rocket"></i>
              </div>
              <h2 class="mb-0" style="font-size: 2rem; font-weight: 700;">{{ $siteSettings['home_mission_title'] ?? 'Our Mission' }}</h2>
            </div>
            <p style="font-size: 1.1rem; line-height: 1.8; color: rgba(255,255,255,0.85); margin-bottom: 0;">
              {{ $siteSettings['home_mission_text'] ?? '' }}
            </p>
          </div>
        </div>
        
        <!-- Vision -->
        <div class="col-md-6">
          <div class="p-4 p-lg-5 h-100 rounded" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
            <div class="d-flex align-items-center mb-4">
              <div style="width: 60px; height: 60px; background: var(--accent-cyan); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin-right: 1.5rem;">
                <i class="fas fa-eye"></i>
              </div>
              <h2 class="mb-0" style="font-size: 2rem; font-weight: 700;">{{ $siteSettings['home_vision_title'] ?? 'Our Vision' }}</h2>
            </div>
            <p style="font-size: 1.1rem; line-height: 1.8; color: rgba(255,255,255,0.85); margin-bottom: 0;">
              {{ $siteSettings['home_vision_text'] ?? '' }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  @if(isset($teamMembers) && $teamMembers->count() > 0)
  <section class="section-padding bg-light" id="team">
    <div class="container">
      <div class="section-header text-center">
        <div class="badge-tag"><i class="fas fa-users"></i> {{ $siteSettings['about_team_badge'] ?? 'Mentorship & Leadership' }}</div>
        <h2 class="section-title">{{ $siteSettings['about_team_heading_1'] ?? 'Meet Our' }} <span class="highlight">{{ $siteSettings['about_team_heading_2'] ?? 'Expert Team' }}</span></h2>
        <p class="section-subtitle">{{ $siteSettings['about_team_subtitle'] ?? 'Learn from industry veterans, senior engineers, and experienced mentors.' }}</p>
      </div>

      <div class="features-grid">
        @foreach($teamMembers as $member)
        <div class="feature-card" style="text-align: center; padding: 2rem 1.5rem;">
          <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin: 0 auto 1.5rem auto; border: 3px solid var(--accent-cyan); box-shadow: var(--shadow-sm);">
            @if($member->photo)
              <img src="{{ \Illuminate\Support\Facades\Storage::url($member->photo) }}" alt="{{ $member->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
              <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--bg-surface); color: var(--navy-dark); font-size: 2rem; font-weight: bold;">
                {{ substr($member->name, 0, 1) }}
              </div>
            @endif
          </div>
          <h3 style="margin-bottom: 0.3rem;">{{ $member->name }}</h3>
          <p class="text-accent-coral font-semibold text-sm" style="margin-bottom: 1rem;">{{ $member->designation }}</p>
          
          @if($member->bio)
          <p class="text-sm text-slate-muted" style="margin-bottom: 1.5rem; line-height: 1.5;">{{ \Illuminate\Support\Str::limit($member->bio, 100) }}</p>
          @endif
          
          <div style="display: flex; justify-content: center; gap: 1rem;">
            @if($member->linkedin_url)
            <a href="{{ $member->linkedin_url }}" target="_blank" style="color: #0A66C2; font-size: 1.2rem; transition: all 0.3s ease;"><i class="fab fa-linkedin"></i></a>
            @endif
            @if($member->twitter_url)
            <a href="{{ $member->twitter_url }}" target="_blank" style="color: #1DA1F2; font-size: 1.2rem; transition: all 0.3s ease;"><i class="fab fa-twitter"></i></a>
            @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @endsection

