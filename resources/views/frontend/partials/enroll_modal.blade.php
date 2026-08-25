  <div class="modal-overlay" id="enrollModalOverlay">
    <div class="modal-card">
      <button class="modal-close" onclick="closeModal('enrollModalOverlay')"><i class="fas fa-times"></i></button>
      <div class="modal-header" style="background: linear-gradient(135deg, var(--navy-dark), var(--primary));">
        <h3><i class="fas fa-user-graduate"></i> Book Free Counseling & Seat Registration</h3>
      </div>
      <div class="modal-body p-4" style="overflow-y: auto; max-height: calc(90vh - 75px);">
        <form id="enrollForm">
          @csrf
          <input type="hidden" name="type" value="registration">
          
          <div class="form-group mb-3">
            <label class="form-label">Course / Training *</label>
            <input type="text" id="enrollCourseInput" name="course_name" class="form-control" placeholder="Course Name" required readonly>
          </div>

          <div class="form-group mb-3">
            <label class="form-label">Full Name *</label>
            <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
          </div>
          
          <div class="row">
            <div class="col-md-6 form-group mb-3">
              <label class="form-label">Phone Number *</label>
              <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required>
            </div>
            <div class="col-md-6 form-group mb-3">
              <label class="form-label">Email Address *</label>
              <input type="email" name="email" class="form-control" placeholder="name@domain.com" required>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6 form-group mb-3">
              <label class="form-label">State *</label>
              <select name="state" class="form-control" required>
                  <option value="">Select State</option>
                  <option value="Uttar Pradesh">Uttar Pradesh</option>
                  <option value="Madhya Pradesh">Madhya Pradesh</option>
                  <option value="Delhi">Delhi</option>
                  <option value="Haryana">Haryana</option>
                  <option value="Bihar">Bihar</option>
                  <option value="Rajasthan">Rajasthan</option>
                  <option value="Uttarakhand">Uttarakhand</option>
                  <option value="Other">Other</option>
              </select>
            </div>
            <div class="col-md-6 form-group mb-3">
              <label class="form-label">City *</label>
              <input type="text" name="city" class="form-control" placeholder="e.g. Lucknow" required>
            </div>
          </div>

          <div class="form-group mb-3">
            <label class="form-label">College/University & Passing Year *</label>
            <input type="text" name="college" class="form-control" placeholder="e.g. BBD University, 2025" required>
          </div>
          
          <div class="form-group mb-3">
            <label class="form-label">Message / Query (Optional)</label>
            <textarea name="message" class="form-control" rows="2" placeholder="Any specific questions?"></textarea>
          </div>

          <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
            <i class="fas fa-paper-plane"></i> Submit Registration
          </button>
        </form>
      </div>
    </div>
  </div>
