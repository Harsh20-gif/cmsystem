@props(['course'])

<div class="course-card">
  <div class="course-thumbnail">
    <img src="{{ $course->thumbnail ? asset('frontend/assets/' . $course->thumbnail) : asset('frontend/assets/hero.jpg') }}" alt="{{ $course->title }}">
    <span class="course-tag {{ strtolower($course->tag) == 'popular' ? 'popular' : 'job-guaranteed' }}">{{ $course->tag ?? 'Course' }}</span>
    <span class="course-mode"><i class="fas fa-laptop"></i> {{ $course->mode ?? 'Online / Classroom' }}</span>
  </div>
  <div class="course-body">
    <div class="course-meta">
      <span><i class="far fa-clock"></i> {{ $course->duration }}</span>
      <span><i class="fas fa-star text-warning"></i> 4.9 (1,240 Reviews)</span>
    </div>
    <h3 class="course-title">{{ $course->title }}</h3>
    <p class="course-desc">{{ Str::limit(strip_tags($course->description), 120) }}</p>
    <div class="course-tools">
      @if($course->tools && is_string($course->tools))
          @php $tools = json_decode($course->tools, true); @endphp
          @if(is_array($tools))
              @foreach($tools as $tool)
                  <span class="tool-chip">{{ $tool }}</span>
              @endforeach
          @endif
      @endif
    </div>
    <div class="course-footer">
      <div class="course-price">
        <span class="fee-amount">₹{{ number_format((float)$course->fee) }}</span>
        <span class="fee-emi">EMI at ₹{{ number_format((float)($course->emi_amount ?? 0)) }}/mo</span>
      </div>
      <div class="course-actions">
        <button class="btn btn-primary" onclick="openEnrollModal('{{ addslashes($course->title) }}')">Enroll</button>
      </div>
    </div>
  </div>
</div>
