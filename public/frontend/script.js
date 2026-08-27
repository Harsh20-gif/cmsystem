/* ==========================================================================
   Skill Bridge India Technologies - Interactive JavaScript Application
   ========================================================================== */

// Course Database
const coursesData = window.coursesData || [
  {
    id: "web-dev",
    category: "webdev",
    tag: "Job-Guaranteed",
    tagClass: "job-guaranteed",
    mode: "Hybrid / Online",
    title: "Master Full Stack Web Development (MERN & Next.js)",
    desc: "Master front-end & back-end development with HTML5, CSS3, JavaScript, React, Node.js, Express, and MongoDB. Build 10+ real-world industrial projects.",
    duration: "6 Months",
    projects: "12+ Live Projects",
    rating: "4.9 (1,240 Reviews)",
    tools: ["HTML5", "CSS3", "JavaScript", "React.js", "Node.js", "MongoDB"],
    fee: "₹45,000",
    emi: "EMI starts at ₹3,750/mo",
    image: "assets/webdev.jpg",
    syllabus: [
      "Module 1: Web Fundamentals (HTML5, CSS3, Flexbox, Grid, Responsive Design)",
      "Module 2: Advanced JavaScript (ES6+, DOM Manipulation, Async/Await, APIs)",
      "Module 3: Front-End Mastery (React.js, Redux Toolkit, Tailwind CSS, Next.js)",
      "Module 4: Back-End Architecture (Node.js, Express REST APIs, JWT Auth)",
      "Module 5: Database & Deployment (MongoDB, SQL, AWS EC2, Vercel, CI/CD Pipeline)",
      "Module 6: Capstone Project & Mock Technical Interview Prep"
    ]
  },
  {
    id: "data-science",
    category: "datascience",
    tag: "Popular",
    tagClass: "popular",
    mode: "Online / Classroom",
    title: "Data Science & Artificial Intelligence Master Program",
    desc: "Comprehensive hands-on training in Python programming, Statistics, Machine Learning algorithms, Deep Learning, NLP, and Data Visualization with Tableau.",
    duration: "7 Months",
    projects: "15+ AI Projects",
    rating: "4.9 (980 Reviews)",
    tools: ["Python", "Pandas", "Scikit-Learn", "TensorFlow", "Tableau", "SQL"],
    fee: "₹52,000",
    emi: "EMI starts at ₹4,333/mo",
    image: "assets/datascience.jpg",
    syllabus: [
      "Module 1: Python Programming & Data Structures",
      "Module 2: Exploratory Data Analysis & Statistics with NumPy & Pandas",
      "Module 3: Supervised & Unsupervised Machine Learning Algorithms",
      "Module 4: Deep Learning with Neural Networks & TensorFlow",
      "Module 5: Business Intelligence with SQL & Tableau Dashboards",
      "Module 6: Generative AI & Large Language Model (LLM) Fine-Tuning"
    ]
  },
  {
    id: "cloud-devops",
    category: "cloud",
    tag: "High Demand",
    tagClass: "job-guaranteed",
    mode: "Online Live",
    title: "Cloud Computing & DevOps Engineer Certification",
    desc: "Become an industry-certified Cloud & DevOps Architect. Master AWS Cloud Services, Docker Containerization, Kubernetes Orchestration, CI/CD, and Terraform.",
    duration: "5 Months",
    projects: "8 Cloud Infrastructure Labs",
    rating: "4.8 (850 Reviews)",
    tools: ["AWS", "Docker", "Kubernetes", "Jenkins", "Terraform", "Linux"],
    fee: "₹48,000",
    emi: "EMI starts at ₹4,000/mo",
    image: "assets/cloud.jpg",
    syllabus: [
      "Module 1: Linux System Administration & Shell Scripting",
      "Module 2: AWS Core Services (EC2, S3, VPC, IAM, RDS, Lambda)",
      "Module 3: Version Control & CI/CD Pipelines (Git, GitHub Actions, Jenkins)",
      "Module 4: Containerization & Microservices with Docker",
      "Module 5: Container Orchestration at Scale using Kubernetes (EKS)",
      "Module 6: Infrastructure as Code (IaC) with Terraform & Ansible"
    ]
  },
  {
    id: "cyber-security",
    category: "cyber",
    tag: "Industry Certified",
    tagClass: "popular",
    mode: "Classroom / Online",
    title: "Cyber Security & Ethical Hacking Expert Program",
    desc: "Learn penetration testing, network security defense, ethical hacking methodologies, cryptography, and vulnerability assessment with hands-on cyber labs.",
    duration: "6 Months",
    projects: "10 Ethical Cyber Labs",
    rating: "4.9 (620 Reviews)",
    tools: ["Kali Linux", "Wireshark", "Metasploit", "Burp Suite", "Nmap", "Python"],
    fee: "₹50,000",
    emi: "EMI starts at ₹4,160/mo",
    image: "assets/hero.jpg",
    syllabus: [
      "Module 1: Computer Networking Protocols & Linux Fundamentals",
      "Module 2: Footprinting, Reconnaissance & Network Scanning",
      "Module 3: Web Application Vulnerability Assessment (OWASP Top 10)",
      "Module 4: System Hacking, Exploitation & Privilege Escalation",
      "Module 5: Wireless Network Security & Cryptography Standards",
      "Module 6: Incident Response, Forensics & CEH Exam Preparation"
    ]
  },
  {
    id: "robotics-auto",
    category: "robotics",
    tag: "Skilling Partner",
    tagClass: "job-guaranteed",
    mode: "Classroom Hands-on Lab",
    title: "Industrial Automation & Robotics Engineering",
    desc: "Hands-on industrial robotics, PLC programming, SCADA systems, IoT sensors, and automated manufacturing skilling tailored for Industry 4.0 standards.",
    duration: "4 Months",
    projects: "6 Hardware Robotic Labs",
    rating: "4.8 (430 Reviews)",
    tools: ["PLC Siemens", "SCADA", "Microcontrollers", "Arduino", "CAD", "Robotics"],
    fee: "₹42,000",
    emi: "EMI starts at ₹3,500/mo",
    image: "assets/hero.jpg",
    syllabus: [
      "Module 1: Electrical Electronics & Sensor Technology Fundamentals",
      "Module 2: Programmable Logic Controller (PLC) Ladder Logic Programming",
      "Module 3: SCADA Systems & Human-Machine Interfaces (HMI)",
      "Module 4: Robotic Arm Control, Kinematics & Pneumatic Drives",
      "Module 5: Industrial IoT (IIoT) & Factory Automation Integration",
      "Module 6: Industrial Project Setup & Safety Protocols"
    ]
  },
  {
    id: "ui-ux",
    category: "webdev",
    tag: "Creative Tech",
    tagClass: "popular",
    mode: "Online / Hybrid",
    title: "UI/UX & Product Design Professional Course",
    desc: "Transform into a User Experience Designer. Learn wireframing, interactive prototyping, user research methodologies, design systems, and Figma mastery.",
    duration: "4 Months",
    projects: "5 Design Portfolios",
    rating: "4.9 (710 Reviews)",
    tools: ["Figma", "Adobe XD", "Miro", "Prototyping", "User Research"],
    fee: "₹38,000",
    emi: "EMI starts at ₹3,166/mo",
    image: "assets/webdev.jpg",
    syllabus: [
      "Module 1: Foundations of User-Centered Design & Design Thinking",
      "Module 2: User Research, Persona Mapping & Information Architecture",
      "Module 3: Wireframing & High-Fidelity UI Design in Figma",
      "Module 4: Micro-Interactions, Animation & Component Design Systems",
      "Module 5: Usability Testing, Feedback Iterations & Client Handoff",
      "Module 6: Portfolio Development & Design Pitch Presentation"
    ]
  }
];

