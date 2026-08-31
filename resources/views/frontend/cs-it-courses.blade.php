@extends('layouts.app')

@section('title', 'Computer Science & IT Courses | Skill Bridge India Technologies')

@section('content')

<x-page-hero 
    title="{{ $siteSettings['csit_hero_title'] ?? 'Computer Science & IT Programs' }}"
    subtitle="{{ $siteSettings['csit_hero_subtitle'] ?? 'Job-guaranteed training in Fullstack Web Development, Python Django, Data Science, AI, Cloud DevOps, and Ethical Hacking with 100% placement drives.' }}"
    breadcrumbItem="{{ $siteSettings['csit_hero_breadcrumb'] ?? 'CS & IT' }}"
/>

  <!-- CS & IT Specialization Grid -->
  <section class="section-padding">
    <div class="container">
      <div class="section-header">
        <div class="badge-tag"><i class="fas fa-code"></i> {{ $siteSettings['csit_intro_badge'] ?? 'Software Engineering Tracks' }}</div>
        <h2 class="section-title">{{ $siteSettings['csit_intro_title_1'] ?? 'Job-Oriented' }} <span class="highlight">{{ $siteSettings['csit_intro_title_2'] ?? 'CS & IT Courses' }}</span></h2>
        <p class="section-subtitle">{{ $siteSettings['csit_intro_subtitle'] ?? 'Hands-on practical development with live industrial capstone projects and mentor-led technical preparation.' }}</p>
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

                <button class="btn btn-primary" onclick="openEnrollModal('Cyber Security')">Enroll</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  @endsection
