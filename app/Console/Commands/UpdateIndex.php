<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateIndex extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cms:update-index';

    /**
     * The console command description.
     */
    protected $description = 'Patch index.blade.php: inject the dynamic marquee bar, replace the hero section with slider-aware markup, and replace the registration strip with CMS-controlled content + board notices';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $file    = resource_path('views/frontend/index.blade.php');
        $content = file_get_contents($file);

        // -----------------------------------------------------------------------
        // 1. Insert Marquee bar after </nav>
        // -----------------------------------------------------------------------
        $marqueeHtml = <<<'HTML'
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
HTML;
        $content = str_replace('  </nav>', '  </nav>' . PHP_EOL . PHP_EOL . $marqueeHtml, $content);

        // -----------------------------------------------------------------------
        // 2. Replace Hero Section
        // -----------------------------------------------------------------------
        $heroRegex      = '/<section class="hero" id="home">.*?<\/section>/s';
        $dynamicHeroHtml = <<<'HTML'
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
                <span>Top MNCs &amp; Core Industries</span>
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
              Build Technical Skills <br><span class="text-orange">Get Certified.</span> <span class="text-emerald">Get
                Placed.</span>
            </h1>
            <p class="hero-description">
              Skill Bridge India delivers practical Summer &amp; Winter Industrial Training with live projects, expert
              mentorship, and guaranteed placement drives across BTech CS/IT, Electrical, Mechanical, Electronics, and Civil
              branches.
            </p>
    
            <div class="hero-features">
              <div class="hero-feature-item">
                <i class="fas fa-check-circle"></i> 100% Placement Assistance
              </div>
              <div class="hero-feature-item">
                <i class="fas fa-check-circle"></i> Live Industrial Projects
              </div>
              <div class="hero-feature-item">
                <i class="fas fa-check-circle"></i> Centers: Lucknow &bull; Noida &bull; Bhopal
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
              <img src="{{ asset('frontend/assets/hero.jpg') }}" alt="Skill Bridge India Classroom &amp; Lab Training">
            </div>
    
            <div class="floating-badge badge-placement">
              <div class="badge-icon bg-green">
                <i class="fas fa-briefcase"></i>
              </div>
              <div class="badge-text">
                <strong>12,500+ Placed</strong>
                <span>Top MNCs &amp; Core Industries</span>
              </div>
            </div>
    
            <div class="floating-badge badge-rating">
              <div class="badge-icon bg-orange">
                <i class="fas fa-star"></i>
              </div>
              <div class="badge-text">
                <strong>4.9 / 5 Rating</strong>
                <span>Verified Student Reviews</span>
              </div>
            </div>
          </div>
        </div>
    @endif
  </section>
HTML;
        $content = preg_replace($heroRegex, $dynamicHeroHtml, $content);

        // -----------------------------------------------------------------------
        // 3. Replace Registration Strip + inject Board Notices section
        // -----------------------------------------------------------------------
        $stripRegex      = '/<section class="registration-strip">.*?<\/section>/s';
        $dynamicStripHtml = <<<'HTML'
  <section class="registration-strip">
    <div class="container strip-inner">
      @if($homePage && !empty(trim(strip_tags($homePage->content))))
          {!! $homePage->content !!}
      @else
          <!-- Fallback -->
          <div>
            <h2><i class="fas fa-bullhorn text-accent-cyan" style="margin-right: 0.6rem;"></i> Registrations Open
              For Virtual &amp; Industrial Internship Batch <span>2026</span></h2>
            <p class="text-sm" style="margin: 0; opacity: 0.9;">Hands-on practical labs, mentorship, and guaranteed
              interview opportunities across CS, EC, EE, ME &amp; Civil.</p>
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
HTML;
        $content = preg_replace($stripRegex, $dynamicStripHtml, $content);

        file_put_contents($file, $content);
        $this->info('Updated: resources/views/frontend/index.blade.php');

        return self::SUCCESS;
    }
}
