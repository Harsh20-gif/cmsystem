@extends('layouts.app')

@section('title', 'All Courses Catalog | Skill Bridge India Technologies')

@section('content')

<x-page-hero 
    title="{{ $siteSettings['courses_hero_title'] ?? 'All Training Programs' }}"
    subtitle="{{ $siteSettings['courses_hero_subtitle'] ?? 'Comprehensive BTech-aligned industrial training programs with placement assistance across all engineering streams.' }}"
    breadcrumbItem="{{ $siteSettings['courses_hero_breadcrumb'] ?? 'Course Catalog' }}"
/>

  <!-- Branch Categories Bar -->
  <section class="section-padding" style="padding-bottom: 2rem;">
    <div class="container">
      <div style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center; margin-bottom: 2rem;">
        <button class="btn btn-secondary filter-btn active" data-filter="all" style="padding: 0.7rem 1.4rem;">
          <i class="fas fa-list"></i> {{ $siteSettings['courses_filter_all_label'] ?? 'All Programs' }}
        </button>
        @foreach($courseCategories as $category)
        <button class="btn btn-outline filter-btn" data-filter="{{ $category->slug }}" style="padding: 0.7rem 1.4rem;">
          @if($category->icon && \Illuminate\Support\Str::contains($category->icon, ['/', '.png', '.jpg', '.jpeg', '.svg', '.webp']))
              <img src="{{ \Illuminate\Support\Facades\Storage::url($category->icon) }}" alt="" style="width: 16px; height: 16px; object-fit: contain; display: inline-block; vertical-align: middle; margin-right: 0.2rem;">
            @else
              <i class="{{ $category->icon ?? 'fas fa-book' }}"></i>
            @endif {{ $category->name }}
        </button>
        @endforeach
      </div>

      <!-- Live Search Box -->
      <div class="search-box" style="max-width: 500px; margin: 0 auto 3rem auto;">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="search-input text-base" id="courseSearchInput"
          placeholder="{{ $siteSettings['courses_search_placeholder'] ?? 'Search any program (e.g. Python, PLC SCADA, MERN)...' }}"
          style="width: 100%; padding-left: 2.8rem;">
      </div>

      <!-- Course Cards Container -->
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