// Quiz Decision Matrix
let currentQuizStep = 1;
let userQuizAnswers = {};

document.addEventListener("DOMContentLoaded", () => {
  renderCourses(coursesData);
  setupFilterButtons();
  setupLiveSearch();
  setupFAQAccordion();
  setupMobileNav();
  initStatsCounter();

  // Check URL for category parameter
  const urlParams = new URLSearchParams(window.location.search);
  const categoryParam = urlParams.get('category');
  if (categoryParam) {
    const filterBtn = document.querySelector(`.filter-btn[data-filter="${categoryParam}"]`);
    if (filterBtn) {
      filterBtn.click();
    }
  }
});

// Render Course Cards
function renderCourses(courses) {
  const container = document.getElementById("coursesContainer");
  if (!container) return;

  if (courses.length === 0) {
    container.innerHTML = `
      <div style="grid-column: 1/-1; text-align: center; padding: 3rem;">
        <i class="fas fa-search" style="font-size: 3rem; color: var(--slate-muted); margin-bottom: 1rem;"></i>
        <h3 style="color: var(--navy-dark);">No courses found</h3>
        <p style="color: var(--slate-muted);">Try searching for a different course keyword or category.</p>
      </div>
    `;
    return;
  }

  container.innerHTML = courses.map(course => `
    <div class="course-card" data-category="${course.category}">
      <div class="course-thumbnail">
        <img src="${course.image}" alt="${course.title}" loading="lazy">
        <span class="course-tag ${course.tagClass}">${course.tag}</span>
        <span class="course-mode"><i class="fas fa-chalkboard-teacher"></i> ${course.mode}</span>
      </div>
      <div class="course-body">
        <div class="course-meta">
          <span><i class="far fa-clock"></i> ${course.duration}</span>
          <span><i class="fas fa-star" style="color: #FFB800;"></i> ${course.rating}</span>
        </div>
        <h3 class="course-title">${course.title}</h3>
        <p class="course-desc">${course.desc}</p>
        <div class="course-tools">
          ${course.tools.map(tool => `<span class="tool-chip">${tool}</span>`).join('')}
        </div>
        <div class="course-footer">
          <div class="course-price">
            <span class="fee-amount">${course.fee}</span>
            <span class="fee-emi">${course.emi}</span>
          </div>
          <div class="course-actions">

            <button class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.85rem;" onclick="openEnrollModal('${course.title}')">
              Enroll
            </button>
          </div>
        </div>
      </div>
    </div>
  `).join('');
}

