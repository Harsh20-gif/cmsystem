@props(['title', 'icon' => ''])

<div class="card shadow-sm border-0 mb-4 bg-white rounded-3">
    <div class="card-header bg-transparent border-bottom px-4 py-3 d-flex align-items-center gap-2">
        @if($icon)
            <i class="{{ $icon }} text-orange fs-5"></i>
        @endif
        <h5 class="mb-0 fw-bold text-navy">{{ $title }}</h5>
    </div>
    <div class="card-body p-4">
        {{ $slot }}
    </div>
</div>
