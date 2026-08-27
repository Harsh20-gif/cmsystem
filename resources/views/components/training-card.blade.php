@props(['training'])

<div class="course-card">
  @if($training->image)
  <img src="{{ \Illuminate\Support\Facades\Storage::url($training->image) }}" alt="{{ $training->title }}" class="course-img" style="width: 100%; height: 200px; object-fit: cover;">
  @endif
  <div class="course-body">
    <h3 class="course-title">{{ $training->title }}</h3>
    <p class="course-desc">{!! \Illuminate\Support\Str::limit(strip_tags($training->description), 100) !!}</p>
    <div class="course-footer">
      <span class="font-bold text-navy-dark">Duration: {{ $training->duration ?? 'N/A' }}</span>
      <button class="btn btn-primary" onclick="openEnrollModal('{{ addslashes($training->title) }}')">Apply Now</button>
    </div>
  </div>
</div>