// Category Filter Tabs
function setupFilterButtons() {
  const filterBtns = document.querySelectorAll(".filter-btn");
  filterBtns.forEach(btn => {
    btn.addEventListener("click", () => {
      filterBtns.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");
      const category = btn.getAttribute("data-filter");

      if (category === "all") {
        renderCourses(coursesData);
      } else {
        const filtered = coursesData.filter(c => c.category === category);
        renderCourses(filtered);
      }
    });
  });
}

// Live Search Filter
function setupLiveSearch() {
  const searchInput = document.getElementById("courseSearchInput");
  if (!searchInput) return;

  searchInput.addEventListener("input", (e) => {
    const query = e.target.value.toLowerCase().trim();
    const filtered = coursesData.filter(c =>
      c.title.toLowerCase().includes(query) ||
      c.desc.toLowerCase().includes(query) ||
      c.tools.some(t => t.toLowerCase().includes(query))
    );
    renderCourses(filtered);
  });
}

// Course Detail Modal
function openCourseModal(courseId) {
  const course = coursesData.find(c => c.id === courseId);
  if (!course) return;

  const modalOverlay = document.getElementById("courseModalOverlay");
  const modalBody = document.getElementById("courseModalBody");
  const modalTitle = document.getElementById("courseModalTitle");

  modalTitle.textContent = course.title;
  modalBody.innerHTML = `
    <div style="margin-bottom: 1.5rem;">
      <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1rem; font-size: 0.9rem; font-weight: 600;">
        <span style="color: var(--accent-coral);"><i class="fas fa-award"></i> ${course.tag}</span>
        <span style="color: var(--navy-primary);"><i class="far fa-clock"></i> Duration: ${course.duration}</span>
        <span style="color: var(--accent-cyan-dark);"><i class="fas fa-briefcase"></i> ${course.projects}</span>
      </div>
      <p style="font-size: 1rem; color: var(--slate-body); line-height: 1.6;">${course.desc}</p>
    </div>

    <div style="margin-bottom: 2rem;">
      <h4 style="font-size: 1.2rem; color: var(--navy-dark); margin-bottom: 1rem;">Course Curriculum & Syllabus:</h4>
      <div style="display: flex; flex-direction: column; gap: 0.6rem;">
        ${course.syllabus.map(item => `
          <div style="background: var(--bg-surface); padding: 0.9rem 1.2rem; border-radius: var(--radius-md); border-left: 4px solid var(--accent-coral); font-weight: 600; font-size: 0.95rem; color: var(--navy-dark);">
            <i class="fas fa-check-circle" style="color: var(--accent-cyan-dark); margin-right: 0.5rem;"></i> ${item}
          </div>
        `).join('')}
      </div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; background: var(--navy-glow); padding: 1.5rem; border-radius: var(--radius-md); flex-wrap: wrap; gap: 1rem;">
      <div>
        <div style="font-size: 1.5rem; font-weight: 800; color: var(--navy-dark);">${course.fee}</div>
        <div style="font-size: 0.85rem; color: var(--emerald-primary); font-weight: 700;">${course.emi}</div>
      </div>
      <div style="display: flex; gap: 1rem;">
        <button class="btn btn-outline" onclick="triggerToast('Brochure download started!')">
          <i class="fas fa-file-pdf"></i> Download Syllabus
        </button>
        <button class="btn btn-primary" onclick="closeModal('courseModalOverlay'); openEnrollModal('${course.title}')">
          Book Free Seat
        </button>
      </div>
    </div>
  `;

  modalOverlay.classList.add("active");
}

