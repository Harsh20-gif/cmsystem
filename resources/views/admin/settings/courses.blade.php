@extends('layouts.admin')

@section('title', 'Courses Page Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><i class="fas fa-graduation-cap text-primary me-2"></i> Courses Page Settings</h2>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <ul class="nav nav-tabs border-bottom" id="coursesSettingsTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active text-dark fw-bold" id="all-courses-tab" data-bs-toggle="tab" href="#all-courses" role="tab">All Courses Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark fw-bold" id="cs-it-tab" data-bs-toggle="tab" href="#cs-it" role="tab">CS/IT Landing Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark fw-bold" id="core-eng-tab" data-bs-toggle="tab" href="#core-eng" role="tab">Core Engineering Page</a>
            </li>
        </ul>
    </div>
    
    <div class="card-body p-4">
        <form action="{{ route('admin.settings.courses.update') }}" method="POST">
            @csrf
            
            <div class="tab-content" id="coursesSettingsTabContent">
                
                <!-- All Courses Tab -->
                <div class="tab-pane fade show active" id="all-courses" role="tabpanel">
                    <h5 class="fw-bold mb-3 text-primary">Hero Banner Section</h5>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero Title</label>
                        <input type="text" name="courses_hero_title" class="form-control" value="{{ $settings['courses_hero_title'] ?? 'All Training Programs' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero Subtitle</label>
                        <textarea name="courses_hero_subtitle" class="form-control" rows="2">{{ $settings['courses_hero_subtitle'] ?? 'Comprehensive BTech-aligned industrial training programs with placement assistance across all engineering streams.' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Breadcrumb Text</label>
                        <input type="text" name="courses_hero_breadcrumb" class="form-control" value="{{ $settings['courses_hero_breadcrumb'] ?? 'Course Catalog' }}">
                    </div>

                    <hr class="my-4">
                    <h5 class="fw-bold mb-3 text-primary">Filter & Search Section</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">'All Programs' Filter Button Label</label>
                            <input type="text" name="courses_filter_all_label" class="form-control" value="{{ $settings['courses_filter_all_label'] ?? 'All Programs' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Search Input Placeholder</label>
                            <input type="text" name="courses_search_placeholder" class="form-control" value="{{ $settings['courses_search_placeholder'] ?? 'Search any program (e.g. Python, PLC SCADA, MERN)...' }}">
                        </div>
                    </div>
                </div>

                <!-- CS/IT Tab -->
                <div class="tab-pane fade" id="cs-it" role="tabpanel">
                    <h5 class="fw-bold mb-3 text-primary">Hero Banner Section</h5>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero Title</label>
                        <input type="text" name="csit_hero_title" class="form-control" value="{{ $settings['csit_hero_title'] ?? 'Computer Science & IT Programs' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero Subtitle</label>
                        <textarea name="csit_hero_subtitle" class="form-control" rows="2">{{ $settings['csit_hero_subtitle'] ?? 'Job-guaranteed training in Fullstack Web Development, Python Django, Data Science, AI, Cloud DevOps, and Ethical Hacking with 100% placement drives.' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Breadcrumb Text</label>
                        <input type="text" name="csit_hero_breadcrumb" class="form-control" value="{{ $settings['csit_hero_breadcrumb'] ?? 'CS & IT' }}">
                    </div>

                    <hr class="my-4">
                    <h5 class="fw-bold mb-3 text-primary">Intro Section Header</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Badge Tag</label>
                            <input type="text" name="csit_intro_badge" class="form-control" value="{{ $settings['csit_intro_badge'] ?? 'Software Engineering Tracks' }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Title (Part 1)</label>
                            <input type="text" name="csit_intro_title_1" class="form-control" value="{{ $settings['csit_intro_title_1'] ?? 'Job-Oriented' }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Title Highlight (Part 2)</label>
                            <input type="text" name="csit_intro_title_2" class="form-control" value="{{ $settings['csit_intro_title_2'] ?? 'CS & IT Courses' }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Subtitle</label>
                        <textarea name="csit_intro_subtitle" class="form-control" rows="2">{{ $settings['csit_intro_subtitle'] ?? 'Hands-on practical development with live industrial capstone projects and mentor-led technical preparation.' }}</textarea>
                    </div>
                </div>

                <!-- Core Engineering Tab -->
                <div class="tab-pane fade" id="core-eng" role="tabpanel">
                    <h5 class="fw-bold mb-3 text-primary">Hero Banner Section</h5>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero Title</label>
                        <input type="text" name="core_hero_title" class="form-control" value="{{ $settings['core_hero_title'] ?? 'Core Engineering Programs' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Hero Subtitle</label>
                        <textarea name="core_hero_subtitle" class="form-control" rows="2">{{ $settings['core_hero_subtitle'] ?? 'Practical industrial training in PLC SCADA, Industrial Automation, MEP, HVAC, Embedded Systems, and Robotics.' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Breadcrumb Text</label>
                        <input type="text" name="core_hero_breadcrumb" class="form-control" value="{{ $settings['core_hero_breadcrumb'] ?? 'Core Engineering' }}">
                    </div>

                    <hr class="my-4">
                    <h5 class="fw-bold mb-3 text-primary">Electrical Branch Section</h5>
                    <div class="row">
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Badge Tag</label><input type="text" name="core_elec_badge" class="form-control" value="{{ $settings['core_elec_badge'] ?? 'Electrical Branch' }}"></div>
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Title (Part 1)</label><input type="text" name="core_elec_title_1" class="form-control" value="{{ $settings['core_elec_title_1'] ?? 'Industrial Automation &' }}"></div>
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Title (Part 2)</label><input type="text" name="core_elec_title_2" class="form-control" value="{{ $settings['core_elec_title_2'] ?? 'PLC SCADA' }}"></div>
                        <div class="col-md-12 mb-3"><label class="form-label fw-bold">Subtitle</label><input type="text" name="core_elec_subtitle" class="form-control" value="{{ $settings['core_elec_subtitle'] ?? 'Practical Siemens, Allen Bradley, SCADA, Panel Designing, and Building Management Systems (BMS).' }}"></div>
                    </div>

                    <hr class="my-4">
                    <h5 class="fw-bold mb-3 text-primary">Mechanical Branch Section</h5>
                    <div class="row">
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Badge Tag</label><input type="text" name="core_mech_badge" class="form-control" value="{{ $settings['core_mech_badge'] ?? 'Mechanical Branch' }}"></div>
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Title (Part 1)</label><input type="text" name="core_mech_title_1" class="form-control" value="{{ $settings['core_mech_title_1'] ?? 'MEP & HVAC Design' }}"></div>
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Title (Part 2)</label><input type="text" name="core_mech_title_2" class="form-control" value="{{ $settings['core_mech_title_2'] ?? 'Engineering' }}"></div>
                        <div class="col-md-12 mb-3"><label class="form-label fw-bold">Subtitle</label><input type="text" name="core_mech_subtitle" class="form-control" value="{{ $settings['core_mech_subtitle'] ?? 'Heating, Ventilation, Air Conditioning (HVAC), Plumbing, Firefighting, Revit MEP, and AutoCad 3D.' }}"></div>
                    </div>

                    <hr class="my-4">
                    <h5 class="fw-bold mb-3 text-primary">Electronics Branch Section</h5>
                    <div class="row">
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Badge Tag</label><input type="text" name="core_ec_badge" class="form-control" value="{{ $settings['core_ec_badge'] ?? 'Electronics Branch' }}"></div>
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Title (Part 1)</label><input type="text" name="core_ec_title_1" class="form-control" value="{{ $settings['core_ec_title_1'] ?? 'Embedded Systems,' }}"></div>
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Title (Part 2)</label><input type="text" name="core_ec_title_2" class="form-control" value="{{ $settings['core_ec_title_2'] ?? 'IoT & Robotics' }}"></div>
                        <div class="col-md-12 mb-3"><label class="form-label fw-bold">Subtitle</label><input type="text" name="core_ec_subtitle" class="form-control" value="{{ $settings['core_ec_subtitle'] ?? 'Microcontrollers, ARM, Raspberry Pi, PCB Design, VLSI, and Internet of Things (IoT).' }}"></div>
                    </div>

                    <hr class="my-4">
                    <h5 class="fw-bold mb-3 text-primary">Civil Branch Section</h5>
                    <div class="row">
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Badge Tag</label><input type="text" name="core_civil_badge" class="form-control" value="{{ $settings['core_civil_badge'] ?? 'Civil Branch' }}"></div>
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Title (Part 1)</label><input type="text" name="core_civil_title_1" class="form-control" value="{{ $settings['core_civil_title_1'] ?? 'AutoCad, Revit &' }}"></div>
                        <div class="col-md-3 mb-3"><label class="form-label fw-bold">Title (Part 2)</label><input type="text" name="core_civil_title_2" class="form-control" value="{{ $settings['core_civil_title_2'] ?? 'Civil 3D Design' }}"></div>
                        <div class="col-md-12 mb-3"><label class="form-label fw-bold">Subtitle</label><input type="text" name="core_civil_subtitle" class="form-control" value="{{ $settings['core_civil_subtitle'] ?? 'Structural engineering software, 3DS Max architectural modeling, and Civil 3D highway layout design.' }}"></div>
                    </div>
                </div>

            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold"><i class="fas fa-save me-2"></i> Save Course Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
