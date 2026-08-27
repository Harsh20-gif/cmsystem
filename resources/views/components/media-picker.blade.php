@props(['name', 'id' => 'media_id', 'label' => 'Image', 'value' => null])

<div class="mb-3">
    <label class="form-label fw-semibold text-dark">{{ $label }}</label>
    
    <div class="border rounded-3 p-3 text-center position-relative" style="background-color: #f8fafc; border: 2px dashed #cbd5e1 !important; transition: all 0.2s ease;" id="{{ $id }}_dropzone">
        
        <div id="{{ $id }}_placeholder" style="display: {{ $value ? 'none' : 'block' }}">
            <i class="fas fa-cloud-upload-alt fs-2 text-muted mb-2"></i>
            <p class="mb-2 text-muted small">Select an image from the media library</p>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openMediaPicker('{{ $id }}')">
                <i class="fas fa-folder-open"></i> Browse Media
            </button>
        </div>

        <div id="{{ $id }}_preview_container" style="display: {{ $value ? 'block' : 'none' }}">
            <div class="position-relative d-inline-block">
                <img id="{{ $id }}_preview" src="{{ $value ? Storage::url($value) : '' }}" class="img-fluid rounded shadow-sm object-fit-cover" style="max-height: 140px; max-width: 100%;">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 start-100 translate-middle rounded-circle shadow" style="width: 28px; height: 28px; padding: 0; display: flex; align-items: center; justify-content: center;" onclick="clearMedia('{{ $id }}')" title="Remove Image">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mt-3">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openMediaPicker('{{ $id }}')">
                    <i class="fas fa-exchange-alt"></i> Change Image
                </button>
            </div>
        </div>

        <input type="hidden" name="{{ $name }}" id="{{ $id }}_input" value="{{ $value }}">
    </div>
</div>

@once
@push('scripts')
<!-- Media Picker Modal -->
<div class="modal fade" id="mediaPickerModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">
                <!-- Upload Form -->
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-body">
                        <form id="mediaPickerUploadForm" action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex gap-2">
                                <input type="file" name="file" id="mediaPickerFileInput" class="form-control" accept="image/*" required>
                                <button type="submit" class="btn btn-orange" id="mediaPickerUploadBtn">
                                    <i class="fas fa-upload"></i> Upload
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Media Grid -->
                <div class="row g-3" id="mediaPickerGrid">
                    <div class="col-12 text-center py-5" id="mediaPickerLoading" style="display: none;">
                        <div class="spinner-border text-orange" role="status"></div>
                    </div>
                </div>
                
                <div class="text-center mt-3" id="mediaPickerLoadMoreContainer" style="display: none;">
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="mediaPickerLoadMoreBtn">Load More</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentMediaPickerTargetId = null;
    let nextMediaPageUrl = '{{ route("admin.media.index") }}';
    const mediaPickerModal = new bootstrap.Modal(document.getElementById('mediaPickerModal'));
    
    function openMediaPicker(targetId) {
        currentMediaPickerTargetId = targetId;
        nextMediaPageUrl = '{{ route("admin.media.index") }}';
        document.getElementById('mediaPickerGrid').innerHTML = '';
        loadMedia(nextMediaPageUrl);
        mediaPickerModal.show();
    }
    
    function clearMedia(targetId) {
        document.getElementById(targetId + '_input').value = '';
        document.getElementById(targetId + '_preview').src = '';
        document.getElementById(targetId + '_preview_container').style.display = 'none';
        document.getElementById(targetId + '_placeholder').style.display = 'block';
    }
    
    function loadMedia(url) {
        if (!url) return;
        document.getElementById('mediaPickerLoadMoreContainer').style.display = 'none';
        
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('mediaPickerGrid').insertAdjacentHTML('beforeend', data.html);
            nextMediaPageUrl = data.next_page;
            if (nextMediaPageUrl) {
                document.getElementById('mediaPickerLoadMoreContainer').style.display = 'block';
            }
        })
        .catch(err => console.error(err));
    }
    
    document.getElementById('mediaPickerLoadMoreBtn').addEventListener('click', function() {
        loadMedia(nextMediaPageUrl);
    });
    
    // Handle selection
    document.addEventListener('click', function(e) {
        if (e.target.closest('.media-picker-item')) {
            const item = e.target.closest('.media-picker-item');
            const path = item.dataset.path;
            const url = item.dataset.url;
            
            document.getElementById(currentMediaPickerTargetId + '_input').value = path;
            document.getElementById(currentMediaPickerTargetId + '_preview').src = url;
            
            document.getElementById(currentMediaPickerTargetId + '_placeholder').style.display = 'none';
            document.getElementById(currentMediaPickerTargetId + '_preview_container').style.display = 'block';
            
            mediaPickerModal.hide();
        }
    });

    // Handle Upload
    document.getElementById('mediaPickerUploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const btn = document.getElementById('mediaPickerUploadBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-upload"></i> Upload';
            document.getElementById('mediaPickerFileInput').value = '';
            
            // Reload grid
            nextMediaPageUrl = '{{ route("admin.media.index") }}';
            document.getElementById('mediaPickerGrid').innerHTML = '';
            loadMedia(nextMediaPageUrl);
        })
        .catch(err => {
            console.error(err);
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-upload"></i> Upload';
            alert('Upload failed.');
        });
    });
</script>
@endpush
@endonce
