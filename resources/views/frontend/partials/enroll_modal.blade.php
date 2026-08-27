{{-- ============================================================
     Quick Enquiry Modal (Bootstrap 5 — included every page via
     resources/views/frontend/partials/modals.blade.php)
     Submits to POST /submit-enquiry (same endpoint as Contact Us)
     ============================================================ --}}
<div class="modal fade" id="quickEnquiryModal" tabindex="-1"
     aria-labelledby="quickEnquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
       style="max-width: 520px;">
    <div class="modal-content border-0 shadow-lg" style="border-radius:16px; overflow:hidden;">

      {{-- Header --}}
      <div class="modal-header border-0 py-3 px-4"
           style="background: linear-gradient(135deg, #071638, #1a3a7c);">
        <div class="d-flex align-items-center gap-2">
          <i class="fas fa-user-graduate text-white" style="font-size:1.1rem;"></i>
          <h5 class="modal-title mb-0 text-white fw-bold" id="quickEnquiryModalLabel"
              style="font-size:1rem;">Contact us</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                aria-label="Close"></button>
      </div>

      {{-- Body --}}
      <div class="modal-body px-4 py-3">

        {{-- Success state --}}
        <div id="qeSuccessMsg" class="text-center py-4 d-none">
          <i class="fas fa-check-circle mb-3" style="font-size:3rem; color:#10b981;"></i>
          <h5 class="fw-bold" style="color:#071638;">Enquiry Sent!</h5>
          <p class="text-muted mb-0" style="font-size:0.9rem;">
            Our career counselor will reach you within 30 minutes.
          </p>
        </div>

        {{-- Error alert --}}
        <div id="qeErrorAlert" class="alert alert-danger py-2 mb-2 d-none"
             role="alert" style="font-size:0.85rem;"></div>

        {{-- Form --}}
        <form id="quickEnquiryForm" novalidate>
          @csrf
          <input type="hidden" name="type" value="quick-enquiry">

          {{-- Name + Phone --}}
          <div class="row g-2 mb-2">
            <div class="col-12 col-sm-6">
              <label class="form-label fw-semibold mb-1"
                     style="font-size:0.82rem;">Full Name *</label>
              <input type="text" name="name" id="qeName"
                     class="form-control form-control-sm"
                     placeholder="Your full name" required>
              <div class="invalid-feedback" id="qeNameErr" style="font-size:0.78rem;"></div>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label fw-semibold mb-1"
                     style="font-size:0.82rem;">Phone *</label>
              <input type="tel" name="phone" id="qePhone"
                     class="form-control form-control-sm"
                     placeholder="+91 98765 43210" required>
              <div class="invalid-feedback" id="qePhoneErr" style="font-size:0.78rem;"></div>
            </div>
          </div>

          {{-- Email + Location --}}
          <div class="row g-2 mb-2">
            <div class="col-12 col-sm-6">
              <label class="form-label fw-semibold mb-1"
                     style="font-size:0.82rem;">Email *</label>
              <input type="email" name="email" id="qeEmail"
                     class="form-control form-control-sm"
                     placeholder="name@domain.com" required>
              <div class="invalid-feedback" id="qeEmailErr" style="font-size:0.78rem;"></div>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label fw-semibold mb-1"
                     style="font-size:0.82rem;">City / State *</label>
              <input type="text" name="location" id="qeLocation"
                     class="form-control form-control-sm"
                     placeholder="e.g. Lucknow, UP" required>
              <div class="invalid-feedback" id="qeLocationErr" style="font-size:0.78rem;"></div>
            </div>
          </div>

          {{-- Message --}}
          <div class="mb-3">
            <label class="form-label fw-semibold mb-1" style="font-size:0.82rem;">
              Message <span class="text-muted fw-normal">(optional)</span>
            </label>
            <textarea name="message" id="qeMessage"
                      class="form-control form-control-sm" rows="2"
                      placeholder="Any questions or specific requirements?"></textarea>
          </div>

          {{-- Submit --}}
          <button type="submit" id="qeSubmitBtn"
                  class="btn btn-primary w-100 fw-semibold"
                  style="font-size:0.9rem;">
            <i class="fas fa-paper-plane me-2"></i>Send Enquiry
          </button>
        </form>

      </div>{{-- /.modal-body --}}
    </div>{{-- /.modal-content --}}
  </div>{{-- /.modal-dialog --}}
</div>{{-- /#quickEnquiryModal --}}

<script>
(function () {
  var modalEl   = document.getElementById('quickEnquiryModal');
  if (!modalEl) return;

  var form       = document.getElementById('quickEnquiryForm');
  var submitBtn  = document.getElementById('qeSubmitBtn');
  var successMsg = document.getElementById('qeSuccessMsg');
  var errorAlert = document.getElementById('qeErrorAlert');
  var bsModal    = new bootstrap.Modal(modalEl, { backdrop: true, keyboard: true });

  // Exposed globally so the navbar button and any other CTA can call it
  window.openEnquiryModal = function (courseName) {
    resetModal();
    if (courseName) {
      var ci = document.getElementById('qeCourse');
      if (ci) ci.value = courseName;
    }
    bsModal.show();
  };

  function resetModal() {
    form.classList.remove('d-none');
    successMsg.classList.add('d-none');
    errorAlert.classList.add('d-none');
    form.reset();
    clearErrors();
  }

  function clearErrors() {
    ['qeName','qePhone','qeEmail','qeLocation'].forEach(function(id) {
      var el = document.getElementById(id);
      if (el) el.classList.remove('is-invalid');
    });
    ['qeNameErr','qePhoneErr','qeEmailErr','qeLocationErr'].forEach(function(id) {
      var el = document.getElementById(id);
      if (el) el.textContent = '';
    });
  }

  function showFieldError(fieldId, errId, msg) {
    var f = document.getElementById(fieldId);
    var e = document.getElementById(errId);
    if (f) f.classList.add('is-invalid');
    if (e) e.textContent = msg;
  }

  form.addEventListener('submit', async function (ev) {
    ev.preventDefault();
    clearErrors();
    errorAlert.classList.add('d-none');

    var origHTML = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Sending…';

    try {
      var resp = await fetch('/submit-enquiry', {
        method : 'POST',
        body   : new FormData(form),
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      var data = await resp.json();

      if (resp.ok && data.success) {
        form.classList.add('d-none');
        successMsg.classList.remove('d-none');
        setTimeout(function () { bsModal.hide(); }, 2500);
      } else if (resp.status === 422 && data.errors) {
        var map = {
          name    : ['qeName',     'qeNameErr'],
          phone   : ['qePhone',    'qePhoneErr'],
          email   : ['qeEmail',    'qeEmailErr'],
          location: ['qeLocation', 'qeLocationErr'],
        };
        Object.keys(data.errors).forEach(function(field) {
          if (map[field]) showFieldError(map[field][0], map[field][1], data.errors[field][0]);
        });
        errorAlert.textContent = 'Please fix the errors above.';
        errorAlert.classList.remove('d-none');
      } else {
        errorAlert.textContent = (data && data.message) ? data.message : 'Something went wrong. Please try again.';
        errorAlert.classList.remove('d-none');
      }
    } catch (err) {
      errorAlert.textContent = 'Network error — please check your connection and try again.';
      errorAlert.classList.remove('d-none');
    } finally {
      submitBtn.disabled = false;
      submitBtn.innerHTML = origHTML;
    }
  });

  // Full reset whenever modal closes
  modalEl.addEventListener('hidden.bs.modal', resetModal);
})();
</script>
