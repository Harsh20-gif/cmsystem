<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Computer Science & IT Training Programs at Skill Bridge India Technologies - MERN Fullstack, Django Python, Java, Data Science, AI, Cyber Security, Cloud DevOps, and IoT.">
  <title>Computer Science & IT Courses | Skill Bridge India Technologies</title>
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
        <button class="btn btn-primary" onclick="openEnrollModal('CS/IT Counseling')">
          <i class="fas fa-code"></i> <span class="btn-label">Join CS Track</span>
        </button>
        <div class="mobile-toggle" id="mobileToggle"><i class="fas fa-bars"></i></div>
      </div>
    </div>
  </nav>

  <!-- Page Hero Header -->
  <section class="page-hero">
    <div class="container">
      <h1 class="page-hero-title">Computer Science & IT Programs</h1>
      <p class="page-hero-subtitle">Job-guaranteed training in Fullstack Web Development, Python Django, Data Science,
        AI, Cloud DevOps, and Ethical Hacking with 100% placement drives.</p>
      <div class="breadcrumb-list">
        <a href="{{ route('home') }}">Home</a> <i class="fas fa-chevron-right text-xs"></i> <a
          href="{{ route('courses') }}">Courses</a> <i class="fas fa-chevron-right text-xs"></i>
        <span>CS & IT</span>
      </div>
    </div>
  </section>

  <!-- CS & IT Specialization Grid -->
  <section class="section-padding">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-code"></i> Software Engineering Tracks</div>
        <h2 class="section-title">Job-Oriented <span class="highlight">CS & IT Courses</span></h2>
        <p class="section-subtitle">Hands-on practical development with live industrial capstone projects and mentor-led
          technical preparation.</p>
      </div>

      <div class="courses-grid">
        <!-- Fullstack Web Dev Card -->
        <div class="course-card">
          <div class="course-thumbnail">
            <img src="{{ asset('frontend/assets/webdev.jpg') }}" alt="MERN & Next.js Full Stack Development">
            <span class="course-tag job-guaranteed">Job-Guaranteed</span>
            <span class="course-mode"><i class="fas fa-laptop"></i> Hybrid / Online</span>
          </div>
          <div class="course-body">
            <div class="course-meta">
              <span><i class="far fa-clock"></i> 6 Months</span>
              <span><i class="fas fa-star text-warning"></i> 4.9 (1,240 Reviews)</span>
            </div>
            <h3 class="course-title">Master Full Stack Web Development (MERN & Next.js)</h3>
            <p class="course-desc">Master front-end & back-end development with HTML5, CSS3, JavaScript, React, Node.js,
              Express, and MongoDB. Build 10+ real-world industrial projects.</p>
            <div class="course-tools">
              <span class="tool-chip">React.js</span>
              <span class="tool-chip">Node.js</span>
              <span class="tool-chip">MongoDB</span>
              <span class="tool-chip">Express</span>
              <span class="tool-chip">Next.js</span>
            </div>
            <div class="course-footer">
              <div class="course-price">
                <span class="fee-amount">₹45,000</span>
                <span class="fee-emi">EMI at ₹3,750/mo</span>
              </div>
              <div class="course-actions">
                <button class="btn btn-outline" onclick="openCourseModal('web-dev')">Syllabus</button>
                <button class="btn btn-primary" onclick="openEnrollModal('Full Stack Web Development')">Enroll</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Data Science & AI Card -->
        <div class="course-card">
          <div class="course-thumbnail">
            <img src="{{ asset('frontend/assets/datascience.jpg') }}" alt="Data Science & AI Master Program">
            <span class="course-tag popular">Popular</span>
            <span class="course-mode"><i class="fas fa-chalkboard-teacher"></i> Online / Classroom</span>
          </div>
          <div class="course-body">
            <div class="course-meta">
              <span><i class="far fa-clock"></i> 7 Months</span>
              <span><i class="fas fa-star text-warning"></i> 4.9 (980 Reviews)</span>
            </div>
            <h3 class="course-title">Data Science & Artificial Intelligence Master Program</h3>
            <p class="course-desc">Hands-on training in Python, Statistics, Machine Learning, Deep Learning, Generative
              AI, LLM Fine-Tuning, and Data Visualization with Tableau.</p>
            <div class="course-tools">
              <span class="tool-chip">Python</span>
              <span class="tool-chip">TensorFlow</span>
              <span class="tool-chip">Scikit-Learn</span>
              <span class="tool-chip">Tableau</span>
              <span class="tool-chip">SQL</span>
            </div>
            <div class="course-footer">
              <div class="course-price">
                <span class="fee-amount">₹52,000</span>
                <span class="fee-emi">EMI at ₹4,333/mo</span>
              </div>
              <div class="course-actions">
                <button class="btn btn-outline" onclick="openCourseModal('data-science')">Syllabus</button>
                <button class="btn btn-primary" onclick="openEnrollModal('Data Science & AI')">Enroll</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Cloud & DevOps Card -->
        <div class="course-card">
          <div class="course-thumbnail">
            <img src="{{ asset('frontend/assets/cloud.jpg') }}" alt="Cloud Computing & DevOps Engineer Certification">
            <span class="course-tag job-guaranteed">High Demand</span>
            <span class="course-mode"><i class="fas fa-cloud"></i> Online Live</span>
          </div>
          <div class="course-body">
            <div class="course-meta">
              <span><i class="far fa-clock"></i> 5 Months</span>
              <span><i class="fas fa-star text-warning"></i> 4.8 (850 Reviews)</span>
            </div>
            <h3 class="course-title">Cloud Computing & DevOps Engineer Certification</h3>
            <p class="course-desc">Master AWS Cloud Services, Docker Containerization, Kubernetes Orchestration, Jenkins
              CI/CD, Terraform Infrastructure as Code, and Linux.</p>
            <div class="course-tools">
              <span class="tool-chip">AWS</span>
              <span class="tool-chip">Docker</span>
              <span class="tool-chip">Kubernetes</span>
              <span class="tool-chip">Terraform</span>
              <span class="tool-chip">Jenkins</span>
            </div>
            <div class="course-footer">
              <div class="course-price">
                <span class="fee-amount">₹48,000</span>
                <span class="fee-emi">EMI at ₹4,000/mo</span>
              </div>
              <div class="course-actions">
                <button class="btn btn-outline" onclick="openCourseModal('cloud-devops')">Syllabus</button>
                <button class="btn btn-primary" onclick="openEnrollModal('Cloud & DevOps Engineer')">Enroll</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Cyber Security Card -->
        <div class="course-card">
          <div class="course-thumbnail">
            <img src="{{ asset('frontend/assets/hero.jpg') }}" alt="Cyber Security & Ethical Hacking">
            <span class="course-tag popular">Industry Certified</span>
            <span class="course-mode"><i class="fas fa-shield-alt"></i> Classroom / Online</span>
          </div>
          <div class="course-body">
            <div class="course-meta">
              <span><i class="far fa-clock"></i> 6 Months</span>
              <span><i class="fas fa-star text-warning"></i> 4.9 (620 Reviews)</span>
            </div>
            <h3 class="course-title">Cyber Security & Ethical Hacking Expert Program</h3>
            <p class="course-desc">Learn penetration testing, network defense, ethical hacking methodologies,
              cryptography, and vulnerability assessment with hands-on cyber labs.</p>
            <div class="course-tools">
              <span class="tool-chip">Kali Linux</span>
              <span class="tool-chip">Wireshark</span>
              <span class="tool-chip">Metasploit</span>
              <span class="tool-chip">Burp Suite</span>
            </div>
            <div class="course-footer">
              <div class="course-price">
                <span class="fee-amount">₹50,000</span>
                <span class="fee-emi">EMI at ₹4,160/mo</span>
              </div>
              <div class="course-actions">
                <button class="btn btn-outline" onclick="openCourseModal('cyber-security')">Syllabus</button>
                <button class="btn btn-primary" onclick="openEnrollModal('Cyber Security')">Enroll</button>
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