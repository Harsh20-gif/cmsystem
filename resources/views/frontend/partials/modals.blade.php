<!-- Course Detail Modal -->
<div class="modal-overlay" id="courseModalOverlay">
  <div class="modal-card">
    <button class="modal-close" onclick="closeModal('courseModalOverlay')"><i class="fas fa-times"></i></button>
    <div class="modal-header">
      <h3 id="courseModalTitle">Course Title</h3>
    </div>
    <div class="modal-body" id="courseModalBody">
      <!-- Dynamic Content injected via script.js -->
    </div>
  </div>
</div>
<!-- Modals -->
@include('frontend.partials.enroll_modal')

<!-- Toast Notification -->
<div class="toast-notification" id="toastNotification">
  <i class="fas fa-check-circle heading-md text-accent-cyan"></i>
  <span id="toastText">Action successful!</span>
</div>