// Generic Enrollment Modal — now delegates to the new Bootstrap 5 Quick Enquiry modal.
// Kept for backward compatibility with call sites on course cards, quiz, gallery, etc.
function openEnrollModal(courseName) {
  if (typeof window.openEnquiryModal === 'function') {
    window.openEnquiryModal(courseName || 'Free Career Demo');
  }
}

function closeModal(modalId) {
  // Legacy custom overlay close (course detail modal still uses the old overlay)
  var modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }
}

// Handle Form Submission
async function handleEnrollSubmit(event) {
  event.preventDefault();

  const form = event.target;
  const formData = new FormData(form);
  const submitBtn = form.querySelector('button[type="submit"]');
  const originalBtnText = submitBtn.innerHTML;

  try {
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

    const response = await fetch('/submit-enquiry', {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        // Add CSRF token if not included in form, but it is in the form as @csrf
      }
    });

    const result = await response.json();

    if (response.ok) {
      // Hide form and show success message inside modal
      form.style.display = 'none';
      const successMsg = document.getElementById('enrollSuccessMessage');
      if (successMsg) {
        successMsg.style.display = 'block';

        // Auto close and reset after 3 seconds
        setTimeout(() => {
          closeModal("enrollModalOverlay");
          form.reset();
          form.style.display = 'block';
          successMsg.style.display = 'none';
        }, 3000);
      } else {
        // Fallback if element not found
        closeModal("enrollModalOverlay");
        triggerToast(result.message || "Registration Successful!");
        form.reset();
      }
    } else {
      triggerToast("❌ Error: " + (result.message || "Failed to submit. Please try again."));
    }
  } catch (error) {
    console.error('Error submitting form:', error);
    triggerToast("❌ Error: Could not connect to server.");
  } finally {
    submitBtn.disabled = false;
    submitBtn.innerHTML = originalBtnText;
  }
}

// Toast Notification System
function triggerToast(message) {
  const toast = document.getElementById("toastNotification");
  const toastText = document.getElementById("toastText");
  if (!toast || !toastText) return;

  toastText.textContent = message;
  toast.classList.add("show");

  setTimeout(() => {
    toast.classList.remove("show");
  }, 4000);
}

