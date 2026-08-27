@php
    $footerPage = \App\Models\Page::where('page_key', 'footer')->where('status', 'published')->first();
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
                    <img src="{{ asset('frontend/assets/logo_v1.png') }}" alt="Skill Bridge India Logo" class="mb-4" style="height: 60px;">
                    <p class="text-start pe-lg-4 mb-0" style="line-height: 1.8; opacity: 0.9;">
                        Skill Bridge India Technologies is a premier virtual job-oriented BTech training and industrial placement institute delivering job-guaranteed skill transformation across CS/IT, Electrical, Mechanical, Electronics, and Civil branches through online programs and virtual placement support.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-12 col-lg-3 col-md-6">
                    <h4 class="footer-title mb-4 pb-2" style="border-bottom: 2px solid rgba(255,255,255,0.1); display: inline-block;">Quick Links</h4>
                    <ul class="footer-links list-unstyled d-flex flex-column gap-3 mb-0">
                        <li><a href="{{ route('courses') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> Courses</a></li>
                        <li><a href="{{ route('corporate-training') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> Trainings</a></li>
                        <li><a href="{{ route('placements') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> Placements</a></li>
                        <li><a href="{{ route('gallery') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> Gallery</a></li>
                        <li><a href="{{ route('about') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-decoration-none"><i class="fas fa-angle-right me-2 text-accent-cyan"></i> Contact Us</a></li>
                    </ul>
                </div>

                <!-- Contact Us -->
                <div class="col-12 col-lg-4 col-md-6">
                    <h4 class="footer-title mb-4 pb-2" style="border-bottom: 2px solid rgba(255,255,255,0.1); display: inline-block;">Contact Us</h4>
                    <div class="d-flex flex-column gap-3 mb-0">
                        <p class="mb-0 d-flex align-items-center">
                            <i class="fas fa-phone text-accent-cyan me-3 fs-5" style="width: 20px; text-align: center;"></i> 
                            <span><strong>8467912807</strong></span>
                        </p>
                        <p class="mb-0 d-flex align-items-center">
                            <i class="fas fa-envelope text-accent-cyan me-3 fs-5" style="width: 20px; text-align: center;"></i> 
                            <span>info@skillbridgeindia.com</span>
                        </p>
                    </div>
                </div>

            </div>

            <!-- Bottom Bar -->
            <div class="pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 text-center text-md-start" style="font-size: 0.9rem; opacity: 0.8;">
                    <div>&copy; 2026 Skill Bridge India Technologies Pvt Ltd. All Rights Reserved.</div>
                    <div>Powered by <a href="https://dashandots.com/" class="text-white text-decoration-none fw-bold hover-cyan">Dashandots Technology</a></div>
                </div>
            </div>
            
        </div>
    </footer>
@endif
