@extends('layouts.app')

@section('title', 'Corporate Training & Summer Internships | Skill Bridge India')

@section('content')

<x-page-hero 
    title="Industrial Training & Summer Internships"
    subtitle="4-Week & 6-Week ISO Certified Project-based Training for B.Tech/Diploma Students."
    breadcrumbItem="Trainings"
/>

  <!-- Institutional Collaboration Overview -->
  <section class="section-padding">
    <div class="container">
      <!-- <div class="aktu-box" style="margin-bottom: 3.5rem;">
        <div class="aktu-header">
          <div>
            <span class="aktu-badge"><i class="fas fa-university"></i> University & College MOUs</span>
            <h2 class="heading-lg text-navy-dark" style="margin-bottom: 0.5rem;">
              AKTU & University Collaboration Programs 2026
            </h2>
            <p class="text-base text-slate-body">
              Skill Bridge India partners with engineering colleges across Uttar Pradesh, Delhi NCR, and Madhya Pradesh
              to deliver syllabus-aligned industrial training, faculty development (FDP), and on-campus placement
              drives.
            </p>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 2rem;">
          <div class="feature-card" style="padding: 1.5rem;">
            <i class="fas fa-certificate heading-lg text-accent-coral"
              style="margin-bottom: 0.8rem;"></i>
            <h4>Valid Certificate & Project Report</h4>
            <p>ISO certified 4/6/8 week training certificate with verified project report required for university
              submission.</p>
          </div>
          <div class="feature-card" style="padding: 1.5rem;">
            <i class="fas fa-laptop-code heading-lg text-accent-cyan-dark"
              style="margin-bottom: 0.8rem;"></i>
            <h4>Live Hardware & Software Labs</h4>
            <p>Hands-on practice on real industrial software (React, Python, AWS, AutoCad, Revit, PLC SCADA, MEP
              hardware).</p>
          </div>
          <div class="feature-card" style="padding: 1.5rem;">
            <i class="fas fa-briefcase heading-lg text-navy-primary" style="margin-bottom: 0.8rem;"></i>
            <h4>Direct Placement Drive Eligibility</h4>
            <p>All internship candidates gain lifetime access to our 350+ corporate hiring drives and interview prep
              calls.</p>
          </div>
        </div>
      </div> -->

      <!-- Training Tracks for Engineering Branches -->
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-graduation-cap"></i> Internship Tracks</div>
        <h2 class="section-title">Seasonal Training <span class="highlight">Tracks (2026 Batch)</span></h2>
        <p class="section-subtitle">Select your branch specialization for 4-Week, 6-Week, or 6-Month industrial
          internship modules.</p>
      </div>

      <div class="courses-grid">
        @forelse($trainings as $training)
        <x-training-card :training="$training" />

        @empty
        <div class="col-12 text-center py-5">
            <p>No trainings available at the moment.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  @endsection
