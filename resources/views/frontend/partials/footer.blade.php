@php
    $footerPage = \App\Models\Page::where('page_key', 'footer')->where('status', 'published')->first();
@endphp

@if($footerPage && !empty(trim(strip_tags($footerPage->content))))
    {!! $footerPage->content !!}
@else
    <!-- Fallback Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <img src="{{ asset('frontend/assets/logo_v1.png') }}" alt="Skill Bridge India Logo"
                        style="height: 60px; filter: brightness(0) invert(1);">
                    <p>
                        Skill Bridge India Technologies Pvt Ltd is a premier job-oriented BTech training and industrial placement
                        institute delivering job-guaranteed skill transformation across CS/IT, Electrical, Mechanical, Electronics,
                        and Civil branches in Noida, Lucknow, and Bhopal.
                    </p>
                </div>

                <div>
                    <h4 class="footer-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('courses') }}"><i class="fas fa-angle-right"></i> Courses</a></li>
                        <li><a href="{{ route('corporate-training') }}"><i class="fas fa-angle-right"></i> Trainings</a></li>
                        <li><a href="{{ route('placements') }}"><i class="fas fa-angle-right"></i> Placements</a></li>
                        <li><a href="{{ route('gallery') }}"><i class="fas fa-angle-right"></i> Gallery</a></li>
                        <li><a href="{{ route('about') }}"><i class="fas fa-angle-right"></i> About Us</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fas fa-angle-right"></i> Contact Us</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-title">Training Tracks</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('cs-it-courses') }}"><i class="fas fa-code"></i> Fullstack Web Dev</a></li>
                        <li><a href="{{ route('cs-it-courses') }}"><i class="fas fa-brain"></i> Data Science & AI</a></li>
                        <li><a href="core-engineering.html#electrical"><i class="fas fa-bolt"></i> PLC SCADA & Automation</a></li>
                        <li><a href="core-engineering.html#mechanical"><i class="fas fa-cogs"></i> MEP & HVAC Design</a></li>
                        <li><a href="core-engineering.html#electronics"><i class="fas fa-microchip"></i> Embedded Systems & IoT</a></li>
                        <li><a href="core-engineering.html#civil"><i class="fas fa-drafting-compass"></i> AutoCad & Revit</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-title">Contact Us</h4>
                    <p class="text-sm" style="margin-bottom: 0.6rem;"><i class="fas fa-headset text-accent-cyan"></i> <strong>Helpdesk:</strong> +91 85428 41114</p>
                    <p class="text-sm" style="margin-top: 1rem;"><i class="fas fa-envelope text-accent-cyan"></i> info@skillbridgeindia.com</p>
                </div>
            </div>

            <div class="footer-bottom">
                <div>© 2026 Skill Bridge India Technologies Pvt Ltd. All Rights Reserved.</div>
                <div>Modeled for BTech Engineering Skilling & Industrial Placement.</div>
            </div>
        </div>
    </footer>
@endif
