@extends('layouts.app')

@section('title', $siteSettings['core_page_title'] ?? 'Core Engineering Training | Skill Bridge India Technologies')

@section('content')

<x-page-hero 
    title="{{ $siteSettings['core_hero_title'] ?? 'Core Engineering Programs' }}"
    subtitle="{{ $siteSettings['core_hero_subtitle'] ?? 'Practical industrial training in PLC SCADA, Industrial Automation, MEP, HVAC, Embedded Systems, and Robotics.' }}"
    breadcrumbItem="{{ $siteSettings['core_hero_breadcrumb'] ?? 'Core Engineering' }}"
/>

  <!-- Electrical Engineering Section -->
  <section class="section-padding" id="electrical">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag coral-tag"><i class="fas fa-bolt"></i> {{ $siteSettings['core_elec_badge'] ?? 'Electrical Branch' }}</div>
        <h2 class="section-title">{{ $siteSettings['core_elec_title_1'] ?? 'Industrial Automation &' }} <span class="highlight">{{ $siteSettings['core_elec_title_2'] ?? 'PLC SCADA' }}</span></h2>
        <p class="section-subtitle">{{ $siteSettings['core_elec_subtitle'] ?? 'Practical Siemens, Allen Bradley, SCADA, Panel Designing, and Building Management Systems (BMS).' }}</p>
      </div>

      <div class="courses-grid">
        @forelse($coursesByCategory['electrical'] ?? [] as $course)
            <x-course-card :course="$course" />
        @empty
            <div class="col-12 text-center py-4 w-100" style="grid-column: 1/-1;">
                <p class="text-muted">{{ $siteSettings['core_empty_text'] ?? 'Courses will be updated soon.' }}</p>
            </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Mechanical Engineering & MEP/HVAC Section -->
  <section class="section-padding bg-surface" id="mechanical">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-cogs"></i> {{ $siteSettings['core_mech_badge'] ?? 'Mechanical Branch' }}</div>
        <h2 class="section-title">{{ $siteSettings['core_mech_title_1'] ?? 'MEP & HVAC Design' }} <span class="highlight">{{ $siteSettings['core_mech_title_2'] ?? 'Engineering' }}</span></h2>
        <p class="section-subtitle">{{ $siteSettings['core_mech_subtitle'] ?? 'Heating, Ventilation, Air Conditioning (HVAC), Plumbing, Firefighting, Revit MEP, and AutoCad 3D.' }}</p>
      </div>

      <div class="courses-grid">
        @forelse($coursesByCategory['mechanical'] ?? [] as $course)
            <x-course-card :course="$course" />
        @empty
            <div class="col-12 text-center py-4 w-100" style="grid-column: 1/-1;">
                <p class="text-muted">{{ $siteSettings['core_empty_text'] ?? 'Courses will be updated soon.' }}</p>
            </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Electronics Engineering Section -->
  <section class="section-padding" id="electronics">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag coral-tag"><i class="fas fa-microchip"></i> {{ $siteSettings['core_ec_badge'] ?? 'Electronics Branch' }}</div>
        <h2 class="section-title">{{ $siteSettings['core_ec_title_1'] ?? 'Embedded Systems,' }} <span class="highlight">{{ $siteSettings['core_ec_title_2'] ?? 'IoT & Robotics' }}</span></h2>
        <p class="section-subtitle">{{ $siteSettings['core_ec_subtitle'] ?? 'Microcontrollers, ARM, Raspberry Pi, PCB Design, VLSI, and Internet of Things (IoT).' }}</p>
      </div>

      <div class="courses-grid">
        @forelse($coursesByCategory['electronics'] ?? [] as $course)
            <x-course-card :course="$course" />
        @empty
            <div class="col-12 text-center py-4 w-100" style="grid-column: 1/-1;">
                <p class="text-muted">{{ $siteSettings['core_empty_text'] ?? 'Courses will be updated soon.' }}</p>
            </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Civil Engineering Section -->
  <section class="section-padding bg-surface" id="civil">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-drafting-compass"></i> {{ $siteSettings['core_civil_badge'] ?? 'Civil Branch' }}</div>
        <h2 class="section-title">{{ $siteSettings['core_civil_title_1'] ?? 'AutoCad, Revit &' }} <span class="highlight">{{ $siteSettings['core_civil_title_2'] ?? 'Civil 3D Design' }}</span></h2>
        <p class="section-subtitle">{{ $siteSettings['core_civil_subtitle'] ?? 'Structural engineering software, 3DS Max architectural modeling, and Civil 3D highway layout design.' }}</p>
      </div>

      <div class="courses-grid">
        @forelse($coursesByCategory['civil'] ?? [] as $course)
            <x-course-card :course="$course" />
        @empty
            <div class="col-12 text-center py-4 w-100" style="grid-column: 1/-1;">
                <p class="text-muted">{{ $siteSettings['core_empty_text'] ?? 'Courses will be updated soon.' }}</p>
            </div>
        @endforelse
      </div>
    </div>
  </section>

  @endsection
