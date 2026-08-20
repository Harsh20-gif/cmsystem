@props(['name', 'id' => 'media_id', 'label' => 'Image', 'value' => null])

<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <div class="d-flex align-items-center gap-3">
        <div class="border rounded p-1" style="width: 100px; height: 100px; background: #f8f9fa;">
            <img id="{{ $id }}_preview" src="{{ $value ? Storage::url($value) : '' }}" class="img-fluid h-100 w-100 object-fit-cover" style="display: {{ $value ? 'block' : 'none' }}">
        </div>
        <div>
            <input type="hidden" name="{{ $name }}" id="{{ $id }}_input" value="{{ $value }}">
            <button type="button" class="btn btn-outline-secondary mb-2" onclick="openMediaPicker('{{ $id }}')">
                Browse Media
            </button>
            <br>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearMedia('{{ $id }}')">
                Clear
            </button>
        </div>
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
                <div class="card mb-3">
                    <div class="card-body">
                        <form id="mediaPickerUploadForm" action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex gap-2">
                                <input type="file" name="file" id="mediaPickerFileInput" class="form-control" accept="image/*" required>
                                <button type="submit" class="btn btn-orange" id="mediaPickerUploadBtn">Upload</button>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        document.getElementById(targetId + '_preview').style.display = 'none';
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
            document.getElementById(currentMediaPickerTargetId + '_preview').style.display = 'block';
            
            mediaPickerModal.hide();
        }
    });

    // Handle Upload
    document.getElementById('mediaPickerUploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const btn = document.getElementById('mediaPickerUploadBtn');
        btn.disabled = true;
        btn.innerHTML = 'Uploading...';
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = 'Upload';
            document.getElementById('mediaPickerFileInput').value = '';
            
            // Reload grid
            nextMediaPageUrl = '{{ route("admin.media.index") }}';
            document.getElementById('mediaPickerGrid').innerHTML = '';
            loadMedia(nextMediaPageUrl);
        })
        .catch(err => {
            console.error(err);
            btn.disabled = false;
            btn.innerHTML = 'Upload';
            alert('Upload failed.');
        });
    });
</script>
@endpush
@endonce
