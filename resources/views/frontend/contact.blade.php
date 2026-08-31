@extends('layouts.app')

@section('title', isset($page) ? $page->title . ' | Skill Bridge India Technologies' : 'Contact Us & Branch Locations | Skill Bridge India Technologies')

@section('content')

<x-page-hero 
    title="{{ isset($page) ? $page->title : ($siteSettings['contact_hero_title'] ?? 'Contact Us & Virtual Support') }}"
    subtitle="{{ $siteSettings['contact_hero_subtitle'] ?? 'Reach out for free virtual career counseling, seat booking, and online internship admissions.' }}"
    breadcrumbItem="{{ $siteSettings['contact_hero_breadcrumb'] ?? 'Contact Us' }}"
/>



  <!-- Interactive Contact Form & Map Section -->
  <section class="section-padding" style="background: var(--bg-surface);">
    <div class="container">
      <div class="hero-grid" style="align-items: start; gap: 3.5rem;">
        <div>
          <span class="badge-tag coral-tag" style="text-transform: uppercase;"><i class="fas fa-paper-plane"></i> Direct Inquiry</span>
          <h2 class="section-title" style="text-align: left;">Send Us a <span class="highlight">Message</span></h2>
          <p style="color: var(--slate-body); margin-bottom: 2rem;">{{ $siteSettings['contact_intro_text'] ?? 'Fill out the form below to connect with a senior career counselor within 30 minutes.' }}</p>

          <form id="contactPageForm" onsubmit="handleEnrollSubmit(event)" style="background: var(--bg-pure-white); padding: 2.2rem; border-radius: var(--radius-lg); border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
            @csrf
            <input type="hidden" name="type" value="contact">
            <div class="form-group">
              <label class="form-label">Full Name *</label>
              <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
            </div>
            <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Phone Number *</label>
                <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required>
              </div>
              <div class="form-group">
                <label class="form-label">Email Address *</label>
                <input type="email" name="email" class="form-control" placeholder="name@domain.com" required>
              </div>
            </div>
            
            <div class="form-grid">
              <div class="form-group">
                <label class="form-label">State *</label>
                <select name="state" class="form-control" required>
                    <option value="">Select State</option>
                    @foreach($states as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">City *</label>
                <input type="text" name="city" class="form-control" placeholder="e.g. Lucknow" required>
              </div>
            </div>
            
            <!-- <div class="form-group">
              <label class="form-label">College/University & Passing Year *</label>
              <input type="text" name="college" class="form-control" placeholder="e.g. BBD University, 2025" required>
            </div>

            <div class="form-group">
              <label class="form-label">Engineering Branch / Stream *</label>
              <select name="course_name" class="form-control" required>
                <option value="">Select Engineering Branch</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->name }}">{{ $branch->name }}</option>
                @endforeach
              </select>
            </div> -->

            
            <div class="form-group">
              <label class="form-label">Your Message or Inquiry</label>
              <textarea name="message" class="form-control" rows="4" placeholder="Tell us about your learning goals or batch queries..."></textarea>
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
                <strong style="display: block; color: var(--navy-dark); font-size: 1.05rem;">{{ $siteSettings['contact_timings_label'] ?? 'Center Timings' }}</strong>
                <span style="color: var(--slate-muted); font-size: 0.9rem;">{{ $siteSettings['contact_timings_value'] ?? 'Monday - Saturday: 9:00 AM to 5:00 PM' }}</span>
              </div>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1.2rem;">
              <i class="fas fa-headset" style="font-size: 1.6rem; color: var(--accent-cyan-dark);"></i>
              <div>
                <strong style="display: block; color: var(--navy-dark); font-size: 1.05rem;">{{ $siteSettings['contact_helpline_label'] ?? 'Student Helpline' }}</strong>
                <span style="color: var(--slate-muted); font-size: 0.9rem;">{{ $siteSettings['contact_helpline_value'] ?? '24x7 Helpline: +91 8467912807' }}</span>
              </div>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center;">
              <i class="fas fa-envelope-open-text" style="font-size: 1.6rem; color: var(--navy-primary);"></i>
              <div>
                <strong style="display: block; color: var(--navy-dark); font-size: 1.05rem;">{{ $siteSettings['contact_email_label'] ?? 'Admissions Email' }}</strong>
                <span style="color: var(--slate-muted); font-size: 0.9rem;">{{ $siteSettings['contact_email_value'] ?? 'info@skillbridgeindiatechnologies.com' }}</span>
              </div>
            </div>
          </div>

          <div style="background: var(--navy-dark); color: #FFFFFF; padding: 2.2rem; border-radius: var(--radius-lg); text-align: center;">
            <i class="fas fa-video" style="font-size: 3rem; color: var(--accent-cyan); margin-bottom: 1rem;"></i>
            <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">{{ $siteSettings['contact_virtual_heading'] ?? 'Virtual Counseling' }}</h3>
            <p style="color: rgba(255,255,255,0.85); font-size: 0.95rem; margin-bottom: 1.5rem;">{{ $siteSettings['contact_virtual_desc'] ?? 'Connect instantly with our mentors online for a live counseling session!' }}</p>
            @php
                $btnLink = $siteSettings['contact_virtual_btn_link'] ?? 'openEnrollModal(\'Online Demo Pass\')';
                $btnAction = str_starts_with($btnLink, 'http') ? 'onclick="window.location.href=\''. $btnLink .'\'"' : 'onclick="' . $btnLink . '"';
            @endphp
            <button class="btn btn-outline" style="background: #FFFFFF; color: var(--navy-dark); border-color: transparent;" {!! $btnAction !!}><i class="fas fa-desktop"></i> {{ $siteSettings['contact_virtual_btn_label'] ?? 'Get Online Demo Pass' }}</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection
