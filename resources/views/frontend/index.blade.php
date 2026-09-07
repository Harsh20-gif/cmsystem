@extends('layouts.app')

@section('title', $siteSettings['home_page_title'] ?? 'Skill Bridge India Technologies | BTech Training & Placement')

@section('content')

  @if($marqueeNotices->count() > 0)
  <div class="marquee-wrapper" style="background: var(--navy); color: white; padding: 5px 0; font-size: 0.9rem; overflow: hidden; display: flex; align-items: center;">
    <div style="background: var(--accent-orange); color: white; padding: 5px 15px; font-weight: bold; white-space: nowrap; z-index: 2;">{{ $siteSettings['home_marquee_label'] ?? 'Updates:' }}</div>
    <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="flex-grow: 1;">
        @foreach($marqueeNotices as $notice)
            <span style="margin-right: 40px;">
                @if($notice->link)
                    <a href="{{ $notice->link }}" style="color: white; text-decoration: none;">&bull; {{ $notice->title }}</a>
                @else
                    &bull; {{ $notice->title }}
                @endif
            </span>
        @endforeach
    </marquee>
  </div>
  @endif

  <!-- ==========================================================================
       Hero Section
       ========================================================================== -->
  <section class="hero" id="home" style="position: relative;">
    <div class="hero-bg-grid"></div>

    @if($sliders->count() > 0)
        @php $firstSlider = $sliders->first(); @endphp
        <div class="container hero-grid">
          <div class="hero-content">
            <div class="badge-tag">
              <i class="fas fa-sparkles"></i> {{ $siteSettings['home_hero_badge'] ?? 'Future-Ready Engineering Skilling' }}
            </div>
            <h1 style="font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                {!! nl2br(e($firstSlider->title)) !!}
            </h1>
            <p class="hero-description">
                {{ $firstSlider->subtitle }}
            </p>
    
            <div class="hero-features">
              <div class="hero-feature-item">
                <i class="fas fa-check-circle"></i> {{ $siteSettings['home_hero_feature1'] ?? '100% Placement Assistance' }}
              </div>
              <div class="hero-feature-item">
                <i class="fas fa-check-circle"></i> {{ $siteSettings['home_hero_feature2'] ?? 'Live Industrial Projects' }}
              </div>
            </div>
    
            <div class="hero-cta">
              @if($firstSlider->link)
              <a href="{{ $firstSlider->link }}" class="btn btn-primary">
                {{ $siteSettings['home_hero_cta_explore_label'] ?? 'Explore Now' }}
              </a>
              @endif
              <button class="btn btn-outline" onclick="openEnrollModal('Career Counseling')">
                <i class="fas fa-comments"></i> {{ $siteSettings['home_hero_cta_counseling_label'] ?? 'Start Free Counseling' }}
              </button>
            </div>
          </div>
    
          <div class="hero-visual">
            <div class="hero-image-card">
              <img src="{{ Storage::url($firstSlider->image) }}" alt="{{ $firstSlider->title ?? 'Skill Bridge Hero' }}">
            </div>
    
            <div class="floating-badge badge-placement">
              <div class="badge-icon bg-green">
                <i class="fas fa-briefcase"></i>
              </div>
              <div class="badge-text">
                <strong>{{ $siteSettings['home_hero_badge1_value'] ?? '12,500+ Placed' }}</strong>
                <span>{{ $siteSettings['home_hero_badge1_label'] ?? 'Top MNCs & Core Industries' }}</span>
              </div>
            </div>
          </div>
        </div>
    @else
        <!-- Fallback Static Hero -->
        <div class="container hero-grid">
          <div class="hero-content">
            <div class="badge-tag">
              <i class="fas fa-sparkles"></i> {{ $siteSettings['home_hero_badge'] ?? 'Future-Ready Engineering Skilling' }}
            </div>
            <h1>
              {{ $siteSettings['home_hero_title1'] ?? 'Build Technical Skills' }} <br><span class="text-orange">{{ $siteSettings['home_hero_title2_orange'] ?? 'Get Certified.' }}</span> <span class="text-emerald">{{ $siteSettings['home_hero_title3_blue'] ?? 'Get Placed.' }}</span>
            </h1>
            <p class="hero-description">
              {{ $siteSettings['home_hero_desc'] ?? 'Skill Bridge India delivers practical Summer & Winter Industrial Training with live projects, expert mentorship, and guaranteed placement drives.' }}
            </p>
    
            <div class="hero-features">
              <div class="hero-feature-item">
                <i class="fas fa-check-circle"></i> {{ $siteSettings['home_hero_feature1'] ?? '100% Placement Assistance' }}
              </div>
              <div class="hero-feature-item">
                <i class="fas fa-check-circle"></i> {{ $siteSettings['home_hero_feature2'] ?? 'Live Industrial Projects' }}
              </div>
              <div class="hero-feature-item">
                <i class="fas fa-check-circle"></i> {{ $siteSettings['home_hero_feature3'] ?? 'Centers: Lucknow • Noida • Bhopal' }}
              </div>
            </div>
    
            <div class="hero-cta">
              <a href="{{ route('courses') }}" class="btn btn-primary">
                <i class="fas fa-graduation-cap"></i> {{ $siteSettings['home_hero_cta_explore_label'] ?? 'View All Programs' }}
              </a>
              <button class="btn btn-outline" onclick="openEnrollModal('Career Counseling')">
                <i class="fas fa-comments"></i> {{ $siteSettings['home_hero_cta_counseling_label'] ?? 'Start Free Counseling' }}
              </button>
            </div>
          </div>
    
          <div class="hero-visual">
            <div class="hero-image-card">
              <img src="{{ isset($siteSettings['home_hero_image']) ? Storage::url($siteSettings['home_hero_image']) : asset('frontend/assets/hero.jpg') }}" alt="Hero Image">
            </div>
    
            <div class="floating-badge badge-placement">
              <div class="badge-icon bg-green">
                <i class="fas fa-briefcase"></i>
              </div>
              <div class="badge-text">
                <strong>{{ $siteSettings['home_hero_badge1_value'] ?? '12,500+ Placed' }}</strong>
                <span>{{ $siteSettings['home_hero_badge1_label'] ?? 'Top MNCs & Core Industries' }}</span>
              </div>
            </div>
    
            <div class="floating-badge badge-rating">
              <div class="badge-icon bg-orange">
                <i class="fas fa-star"></i>
              </div>
              <div class="badge-text">
                <strong>{{ $siteSettings['home_hero_badge2_value'] ?? '4.9 / 5 Rating' }}</strong>
                <span>{{ $siteSettings['home_hero_badge2_label'] ?? 'Verified Student Reviews' }}</span>
              </div>
            </div>
          </div>
        </div>
    @endif
  </section>

  <!-- ==========================================================================
       About Section
       ========================================================================== -->
  <section class="section-padding bg-light" id="about-us">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <div class="badge-tag"><i class="fas fa-info-circle"></i> {{ $siteSettings['home_about_badge'] ?? 'Discover Who We Are' }}</div>
          <h2 class="section-title"><span class="highlight">{{ $siteSettings['home_about_title'] ?? 'About Skill Bridge India Technologies' }}</span></h2>
          <p class="text-slate-body mb-4" style="font-size: 1.1rem; line-height: 1.7;">
            {{ $siteSettings['home_about_text'] ?? '' }}
          </p>
          
          <ul class="list-unstyled mb-4">
            @foreach($aboutHighlights as $highlight)
            <li class="mb-3 d-flex align-items-center" style="font-size: 1.05rem; font-weight: 500;">
              <i class="{{ $highlight->icon_class ?? 'fas fa-check-circle' }} text-success me-3" style="font-size: 1.3rem;"></i>
              {{ $highlight->title }}
            </li>
            @endforeach
          </ul>

          <a href="{{ $siteSettings['home_about_btn_link'] ?? '/about' }}" class="btn btn-primary">
            {{ $siteSettings['home_about_btn_text'] ?? 'Read More' }} <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
        <div class="col-lg-6">
          <div class="position-relative">
            <img src="{{ isset($siteSettings['home_about_image']) && !empty($siteSettings['home_about_image']) ? \Illuminate\Support\Facades\Storage::url($siteSettings['home_about_image']) : asset('frontend/assets/hero.jpg') }}" alt="About Skill Bridge" class="img-fluid rounded shadow-lg" style="width: 100%; border: 8px solid white;">
            <!-- Decorative elements -->
            <div style="position: absolute; bottom: -20px; right: -20px; background: var(--accent-orange); width: 100px; height: 100px; border-radius: 50%; z-index: -1;"></div>
            <div style="position: absolute; top: -20px; left: -20px; background: var(--navy); width: 80px; height: 80px; border-radius: 10px; z-index: -1; transform: rotate(15deg);"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       Training & Placement Features Section
       ========================================================================== -->
  <section class="section-padding" id="training-features">
    <div class="container">
      <div class="section-header text-center mx-auto" style="max-width: 700px;">
        <div class="badge-tag d-inline-block"><i class="fas fa-laptop-code"></i> {{ $siteSettings['home_training_badge'] ?? 'Accelerate Your Career' }}</div>
        <h2 class="section-title"><span class="highlight">{{ $siteSettings['home_training_title'] ?? 'Hands-on Training with 100% Placement Assistance' }}</span></h2>
        <p class="section-subtitle">
          {{ $siteSettings['home_training_text'] ?? '' }}
        </p>
      </div>

      <div class="row g-4 mt-2">
        @foreach($trainingFeatures as $index => $feature)
        <div class="col-lg-3 col-md-6">
          <div class="feature-card h-100 text-center" style="padding: 2rem 1.5rem; transition: transform 0.3s; border-top: 4px solid {{ ['var(--navy)', 'var(--accent-orange)', 'var(--accent-green)', 'var(--accent-cyan)'][$index % 4] }};">
            <div class="feature-icon-wrapper mx-auto mb-4" style="width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 1.8rem; background: rgba(0,0,0,0.05); color: {{ ['var(--navy)', 'var(--accent-orange)', 'var(--accent-green)', 'var(--accent-cyan)'][$index % 4] }};">
              <i class="{{ $feature->icon_class ?? 'fas fa-star' }}"></i>
            </div>
            <h3 class="heading-sm mb-3">{{ $feature->title }}</h3>
            <p class="text-sm text-slate-body mb-0" style="line-height: 1.6;">
              {{ $feature->description }}
            </p>
          </div>
        </div>
        @endforeach
      </div>

      <div class="text-center mt-5">
        <a href="{{ $siteSettings['home_training_btn_link'] ?? '/courses' }}" class="btn btn-secondary">
          {{ $siteSettings['home_training_btn_text'] ?? 'Explore Courses' }} <i class="fas fa-graduation-cap ms-2"></i>
        </a>
      </div>
    </div>
  </section>

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

  <!-- ==========================================================================
       Virtual Internship Registration Banner Strip
       ========================================================================== -->
    <section class="registration-strip">
    <div class="container strip-inner">
      @if($homePage && !empty(trim(strip_tags($homePage->content))))
          {!! $homePage->content !!}
      @else
          <!-- Fallback -->
          <div>
            <h2><i class="fas fa-bullhorn text-accent-cyan" style="margin-right: 0.6rem;"></i> Registrations Open
              For Virtual & Industrial Internship Batch <span>2026</span></h2>
            <p class="text-sm" style="margin: 0; opacity: 0.9;">Hands-on practical labs, mentorship, and guaranteed
              interview opportunities across CS, EC, EE, ME & Civil.</p>
          </div>
          <a href="javascript:void(0)" onclick="openEnrollModal('Virtual Internship 2026')" class="strip-btn">
            Register Now <i class="fas fa-arrow-right" style="margin-left: 0.4rem;"></i>
          </a>
      @endif
    </div>
  </section>
  
  @if($boardNotices->count() > 0)
  <section class="section-padding bg-light" style="padding: 3rem 0;">
      <div class="container">
          <div class="section-header text-center">
              <h2>{{ $siteSettings['home_notices_title'] ?? 'Important' }} <span class="text-orange">{{ $siteSettings['home_notices_title_highlight'] ?? 'Notices' }}</span></h2>
          </div>
          <div style="background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); padding: 2rem; border-top: 4px solid var(--accent-orange); max-width: 800px; margin: 0 auto;">
              <ul style="list-style: none; padding: 0; margin: 0;">
                  @foreach($boardNotices as $notice)
                      <li style="padding: 1rem 0; border-bottom: 1px solid #eee; display: flex; gap: 1rem; align-items: flex-start;">
                          <i class="fas fa-chevron-right text-orange" style="margin-top: 0.3rem;"></i>
                          <div>
                              @if($notice->link)
                                  <a href="{{ $notice->link }}" style="text-decoration: none; color: var(--navy); font-weight: 600; font-size: 1.1rem; display: block; margin-bottom: 0.2rem;">{{ $notice->title }}</a>
                              @else
                                  <div style="color: var(--navy); font-weight: 600; font-size: 1.1rem; margin-bottom: 0.2rem;">{{ $notice->title }}</div>
                              @endif
                              <span style="font-size: 0.85rem; color: #666;"><i class="far fa-clock"></i> {{ $notice->created_at->format('M d, Y') }}</span>
                          </div>
                          @if($loop->first)
                          <span class="badge bg-danger" style="margin-left: auto;">New</span>
                          @endif
                      </li>
                  @endforeach
              </ul>
          </div>
      </div>
  </section>
  @endif

  <!-- ==========================================================================
       Institute Departments & Learning Hub Gateways
       ========================================================================== -->
  <section class="section-padding bg-navy-alt">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-th-large"></i> {{ $siteSettings['home_hub_badge'] ?? 'Explore Learning Tracks' }}</div>
        <h2 class="section-title text-white"><span class="highlight">{{ $siteSettings['home_hub_title'] ?? 'Specialized Training Centers' }}</span></h2>
        <p class="section-subtitle" style="color: white;">{{ $siteSettings['home_hub_subtitle'] ?? 'Discover our branch-specific training departments, industrial internship programs, and placement records.' }}</p>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.8rem;">
        @php
            $gatewayCards = isset($homeBlocks['gateway_cards']) ? $homeBlocks['gateway_cards'] : collect();
        @endphp

        @forelse($gatewayCards as $card)
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <div class="feature-icon-wrapper {{ $card->color_class ?? 'navy' }}">
              <i class="{{ $card->icon_class ?? 'fas fa-star' }}"></i>
            </div>
            <h3 class="heading-sm" style="margin-bottom: 0.6rem;">{{ $card->title }}</h3>
            <p class="text-sm text-slate-body" style="line-height: 1.5; margin-bottom: 1.2rem;">
              {{ $card->description }}
            </p>
          </div>
          @if($card->link)
          <a href="{{ $card->link }}" class="btn btn-outline text-sm"
            style="align-self: flex-start; padding: 0.55rem 1.2rem;">
            {{ $card->link_label ?? 'Explore' }} <i class="fas fa-arrow-right" style="margin-left: 0.4rem;"></i>
          </a>
          @endif
        </div>
        @empty
        <!-- Fallback if no content blocks seeded yet -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <div class="feature-icon-wrapper orange"><i class="fas fa-laptop-code"></i></div>
            <h3 class="heading-sm" style="margin-bottom: 0.6rem;">CS & IT Programs</h3>
            <p class="text-sm text-slate-body" style="line-height: 1.5; margin-bottom: 1.2rem;">Fullstack Web Development, Data Science & AI, Cloud Computing DevOps, and Cyber Security with live projects.</p>
          </div>
          <a href="{{ route('cs-it-courses') }}" class="btn btn-outline text-sm" style="align-self: flex-start; padding: 0.55rem 1.2rem;">Explore CS/IT Track <i class="fas fa-arrow-right" style="margin-left: 0.4rem;"></i></a>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       Engineering Branch Course Highlight Section
       ========================================================================== -->
  <section class="courses-section section-padding" id="courses">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-star"></i> {{ $siteSettings['home_courses_badge'] ?? 'Top Featured Courses' }}</div>
        <h2 class="section-title"><span class="highlight">{{ $siteSettings['home_courses_title'] ?? 'Job-Oriented Programs' }}</span></h2>
        <p class="section-subtitle">{{ $siteSettings['home_courses_subtitle'] ?? 'Top rated BTech skilling tracks with live hands-on practical labs and 100% placement support.' }}</p>
      </div>

      <div class="course-filter-bar">
        <button class="filter-btn active" data-filter="all">{{ $siteSettings['home_courses_filter_all'] ?? 'All Programs' }}</button>
        @foreach($courseCategories as $category)
            <button class="filter-btn" data-filter="{{ $category->slug }}">{{ $category->name }}</button>
        @endforeach
      </div>

      <div class="courses-grid" id="coursesContainer">
        <!-- Dynamically rendered via script.js -->
      </div>

      <div style="text-align: center; margin-top: 3.5rem;">
        <a href="{{ route('courses') }}" class="btn btn-primary" style="padding: 1rem 2.2rem;">
          <i class="fas fa-th"></i> {{ $siteSettings['home_courses_catalog_label'] ?? 'View Full Course Catalog' }} ({{ \App\Models\Course::where('status', 'published')->count() }}+ Programs)
        </a>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       Interactive Skill Quiz Widget Section
       ========================================================================== -->
  <section class="quiz-section section-padding" id="quiz">
    <div class="container">
      <div class="quiz-container">
        <div class="quiz-header">
          <div class="badge-tag text-accent-cyan bg-cyan-transparent"><i
              class="fas fa-compass"></i> Career Skill Advisor</div>
          <h3>Not Sure Which Engineering Track Suits You?</h3>
          <p>Take our 30-second skill assessment to find your perfect job-guaranteed learning path!</p>
        </div>

        <!-- Quiz Step 1 -->
        <div class="quiz-step active" id="quizStep1">
          <div class="quiz-question">1. What is your primary career goal or engineering branch?</div>
          <div class="quiz-options">
            <button class="quiz-opt-btn" onclick="selectQuizOption('goal', 'webdev')">
              <span><i class="fas fa-code text-accent-coral" style="margin-right: 0.8rem;"></i> CS/IT:
                Software, Web Development & AI</span>
              <i class="fas fa-arrow-right"></i>
            </button>
            <button class="quiz-opt-btn" onclick="selectQuizOption('goal', 'ai')">
              <span><i class="fas fa-brain text-accent-cyan" style="margin-right: 0.8rem;"></i> Data Science &
                Machine Learning</span>
              <i class="fas fa-arrow-right"></i>
            </button>
            <button class="quiz-opt-btn" onclick="selectQuizOption('goal', 'cloud')">
              <span><i class="fas fa-cloud text-blue-400" style="margin-right: 0.8rem;"></i> Cloud Computing & DevOps
                Infrastructure</span>
              <i class="fas fa-arrow-right"></i>
            </button>
            <button class="quiz-opt-btn" onclick="selectQuizOption('goal', 'hardware')">
              <span><i class="fas fa-cogs text-yellow-400" style="margin-right: 0.8rem;"></i> Electrical/Mech:
                Automation, PLC SCADA & MEP</span>
              <i class="fas fa-arrow-right"></i>
            </button>
          </div>
        </div>

        <!-- Quiz Step 2 -->
        <div class="quiz-step" id="quizStep2">
          <div class="quiz-question">2. What is your current educational background?</div>
          <div class="quiz-options">
            <button class="quiz-opt-btn" onclick="selectQuizOption('bg', 'cs')">
              <span><i class="fas fa-laptop-code"></i> B.Tech / BE / BCA / CS Student</span>
              <i class="fas fa-arrow-right"></i>
            </button>
            <button class="quiz-opt-btn" onclick="selectQuizOption('bg', 'noncs')">
              <span><i class="fas fa-graduation-cap"></i> Non-CS / Commerce / Science Graduate</span>
              <i class="fas fa-arrow-right"></i>
            </button>
            <button class="quiz-opt-btn" onclick="selectQuizOption('bg', 'working')">
              <span><i class="fas fa-user-tie"></i> Working Professional Switcher</span>
              <i class="fas fa-arrow-right"></i>
            </button>
            <button class="quiz-opt-btn" onclick="selectQuizOption('bg', 'diploma')">
              <span><i class="fas fa-certificate"></i> Diploma / Polytechnic Student</span>
              <i class="fas fa-arrow-right"></i>
            </button>
          </div>
        </div>

        <!-- Quiz Step 3 -->
        <div class="quiz-step" id="quizStep3">
          <div class="quiz-question">3. What training mode do you prefer?</div>
          <div class="quiz-options">
            <button class="quiz-opt-btn" onclick="selectQuizOption('mode', 'classroom')">
              <span><i class="fas fa-building"></i> In-Person Classroom Training (Lucknow/Noida/Bhopal)</span>
              <i class="fas fa-arrow-right"></i>
            </button>
            <button class="quiz-opt-btn" onclick="selectQuizOption('mode', 'online')">
              <span><i class="fas fa-video"></i> Live Interactive Online Batch</span>
              <i class="fas fa-arrow-right"></i>
            </button>
          </div>
        </div>

        <!-- Quiz Result -->
        <div class="quiz-step" id="quizResultStep">
          <div class="quiz-result-card">
            <i class="fas fa-trophy result-icon"></i>
            <h4 class="text-lg text-white-85">Your Recommended Program Match:</h4>
            <div class="recommended-title" id="quizResultTitle">Full Stack Web Development</div>
            <p class="text-base text-white-90" id="quizResultDesc"
              style="margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            </p>

            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
              <button class="btn btn-primary" id="quizResultAction">
                <i class="fas fa-check-circle"></i> Claim Seat with Scholarship
              </button>
              <button class="btn btn-outline text-white" onclick="resetQuiz()">
                <i class="fas fa-redo"></i> Retake Quiz
              </button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ==========================================================================
       Why Choose Us Section
       ========================================================================== -->
  <section class="section-padding" id="why-us">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-star"></i> {{ $siteSettings['home_whychoose_badge'] ?? 'Best-In-Class Training Ecosystem' }}</div>
        <h2 class="section-title">{{ $siteSettings['home_whychoose_title'] ?? 'Why Choose Skill Bridge India' }}</h2>
        <p class="section-subtitle">{{ $siteSettings['home_whychoose_subtitle'] ?? 'Practical learning, expert faculty, live industrial labs, and placement support in one single platform.' }}</p>
      </div>

      <div class="features-grid">
        @php
            $whyChooseBlocks = isset($homeBlocks['why_choose_us']) ? $homeBlocks['why_choose_us'] : collect();
        @endphp

        @forelse($whyChooseBlocks as $card)
        <div class="feature-card">
          <div class="feature-icon-wrapper {{ $card->color_class ?? 'navy' }}">
            <i class="{{ $card->icon_class ?? 'fas fa-star' }}"></i>
          </div>
          <h3>{{ $card->title }}</h3>
          <p>{{ $card->description }}</p>
        </div>
        @empty
        <!-- Fallback -->
        <div class="feature-card">
          <div class="feature-icon-wrapper orange"><i class="fas fa-handshake"></i></div>
          <h3>100% Placement Focus</h3>
          <p>Dedicated placement cell conducting mock technical interviews, resume crafting, LinkedIn optimization, and hiring drives with 350+ corporate partners.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon-wrapper navy"><i class="fas fa-laptop-code"></i></div>
          <h3>Project-Based Learning</h3>
          <p>Build enterprise-grade applications, handle industrial PLC SCADA setups, deploy cloud apps, and complete live client projects.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon-wrapper green"><i class="fas fa-user-tie"></i></div>
          <h3>Industry Expert Mentors</h3>
          <p>Learn directly from Senior Architects, Tech Leads, and Engineering Managers with 10+ years experience in MNCs and tech startups.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       Corporate Partners & Placement Wall Highlight
       ========================================================================== -->
  <section class="placement-section section-padding" id="placements">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-building"></i> {{ $siteSettings['home_partners_badge'] ?? 'Our Alumni Work Here' }}</div>
        <h2 class="section-title">{{ $siteSettings['home_partners_title'] ?? '350+ Top Corporate Hiring Partners' }}</h2>
        <p class="section-subtitle">{{ $siteSettings['home_partners_subtitle'] ?? 'Our students work at leading Fortune 500 tech companies, MNCs, and fast-growing unicorns.' }}</p>
      </div>

      <div class="partners-ticker">
        @forelse($companies as $company)
          @if($company->logo)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($company->logo) }}" alt="{{ $company->name }}" class="partner-logo" style="height: 40px; width: auto; object-fit: contain;">
          @else
            <span class="partner-logo">{{ $company->name }}</span>
          @endif
        @empty
            <p class="text-muted">Partner logos will appear here once added from the admin panel.</p>
        @endforelse
      </div>

      <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('placements') }}" class="btn btn-secondary">
          <i class="fas fa-trophy"></i> {{ $siteSettings['home_partners_btn_label'] ?? 'Explore Placement Wall & Alumni Stories' }}
        </a>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       Campus Photo Gallery Gateway Banner
       ========================================================================== -->
  <section class="text-white bg-primary-gradient" style="padding: 3.5rem 0; text-align: center;">
    <div class="container">
      <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1rem;">
        <span class="badge-tag text-white bg-white-transparent" style="border: none;"><i
            class="fas fa-camera"></i> {{ $siteSettings['home_gallery_cta_badge'] ?? 'Campus & Labs Life' }}</span>
        <h2 class="heading-lg font-extrabold" style="margin: 0;">{{ $siteSettings['home_gallery_cta_title'] ?? 'Want to See Our Labs & Campus Drive Photos?' }}</h2>
        <p class="text-base" style="max-width: 650px; opacity: 0.95; margin: 0 0 0.5rem 0;">{{ $siteSettings['home_gallery_cta_subtitle'] ?? 'Browse live photos of CS/IT practical labs, industrial automation hardware setups, and university campus seminars.' }}</p>
        <a href="{{ route('gallery') }}" class="btn btn-secondary font-bold text-navy-dark bg-white">
          <i class="fas fa-images"></i> {{ $siteSettings['home_gallery_cta_btn_label'] ?? 'Open Photo Gallery Page' }}
        </a>
      </div>
    </div>
  </section>

  @endsection

@push('scripts')
<script>
  window.coursesData = {!! json_encode($formattedCourses) !!};
</script>
@endpush
