@props(['title', 'subtitle', 'breadcrumbItem'])

<section class="page-hero">
  <div class="container">
    <h1 class="page-hero-title">{{ $title }}</h1>
    <p class="page-hero-subtitle">{{ $subtitle }}</p>
    <div class="breadcrumb-list">
      <a href="{{ route('home') }}">Home</a> <i class="fas fa-chevron-right text-xs"></i>
      <span>{{ $breadcrumbItem }}</span>
    </div>
  </div>
</section>
