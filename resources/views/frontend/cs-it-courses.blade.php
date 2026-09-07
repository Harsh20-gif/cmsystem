@extends('layouts.app')

@section('title', $siteSettings['csit_page_title'] ?? 'Computer Science & IT Courses | Skill Bridge India Technologies')

@section('content')

<x-page-hero 
    title="{{ $siteSettings['csit_hero_title'] ?? 'Computer Science & IT Programs' }}"
    subtitle="{{ $siteSettings['csit_hero_subtitle'] ?? 'Job-guaranteed training in Fullstack Web Development, Python Django, Data Science, AI, Cloud DevOps, and Ethical Hacking with 100% placement drives.' }}"
    breadcrumbItem="{{ $siteSettings['csit_hero_breadcrumb'] ?? 'CS & IT' }}"
/>

  <!-- CS & IT Specialization Grid -->
  <section class="section-padding">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-code"></i> {{ $siteSettings['csit_intro_badge'] ?? 'Software Engineering Tracks' }}</div>
        <h2 class="section-title">{{ $siteSettings['csit_intro_title_1'] ?? 'Job-Oriented' }} <span class="highlight">{{ $siteSettings['csit_intro_title_2'] ?? 'CS & IT Courses' }}</span></h2>
        <p class="section-subtitle">{{ $siteSettings['csit_intro_subtitle'] ?? 'Hands-on practical development with live industrial capstone projects and mentor-led technical preparation.' }}</p>
      </div>

      <div class="courses-grid" id="coursesContainer">
        <!-- Dynamically rendered via script.js -->
      </div>
    </div>
  </section>

  @endsection

@push('scripts')
<script>
  window.coursesData = @json($formattedCourses);
</script>
@endpush
