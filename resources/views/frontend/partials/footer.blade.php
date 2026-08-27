@php
    $footerPage = \App\Models\Page::where('page_key', 'footer')->where('status', 'published')->first();
    $siteSettings = \App\Models\SiteSetting::pluck('setting_value', 'setting_key')->toArray();
    $footerLinks = \App\Models\FooterLink::published()->orderBy('order_position')->get();
@endphp

@if($footerPage && !empty(trim(strip_tags($footerPage->content))))
    {!! $footerPage->content !!}
@else
    <!-- Fallback Footer -->
    <footer class="footer py-5">
        <div class="container">
            <!-- Main Footer Content -->
            <div class="row gy-5 gx-lg-5 mb-5">
                
                <!-- Brand & About -->
                <div class="col-12 col-lg-5 col-md-12">
                    @php
                        $footerLogo = $siteSettings['footer_logo'] ?? null;
                        $defaultLogo = asset('frontend/assets/logo_v1.png');
                    @endphp
                    <img src="{{ $footerLogo ? asset('storage/' . $footerLogo) : $defaultLogo }}" alt="Skill Bridge India Logo" class="mb-4" style="height: 60px;">
                    <p class="text-start pe-lg-4 mb-0" style="line-height: 1.8; opacity: 0.9;">
                        {{ $siteSettings['footer_about_text'] ?? 'Skill Bridge India Technologies is a premier virtual job-oriented BTech training and industrial placement institute delivering job-guaranteed skill transformation across CS/IT, Electrical, Mechanical, Electronics, and Civil branches through online programs and virtual placement support.' }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-12 col-lg-3 col-md-6">
                    <h4 class="footer-title mb-4 pb-2" style="border-bottom: 2px solid rgba(255,255,255,0.1); display: inline-block;">Quick Links</h4>
                    <ul class="footer-links list-unstyled d-flex flex-column gap-3 mb-0">
                        @forelse($footerLinks as $link)
                            <li><a href="{{ $link->url }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> {{ $link->label }}</a></li>
                        @empty
                            <li><a href="{{ route('courses') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> Courses</a></li>
                            <li><a href="{{ route('corporate-training') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> Trainings</a></li>
                            <li><a href="{{ route('placements') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> Placements</a></li>
                            <li><a href="{{ route('gallery') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> Gallery</a></li>
                            <li><a href="{{ route('about') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> About Us</a></li>
                            <li><a href="{{ route('contact') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> Contact Us</a></li>
                        @endforelse
                    </ul>
                </div>

                <!-- Contact Us -->
                <div class="col-12 col-lg-4 col-md-6">
                    <h4 class="footer-title mb-4 pb-2" style="border-bottom: 2px solid rgba(255,255,255,0.1); display: inline-block;">Contact Us</h4>
                    <div class="d-flex flex-column gap-3 mb-0">
                        <p class="mb-0 d-flex align-items-center">
                            <i class="fas fa-phone text-accent-cyan me-3 fs-5" style="width: 20px; text-align: center;"></i> 
                            <span><strong>{{ $siteSettings['contact_helpline_value'] ?? '8467912807' }}</strong></span>
                        </p>
                        <p class="mb-0 d-flex align-items-center">
                            <i class="fas fa-envelope text-accent-cyan me-3 fs-5" style="width: 20px; text-align: center;"></i> 
                            <span>{{ $siteSettings['contact_email_value'] ?? 'info@skillbridgeindia.com' }}</span>
                        </p>
                    </div>
                </div>

            </div>

            <!-- Bottom Bar -->
            <div class="pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 text-center text-md-start" style="font-size: 0.9rem; opacity: 0.8;">
                    @php
                        $copyright = $siteSettings['footer_copyright_text'] ?? '© {year} Skill Bridge India Technologies Pvt Ltd. All Rights Reserved.';
                        $copyright = str_replace('{year}', date('Y'), $copyright);
                        
                        $poweredBy = $siteSettings['footer_powered_by'] ?? 'Powered by Dashandots Technology';
                        $poweredByUrl = $siteSettings['footer_powered_by_url'] ?? 'https://dashandots.com/';
                    @endphp
                    <div>{{ $copyright }}</div>
                    @if($poweredBy)
                        @if($poweredByUrl)
                            <div>Powered by <a href="{{ $poweredByUrl }}" class="text-white text-decoration-none fw-bold hover-cyan">{{ str_replace('Powered by ', '', $poweredBy) }}</a></div>
                        @else
                            <div>{{ $poweredBy }}</div>
                        @endif
                    @endif
                </div>
            </div>
            
        </div>
    </footer>
@endif
