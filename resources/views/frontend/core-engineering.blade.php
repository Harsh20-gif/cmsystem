<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Core Engineering Training Programs at Skill Bridge India Technologies - Industrial Automation, PLC SCADA, MEP, HVAC, Embedded Systems, IoT, Robotics, VLSI, Revit & AutoCad 2D/3D.">
  <title>Core Engineering Courses (EE, ME, EC, Civil) | Skill Bridge India Technologies</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('frontend/styles.css') }}">
</head>

<body>

  <!-- Top Bar -->
  <div class="top-bar">
    <div class="container top-bar-content">
      <div class="top-info">
        <div class="top-info-item"><i class="fas fa-phone-alt" style="color: #0ea5e9;"></i> <span>Helpline: <strong>+91 96492 40944</strong></span></div>
        <div class="top-info-item"><i class="fas fa-envelope" style="color: #0ea5e9;"></i> <span>info@skillbridgeindiatechnologies.com</span></div>
      </div>
      <div class="top-links">
        <a href="{{ route('placements') }}"><i class="fas fa-trophy"></i> Placement Wall</a>
        <a href="{{ route('contact') }}"><i class="fas fa-map-marker-alt"></i> Centers: Lucknow • Noida • Bhopal</a>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="container navbar-container">
      <a href="{{ route('home') }}" class="logo-wrapper">
        <img src="{{ asset('frontend/assets/logo_v1.png') }}" alt="Skill Bridge India Logo" class="logo-img">
      </a>
      <div class="nav-menu" id="navMenu">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
        <div class="nav-dropdown">
          <a href="{{ route('courses') }}" class="nav-link active">Courses <i class="fas fa-chevron-down text-xs"></i></a>
          <div class="dropdown-menu-custom">
            @foreach($courseCategories as $category)
            <a href="{{ route('courses') }}?category={{ $category->slug }}" class="dropdown-item-custom">
              @if($category->icon && \Illuminate\Support\Str::contains($category->icon, ['/', '.png', '.jpg', '.jpeg', '.svg', '.webp']))
              <img src="{{ \Illuminate\Support\Facades\Storage::url($category->icon) }}" alt="" style="width: 16px; height: 16px; object-fit: contain; display: inline-block; vertical-align: middle; margin-right: 0.2rem;">
            @else
              <i class="{{ $category->icon ?? 'fas fa-book' }}"></i>
            @endif {{ $category->name }}
            </a>
            @endforeach
          </div>
        </div>
        <a href="{{ route('corporate-training') }}" class="nav-link">Trainings</a>
        <a href="{{ route('placements') }}" class="nav-link">Placements</a>
        <a href="{{ route('gallery') }}" class="nav-link">Gallery</a>
        <div class="nav-dropdown">
          <a href="{{ route('about') }}" class="nav-link">About Us <i class="fas fa-chevron-down text-xs"></i></a>
          <div class="dropdown-menu-custom">
            <a href="{{ route('about') }}" class="dropdown-item-custom"><i class="fas fa-building"></i> About Our
              Institute</a>
            <a href="about.html#team" class="dropdown-item-custom"><i class="fas fa-users-gear"></i> Leadership Team</a>
            <a href="about.html#infra" class="dropdown-item-custom"><i class="fas fa-microchip"></i> Lab
              Infrastructure</a>
          </div>
        </div>
        <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
      </div>
      <div class="nav-actions">
        <button class="btn btn-primary" onclick="openEnrollModal('Core Engineering Counseling')">
          <i class="fas fa-cogs"></i> <span class="btn-label">Join Core Track</span>
        </button>
        <div class="mobile-toggle" id="mobileToggle"><i class="fas fa-bars"></i></div>
      </div>
    </div>
  </nav>

  <!-- Page Hero Header -->
  <section class="page-hero">
    <div class="container">
      <h1 class="page-hero-title">Core Engineering Programs</h1>
      <p class="page-hero-subtitle">Hands-on practical hardware & software training for Electrical, Mechanical,
        Electronics, and Civil engineering branches aligned with Industry 4.0 standards.</p>
      <div class="breadcrumb-list">
        <a href="{{ route('home') }}">Home</a> <i class="fas fa-chevron-right text-xs"></i> <a
          href="{{ route('courses') }}">Courses</a> <i class="fas fa-chevron-right text-xs"></i>
        <span>Core Engineering</span>
      </div>
    </div>
  </section>

  <!-- Electrical Engineering Section -->
  <section class="section-padding" id="electrical">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag coral-tag"><i class="fas fa-bolt"></i> Electrical Branch</div>
        <h2 class="section-title">Industrial Automation & <span class="highlight">PLC SCADA</span></h2>
        <p class="section-subtitle">Practical Siemens, Allen Bradley, SCADA, Panel Designing, and Building Management
          Systems (BMS).</p>
      </div>

      <div class="courses-grid">
        <div class="course-card">
          <div class="course-thumbnail">
            <img src="{{ asset('frontend/assets/datascience.jpg') }}" alt="Industrial Automation PLC SCADA">
            <span class="course-tag job-guaranteed">Job Track</span>
            <span class="course-mode"><i class="fas fa-industry"></i> Practical Hardware Lab</span>
          </div>
          <div class="course-body">
            <div class="course-meta">
              <span><i class="far fa-clock"></i> 5 Months</span>
              <span><i class="fas fa-star text-warning"></i> 4.9 (840 Reviews)</span>
            </div>
            <h3 class="course-title">Industrial Automation & PLC SCADA Engineering</h3>
            <p class="course-desc">Hands-on PLC programming (Siemens, Delta, Allen Bradley), SCADA HMI interface design,
              VFD drives, sensor calibration, and panel wiring.</p>
            <div class="course-tools">
              <span class="tool-chip">PLC Siemens</span>
              <span class="tool-chip">SCADA</span>
              <span class="tool-chip">HMI</span>
              <span class="tool-chip">Panel Design</span>
            </div>
            <div class="course-footer">
              <div class="course-price"><span class="fee-amount">₹44,000</span><span class="fee-emi">EMI at
                  ₹3,666/mo</span></div>
              <div class="course-actions">
                <button class="btn btn-outline" onclick="openCourseModal('robotics-auto')">Syllabus</button>
                <button class="btn btn-primary"
                  onclick="openEnrollModal('Industrial Automation PLC SCADA')">Enroll</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Mechanical Engineering & MEP/HVAC Section -->
  <section class="section-padding bg-surface" id="mechanical">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-cogs"></i> Mechanical Branch</div>
        <h2 class="section-title">MEP & HVAC Design <span class="highlight">Engineering</span></h2>
        <p class="section-subtitle">Heating, Ventilation, Air Conditioning (HVAC), Plumbing, Firefighting, Revit MEP,
          and AutoCad 3D.</p>
      </div>

      <div class="courses-grid">
        <div class="course-card">
          <div class="course-thumbnail">
            <img src="{{ asset('frontend/assets/hero.jpg') }}" alt="MEP HVAC Design Engineering">
            <span class="course-tag popular">High Demand</span>
            <span class="course-mode"><i class="fas fa-building-gear"></i> Classroom / Lab</span>
          </div>
          <div class="course-body">
            <div class="course-meta">
              <span><i class="far fa-clock"></i> 4 Months</span>
              <span><i class="fas fa-star text-warning"></i> 4.8 (760 Reviews)</span>
            </div>
            <h3 class="course-title">MEP (HVAC, Electrical, Plumbing) Design Master</h3>
            <p class="course-desc">Complete duct design, heat load calculation, chiller plant layout, firefighting
              piping, and Revit MEP 3D modeling for infrastructure projects.</p>
            <div class="course-tools">
              <span class="tool-chip">HVAC Design</span>
              <span class="tool-chip">Revit MEP</span>
              <span class="tool-chip">Plumbing</span>
              <span class="tool-chip">Firefighting</span>
            </div>
            <div class="course-footer">
              <div class="course-price"><span class="fee-amount">₹42,000</span><span class="fee-emi">EMI at
                  ₹3,500/mo</span></div>
              <div class="course-actions">
                <button class="btn btn-outline" onclick="openCourseModal('robotics-auto')">Syllabus</button>
                <button class="btn btn-primary" onclick="openEnrollModal('MEP & HVAC Design')">Enroll</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Electronics Engineering Section -->
  <section class="section-padding" id="electronics">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag coral-tag"><i class="fas fa-microchip"></i> Electronics Branch</div>
        <h2 class="section-title">Embedded Systems, <span class="highlight">IoT & Robotics</span></h2>
        <p class="section-subtitle">Microcontrollers, ARM, Raspberry Pi, PCB Design, VLSI, and Internet of Things (IoT).
        </p>
      </div>

      <div class="courses-grid">
        <div class="course-card">
          <div class="course-thumbnail">
            <img src="{{ asset('frontend/assets/cloud.jpg') }}" alt="Embedded Systems & IoT">
            <span class="course-tag job-guaranteed">Job Track</span>
            <span class="course-mode"><i class="fas fa-microchip"></i> Hardware Lab</span>
          </div>
          <div class="course-body">
            <div class="course-meta">
              <span><i class="far fa-clock"></i> 5 Months</span>
              <span><i class="fas fa-star text-warning"></i> 4.9 (690 Reviews)</span>
            </div>
            <h3 class="course-title">Embedded Systems & Internet of Things (IoT)</h3>
            <p class="course-desc">Embedded C, ARM Cortex, ESP32, PCB Layout Design (Altium/KiCad), Sensor Protocols
              (I2C, SPI, UART), and Cloud IoT Gateways.</p>
            <div class="course-tools">
              <span class="tool-chip">Embedded C</span>
              <span class="tool-chip">ARM</span>
              <span class="tool-chip">PCB Design</span>
              <span class="tool-chip">IoT ESP32</span>
            </div>
            <div class="course-footer">
              <div class="course-price"><span class="fee-amount">₹46,000</span><span class="fee-emi">EMI at
                  ₹3,833/mo</span></div>
              <div class="course-actions">
                <button class="btn btn-outline" onclick="openCourseModal('robotics-auto')">Syllabus</button>
                <button class="btn btn-primary" onclick="openEnrollModal('Embedded Systems & IoT')">Enroll</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Civil Engineering Section -->
  <section class="section-padding bg-surface" id="civil">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-drafting-compass"></i> Civil Branch</div>
        <h2 class="section-title">AutoCad, Revit & <span class="highlight">Civil 3D Design</span></h2>
        <p class="section-subtitle">Structural engineering software, 3DS Max architectural modeling, and Civil 3D
          highway layout design.</p>
      </div>

      <div class="courses-grid">
        <div class="course-card">
          <div class="course-thumbnail">
            <img src="{{ asset('frontend/assets/webdev.jpg') }}" alt="Civil Engineering AutoCad & Revit">
            <span class="course-tag popular">Certified</span>
            <span class="course-mode"><i class="fas fa-drafting-compass"></i> Software Lab</span>
          </div>
          <div class="course-body">
            <div class="course-meta">
              <span><i class="far fa-clock"></i> 4 Months</span>
              <span><i class="fas fa-star text-warning"></i> 4.8 (510 Reviews)</span>
            </div>
            <h3 class="course-title">Civil AutoCad 2D/3D, Revit Architecture & Civil 3D</h3>
            <p class="course-desc">Building layout planning, 3D structural elevation, BIM modeling in Revit
              Architecture, Estimation, and Civil 3D road design.</p>
            <div class="course-tools">
              <span class="tool-chip">AutoCad 2D/3D</span>
              <span class="tool-chip">Revit Architecture</span>
              <span class="tool-chip">3DS Max</span>
              <span class="tool-chip">Civil 3D</span>
            </div>
            <div class="course-footer">
              <div class="course-price"><span class="fee-amount">₹38,000</span><span class="fee-emi">EMI at
                  ₹3,166/mo</span></div>
              <div class="course-actions">
                <button class="btn btn-outline" onclick="openCourseModal('robotics-auto')">Syllabus</button>
                <button class="btn btn-primary" onclick="openEnrollModal('Civil Design Revit')">Enroll</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modals -->
  <div class="modal-overlay" id="courseModalOverlay">
    <div class="modal-card">
      <button class="modal-close" onclick="closeModal('courseModalOverlay')"><i class="fas fa-times"></i></button>
      <div class="modal-header">
        <h3 id="courseModalTitle">Course Details</h3>
      </div>
      <div class="modal-body" id="courseModalBody"></div>
    </div>
  </div>

    @include('frontend.partials.enroll_modal')

  <div class="toast-notification" id="toastNotification">
    <i class="fas fa-check-circle heading-md text-accent-cyan"></i>
    <span id="toastText">Action successful!</span>
  </div>

  <!-- Footer -->
  @include('frontend.partials.footer')

  <script src="{{ asset('frontend/script.js') }}"></script>
</body>

</html>