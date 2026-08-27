@extends('layouts.app')

@section('title', 'Core Engineering Training | Skill Bridge India Technologies')

@section('content')

<x-page-hero 
    title="Core Engineering Programs"
    subtitle="Practical industrial training in PLC SCADA, Industrial Automation, MEP, HVAC, Embedded Systems, and Robotics."
    breadcrumbItem="Core Engineering"
/>

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

  @endsection
