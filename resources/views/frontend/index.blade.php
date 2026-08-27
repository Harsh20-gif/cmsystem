@extends('layouts.app')

@section('title', 'Skill Bridge India Technologies | BTech Training & Placement')

@section('content')

  @if($marqueeNotices->count() > 0)
  <div class="marquee-wrapper" style="background: var(--navy); color: white; padding: 5px 0; font-size: 0.9rem; overflow: hidden; display: flex; align-items: center;">
    <div style="background: var(--accent-orange); color: white; padding: 5px 15px; font-weight: bold; white-space: nowrap; z-index: 2;">Updates:</div>
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
        <!-- Dynamic Sliders (Simplified as a stacked list or basic vanilla JS carousel. For now, showing first as Hero, others as smaller banners or just showing the first one as requested, but let's make it a simple CSS fade or just show the first active one) -->
        @php $firstSlider = $sliders->first(); @endphp
        <div class="container hero-grid">
          <div class="hero-content">
            <div class="badge-tag">
              <i class="fas fa-sparkles"></i> Future-Ready Engineering Skilling
            </div>
            <h1 style="font-size: 2.5rem; line-height: 1.2; margin-bottom: 1rem;">
                {!! nl2br(e($firstSlider->title)) !!}
            </h1>
            <p class="hero-description">
                {{ $firstSlider->subtitle }}
            </p>
    
            <div class="hero-features">
              <div class="hero-feature-item">
                <i class="fas fa-check-circle"></i> 100% Placement Assistance
              </div>
              <div class="hero-feature-item">
                <i class="fas fa-check-circle"></i> Live Industrial Projects
              </div>
            </div>
    
            <div class="hero-cta">
              @if($firstSlider->link)
              <a href="{{ $firstSlider->link }}" class="btn btn-primary">
                Explore Now
              </a>
              @endif
              <button class="btn btn-outline" onclick="openEnrollModal('Career Counseling')">
                <i class="fas fa-comments"></i> Start Free Counseling
              </button>
            </div>
          </div>
    
          <div class="hero-visual">
            <div class="hero-image-card">
              <img src="{{ Storage::url($firstSlider->image) }}" alt="Skill Bridge Hero">
            </div>
    
            <div class="floating-badge badge-placement">
              <div class="badge-icon bg-green">
                <i class="fas fa-briefcase"></i>
              </div>
              <div class="badge-text">
                <strong>12,500+ Placed</strong>
                <span>Top MNCs & Core Industries</span>
              </div>
            </div>
          </div>
        </div>
    @else
        <!-- Fallback Static Hero -->
        <div class="container hero-grid">
          <div class="hero-content">
            <div class="badge-tag">
              <i class="fas fa-sparkles"></i> Future-Ready Engineering Skilling
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
                <i class="fas fa-graduation-cap"></i> View All Programs
              </a>
              <button class="btn btn-outline" onclick="openEnrollModal('Career Counseling')">
                <i class="fas fa-comments"></i> Start Free Counseling
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
       Virtual Internship Registration Banner Strip (Scortek Inspired)
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
              <h2>Important <span class="text-orange">Notices</span></h2>
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
       Stats Counter Bar
       ========================================================================== -->
  <!-- <section class="stats-bar" id="statsBar">
    <div class="container">
      <div class="stats-card">
        <div class="stat-item">
          <div class="stat-icon navy">
            <i class="fas fa-user-graduate"></i>
          </div>
          <div>
            <div class="stat-number" data-target="{{ $siteSettings['home_stat1_number'] ?? '12500' }}" data-suffix="{{ $siteSettings['home_stat1_suffix'] ?? '+' }}">0</div>
            <div class="stat-label">{{ $siteSettings['home_stat1_label'] ?? 'Students Trained' }}</div>
          </div>
        </div>

        <div class="stat-item">
          <div class="stat-icon orange">
            <i class="fas fa-chart-line"></i>
          </div>
          <div>
            <div class="stat-number" data-target="{{ $siteSettings['home_stat2_number'] ?? '96.8' }}" data-suffix="{{ $siteSettings['home_stat2_suffix'] ?? '%' }}">0</div>
            <div class="stat-label">{{ $siteSettings['home_stat2_label'] ?? 'Placement Record' }}</div>
          </div>
        </div>

        <div class="stat-item">
          <div class="stat-icon green">
            <i class="fas fa-building"></i>
          </div>
          <div>
            <div class="stat-number" data-target="{{ $siteSettings['home_stat3_number'] ?? '350' }}" data-suffix="{{ $siteSettings['home_stat3_suffix'] ?? '+' }}">0</div>
            <div class="stat-label">{{ $siteSettings['home_stat3_label'] ?? 'Corporate Partners' }}</div>
          </div>
        </div>

        <div class="stat-item">
          <div class="stat-icon navy">
            <i class="fas fa-rupee-sign"></i>
          </div>
          <div>
            <div class="stat-number" data-target="{{ $siteSettings['home_stat4_number'] ?? '8.5' }}" data-suffix="{{ $siteSettings['home_stat4_suffix'] ?? ' LPA' }}">0</div>
            <div class="stat-label">{{ $siteSettings['home_stat4_label'] ?? 'Average Package' }}</div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <!-- ==========================================================================
       Institute Departments & Learning Hub Gateways
       ========================================================================== -->
  <section class="section-padding bg-navy-alt">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-th-large"></i> Explore Learning Tracks</div>
        <h2 class="section-title text-white">Specialized <span class="highlight">Training Centers</span></h2>
        <p class="section-subtitle" style="color: white;">Discover our branch-specific training departments, industrial internship programs,
          and placement records.</p>
      </div>

      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.8rem;">

        <!-- Gateway Card 1: CS & IT -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <div class="feature-icon-wrapper orange">
              <i class="fas fa-laptop-code"></i>
            </div>
            <h3 class="heading-sm" style="margin-bottom: 0.6rem;">CS & IT Programs</h3>
            <p class="text-sm text-slate-body" style="line-height: 1.5; margin-bottom: 1.2rem;">
              Fullstack Web Development, Data Science & AI, Cloud Computing DevOps, and Cyber Security with live
              projects.
            </p>
          </div>
          <a href="{{ route('cs-it-courses') }}" class="btn btn-outline text-sm"
            style="align-self: flex-start; padding: 0.55rem 1.2rem;">
            Explore CS/IT Track <i class="fas fa-arrow-right" style="margin-left: 0.4rem;"></i>
          </a>
        </div>

        <!-- Gateway Card 2: Core Engineering -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <div class="feature-icon-wrapper navy">
              <i class="fas fa-cogs"></i>
            </div>
            <h3 class="heading-sm" style="margin-bottom: 0.6rem;">Core Engineering Tracks</h3>
            <p class="text-sm text-slate-body" style="line-height: 1.5; margin-bottom: 1.2rem;">
              PLC SCADA Automation, MEP & HVAC Design, Embedded Systems & IoT, and Civil AutoCad / Revit software.
            </p>
          </div>
          <a href="{{ route('core-engineering') }}" class="btn btn-outline text-sm"
            style="align-self: flex-start; padding: 0.55rem 1.2rem;">
            Explore Core Tracks <i class="fas fa-arrow-right" style="margin-left: 0.4rem;"></i>
          </a>
        </div>

        <!-- Gateway Card 3: Summer/Winter Training -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <div class="feature-icon-wrapper green">
              <i class="fas fa-university"></i>
            </div>
            <h3 class="heading-sm" style="margin-bottom: 0.6rem;">Summer / Winter Trainings</h3>
            <p class="text-sm text-slate-body" style="line-height: 1.5; margin-bottom: 1.2rem;">
              4 to 8-Week BTech industrial internship programs with ISO project completion certificates & college MOU
              support.
            </p>
          </div>
          <a href="{{ route('corporate-training') }}" class="btn btn-outline text-sm"
            style="align-self: flex-start; padding: 0.55rem 1.2rem;">
            Explore Internships <i class="fas fa-arrow-right" style="margin-left: 0.4rem;"></i>
          </a>
        </div>

        <!-- Gateway Card 4: Placement Wall -->
        <div class="feature-card" style="display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <div class="feature-icon-wrapper orange">
              <i class="fas fa-trophy"></i>
            </div>
            <h3 class="heading-sm" style="margin-bottom: 0.6rem;">Placement Wall & Alumni</h3>
            <p class="text-sm text-slate-body" style="line-height: 1.5; margin-bottom: 1.2rem;">
              View placed BTech candidates, corporate hiring records, package distribution, and interview success
              stories.
            </p>
          </div>
          <a href="{{ route('placements') }}" class="btn btn-outline text-sm"
            style="align-self: flex-start; padding: 0.55rem 1.2rem;">
            View Placement Wall <i class="fas fa-arrow-right" style="margin-left: 0.4rem;"></i>
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- ==========================================================================
       Engineering Branch Course Highlight Section
       ========================================================================== -->
  <section class="courses-section section-padding" id="courses">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-star"></i> Top Featured Courses</div>
        <h2 class="section-title"><span class="highlight">Job-Oriented Programs</span></h2>
        <p class="section-subtitle">Top rated BTech skilling tracks with live hands-on practical labs and 100% placement
          support.</p>
      </div>

      <div class="course-filter-bar">
        <button class="filter-btn active" data-filter="all">All Programs</button>
        @foreach($courseCategories as $category)
            <button class="filter-btn" data-filter="{{ $category->slug }}">{{ $category->name }}</button>
        @endforeach
      </div>

      <div class="courses-grid" id="coursesContainer">
        <!-- Dynamically rendered via script.js -->
      </div>

      <div style="text-align: center; margin-top: 3.5rem;">
        <a href="{{ route('courses') }}" class="btn btn-primary" style="padding: 1rem 2.2rem;">
          <i class="fas fa-th"></i> View Full Course Catalog ({{ \App\Models\Course::where('status', 'published')->count() }}+ Programs)
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
              <button class="btn btn-outline text-white" style="border-" onclick="resetQuiz()">
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
        <div class="badge-tag"><i class="fas fa-star"></i> Best-In-Class Training Ecosystem</div>
        <h2 class="section-title">Why Choose <span class="highlight">Skill Bridge India</span></h2>
        <p class="section-subtitle">Practical learning, expert faculty, live industrial labs, and placement support in
          one single platform.</p>
      </div>

      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon-wrapper orange">
            <i class="fas fa-handshake"></i>
          </div>
          <h3>100% Placement Focus</h3>
          <p>Dedicated placement cell conducting mock technical interviews, resume crafting, LinkedIn optimization, and
            hiring drives with 350+ corporate partners.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon-wrapper navy">
            <i class="fas fa-laptop-code"></i>
          </div>
          <h3>Project-Based Learning</h3>
          <p>Build enterprise-grade applications, handle industrial PLC SCADA setups, deploy cloud apps, and complete
            live client projects.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon-wrapper green">
            <i class="fas fa-user-tie"></i>
          </div>
          <h3>Industry Expert Mentors</h3>
          <p>Learn directly from Senior Architects, Tech Leads, and Engineering Managers with 10+ years experience in
            MNCs and tech startups.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon-wrapper green">
            <i class="fas fa-award"></i>
          </div>
          <h3>ISO & Quality Certified</h3>
          <p>Receive globally valid ISO 9001:2015 certifications recognized across MNCs, government skilling
            initiatives, and higher education.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon-wrapper orange">
            <i class="fas fa-headset"></i>
          </div>
          <h3>1-on-1 Doubt Support</h3>
          <p>Daily dedicated mentor support hours so you never get stuck on any code error, hardware bug, or conceptual
            doubt.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon-wrapper navy">
            <i class="fas fa-city"></i>
          </div>
          <h3>Multi-Center Infrastructure</h3>
          <p>State-of-the-art computer labs and core engineering hardware stations in Noida, Lucknow, and Bhopal.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ==========================================================================
       Corporate Partners & Placement Wall Highlight
       ========================================================================== -->
  <section class="placement-section section-padding" id="placements">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-building"></i> Our Alumni Work Here</div>
        <h2 class="section-title">350+ Top Corporate <span class="highlight">Hiring Partners</span></h2>
        <p class="section-subtitle">Our students work at leading Fortune 500 tech companies, MNCs, and fast-growing
          unicorns.</p>
      </div>

      <div class="partners-ticker">
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

      <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('placements') }}" class="btn btn-secondary">
          <i class="fas fa-trophy"></i> Explore Placement Wall & Alumni Stories
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
            class="fas fa-camera"></i> Campus & Labs Life</span>
        <h2 class="heading-lg font-extrabold" style="margin: 0;">Want to See Our Labs & Campus Drive Photos?</h2>
        <p class="text-base" style="max-width: 650px; opacity: 0.95; margin: 0 0 0.5rem 0;">Browse live photos of CS/IT
          practical labs, industrial automation hardware setups, and university campus seminars.</p>
        <a href="{{ route('gallery') }}" class="btn btn-secondary font-bold text-navy-dark bg-white">
          <i class="fas fa-images"></i> Open Photo Gallery Page
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
