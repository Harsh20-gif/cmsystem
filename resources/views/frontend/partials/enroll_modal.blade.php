  <div class="modal-overlay" id="enrollModalOverlay">
    <div class="modal-card">
      <button class="modal-close" onclick="closeModal('enrollModalOverlay')"><i class="fas fa-times"></i></button>
      <div class="modal-header py-2" style="background: linear-gradient(135deg, var(--navy-dark), var(--primary));">
        <h4 class="mb-0 text-white"><i class="fas fa-user-graduate me-2"></i> Contact Us</h4>
      </div>
      <div class="modal-body" style="padding: 1.25rem 1.5rem;">
        
        <!-- Success Message Container (Hidden by Default) -->
        <div id="enrollSuccessMessage" class="text-center py-4" style="display: none;">
            <i class="fas fa-check-circle text-emerald-primary mb-3" style="font-size: 3rem;"></i>
            <h4 class="text-navy-dark fw-bold mb-2">Message Sent!</h4>
            <p class="text-slate-body">Thank you for reaching out. Our career counselor will contact you shortly.</p>
        </div>

        <form id="enrollForm" onsubmit="handleEnrollSubmit(event)">
          @csrf
          <input type="hidden" name="type" value="registration">
          
          <div class="form-group mb-2">
            <label class="form-label" style="font-size: 0.9rem; margin-bottom: 0.2rem;">Course / Training *</label>
            <input type="text" id="enrollCourseInput" name="course_name" class="form-control form-control-sm" placeholder="Course Name" required readonly>
          </div>

          <div class="form-group mb-2">
            <label class="form-label" style="font-size: 0.9rem; margin-bottom: 0.2rem;">Full Name *</label>
            <input type="text" name="name" class="form-control form-control-sm" placeholder="Enter full name" required>
          </div>
          
          <div class="row gx-2">
            <div class="col-12 col-md-6 form-group mb-2">
              <label class="form-label" style="font-size: 0.9rem; margin-bottom: 0.2rem;">Phone Number *</label>
              <input type="tel" name="phone" class="form-control form-control-sm" placeholder="+91 98765 43210" required>
            </div>
            <div class="col-12 col-md-6 form-group mb-2">
              <label class="form-label" style="font-size: 0.9rem; margin-bottom: 0.2rem;">Email Address *</label>
              <input type="email" name="email" class="form-control form-control-sm" placeholder="name@domain.com" required>
            </div>
          </div>
          
          <div class="form-group mb-2">
            <label class="form-label" style="font-size: 0.9rem; margin-bottom: 0.2rem;">Location *</label>
            <input type="text" name="location" class="form-control form-control-sm" placeholder="e.g. Lucknow, Uttar Pradesh" required>
          </div>
          
          <div class="form-group mb-3">
            <label class="form-label" style="font-size: 0.9rem; margin-bottom: 0.2rem;">Message / Query (Optional)</label>
            <textarea name="message" class="form-control form-control-sm" rows="2" placeholder="Any specific questions?"></textarea>
          </div>

          <button type="submit" class="btn btn-primary btn-sm" style="width: 100%; padding: 0.6rem 1rem;">
            <i class="fas fa-paper-plane"></i> Ask
          </button>
        </form>
      </div>
    </div>
  </div>
