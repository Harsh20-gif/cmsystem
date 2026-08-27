@props(['placement'])

<div class="student-card">
  <div class="student-header">
    @if($placement->student && $placement->student->photo)
    <img src="{{ \Illuminate\Support\Facades\Storage::url($placement->student->photo) }}" alt="{{ $placement->student->name }}" class="student-avatar" style="object-fit: cover;">
    @else
    <img src="{{ asset('frontend/assets/hero.jpg') }}" alt="{{ $placement->student->name ?? 'Student' }}" class="student-avatar" style="object-fit: cover;">
    @endif
    <div class="student-info">
      <h4>{{ $placement->student->name ?? 'Unknown Student' }}</h4>
      <p>Placed at: <strong>{{ $placement->company->name ?? 'Unknown Company' }}</strong></p>
    </div>
  </div>
  <div class="placement-badge">
    @if($placement->package)
        <i class="fas fa-rupee-sign"></i> {{ $placement->package }} •
    @endif
    {{ $placement->position ?? ($placement->job_role ?? '') }}
  </div>
  @if($placement->testimonial_text)
  <p class="student-quote">"{{ $placement->testimonial_text }}"</p>
  @endif
</div>