// Interactive Career Quiz Flow
function selectQuizOption(questionKey, answerValue) {
  userQuizAnswers[questionKey] = answerValue;
  const currentStepElem = document.getElementById(`quizStep${currentQuizStep}`);
  if (currentStepElem) currentStepElem.classList.remove("active");

  currentQuizStep++;

  if (currentQuizStep <= 3) {
    const nextStepElem = document.getElementById(`quizStep${currentQuizStep}`);
    if (nextStepElem) nextStepElem.classList.add("active");
  } else {
    // Show Result
    showQuizResult();
  }
}

function showQuizResult() {
  const resultElem = document.getElementById("quizResultStep");
  const titleElem = document.getElementById("quizResultTitle");
  const descElem = document.getElementById("quizResultDesc");
  const actionBtn = document.getElementById("quizResultAction");

  let recommendedCourse = coursesData[0]; // Default Web Dev
  if (userQuizAnswers.goal === "ai") {
    recommendedCourse = coursesData[1]; // Data Science
  } else if (userQuizAnswers.goal === "cloud") {
    recommendedCourse = coursesData[2]; // Cloud DevOps
  } else if (userQuizAnswers.goal === "hardware") {
    recommendedCourse = coursesData[4]; // Robotics
  }

  titleElem.textContent = recommendedCourse.title;
  descElem.textContent = `Based on your interest in ${userQuizAnswers.goal || 'technology'}, this ${recommendedCourse.duration} program with ${recommendedCourse.projects} is your best fit for 100% placement success.`;
  actionBtn.setAttribute("onclick", `openEnrollModal('${recommendedCourse.title}')`);

  resultElem.classList.add("active");
}

function resetQuiz() {
  currentQuizStep = 1;
  userQuizAnswers = {};
  document.querySelectorAll(".quiz-step").forEach(el => el.classList.remove("active"));
  document.getElementById("quizStep1").classList.add("active");
}

// FAQ Accordion Toggle
function setupFAQAccordion() {
  const faqQuestions = document.querySelectorAll(".faq-question");
  faqQuestions.forEach(q => {
    q.addEventListener("click", () => {
      const parent = q.parentElement;
      const isActive = parent.classList.contains("active");

      document.querySelectorAll(".faq-item").forEach(item => item.classList.remove("active"));

      if (!isActive) {
        parent.classList.add("active");
      }
    });
  });
}

// Mobile Nav & Dropdown Toggle
function setupMobileNav() {
  const toggle = document.getElementById("mobileToggle");
  const menu = document.getElementById("navMenu");
  if (!toggle || !menu) return;

  toggle.addEventListener("click", () => {
    menu.classList.toggle("active");
  });

  // Mobile dropdown toggles
  const navDropdowns = document.querySelectorAll(".nav-dropdown");
  navDropdowns.forEach(dropdown => {
    const link = dropdown.querySelector(".nav-link");
    if (link) {
      link.addEventListener("click", (e) => {
        if (window.innerWidth <= 991) {
          e.preventDefault();
          dropdown.classList.toggle("active");
        }
      });
    }
  });
}

// Animated Statistics Counter
function initStatsCounter() {
  const statNumbers = document.querySelectorAll(".stat-number");
  let started = false;

  window.addEventListener("scroll", () => {
    const statsSection = document.getElementById("statsBar");
    if (!statsSection) return;

    const sectionPos = statsSection.getBoundingClientRect().top;
    const screenPos = window.innerHeight;

    if (sectionPos < screenPos && !started) {
      started = true;
      statNumbers.forEach(stat => {
        const target = parseFloat(stat.getAttribute("data-target"));
        const prefix = stat.getAttribute("data-prefix") || "";
        const suffix = stat.getAttribute("data-suffix") || "";
        let count = 0;
        const speed = target / 50;

        const updateCount = () => {
          count += speed;
          if (count < target) {
            stat.innerText = prefix + (target % 1 === 0 ? Math.ceil(count) : count.toFixed(1)) + suffix;
            setTimeout(updateCount, 30);
          } else {
            stat.innerText = prefix + target + suffix;
          }
        };

        updateCount();
      });
    }
  });
}
