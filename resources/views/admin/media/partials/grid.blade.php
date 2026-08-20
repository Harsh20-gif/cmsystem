@forelse($media as $m)
<div class="col-md-3 col-sm-4 col-6">
    <div class="card h-100 position-relative media-picker-item" style="cursor: pointer;" data-path="{{ $m->file_path }}" data-url="{{ Storage::url($m->file_path) }}">
        <img src="{{ Storage::url($m->file_path) }}" class="card-img-top" alt="{{ $m->file_name }}" style="height: 100px; object-fit: cover;">
        <div class="card-body p-1 text-center">
            <small class="text-truncate d-block" style="font-size: 0.75rem;">{{ $m->file_name }}</small>
        </div>
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-0 hover-opacity-25 transition-all"></div>
    </div>
</div>
@empty
<div class="col-12 text-center py-4 text-muted">
    No media found.
</div>
@endforelse

<style>
    .hover-opacity-25:hover { opacity: 0.25 !important; }
    .transition-all { transition: all 0.2s; }
</style>
