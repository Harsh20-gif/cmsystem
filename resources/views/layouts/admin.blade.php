<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Skill Bridge India Technologies Admin')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Micro-Interactions -->
    <link rel="stylesheet" href="{{ asset('micro-interactions.css') }}">
    
    <style>
        /* Sidebar Enhancements */
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1.25rem 1.5rem;
            color: white !important;
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .brand-logo-img {
            max-height: 45px;
            width: auto;
            object-fit: contain;
            background: white; /* Contrast for transparent logo if needed */
            border-radius: 4px;
            padding: 2px;
        }

        .brand-text {
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.2;
            color: var(--accent-orange, #F26522);
        }

        .nav-group-title {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem 0.5rem;
            margin-top: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .nav-group-title:hover {
            color: rgba(255, 255, 255, 0.9);
        }

        .nav-group-title .toggle-icon {
            transition: transform 0.3s ease;
            font-size: 0.8rem;
        }

        .nav-group-title[aria-expanded="true"] .toggle-icon {
            transform: rotate(180deg);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 0.6rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        
        .sub-nav .nav-link {
            padding-left: 3.2rem; /* Indent nested links */
            font-size: 0.95rem;
        }

        .nav-link i.fa-fw {
            width: 20px;
            text-align: center;
        }

        .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: var(--accent-orange, #F26522);
            font-weight: 500;
        }

        .nav-link.active i {
            color: var(--accent-orange, #F26522);
        }
        
        /* Ensure sidebar content stays scrollable without hiding the brand */
        #sidebar {
            display: flex;
            flex-direction: column;
        }
        .sidebar-scrollable {
            overflow-y: auto;
            flex-grow: 1;
            padding-bottom: 2rem;
        }
        
        /* Scrollbar styling for sidebar */
        .sidebar-scrollable::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-scrollable::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-scrollable::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .sidebar-scrollable::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="offcanvas-md offcanvas-start bg-navy" tabindex="-1">
        
        <!-- Updated Branding -->
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <img src="{{ asset('frontend/assets/logo_v1.png') }}" alt="Logo" class="brand-logo-img">
            <span class="brand-text">Skill Bridge<br>Admin</span>
        </a>
        
        <div class="sidebar-scrollable">
            <nav class="nav flex-column mt-2">
                
                <!-- Overview: Single Item -->
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} mt-2">
                    <i class="fas fa-home fa-fw"></i> Dashboard
                </a>

                <!-- Courses Group -->
                @php $isCoursesActive = request()->routeIs('admin.course-categories.*') || request()->routeIs('admin.courses.*'); @endphp
                <a class="nav-group-title" data-bs-toggle="collapse" href="#collapseCourses" role="button" aria-expanded="{{ $isCoursesActive ? 'true' : 'false' }}">
                    <span><i class="fas fa-graduation-cap fa-fw me-2"></i> Courses</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </a>
                <div class="collapse {{ $isCoursesActive ? 'show' : '' }}" id="collapseCourses">
                    <div class="sub-nav">
                        <a href="{{ route('admin.course-categories.index') }}" class="nav-link {{ request()->routeIs('admin.course-categories.*') ? 'active' : '' }}">
                            <i class="fas fa-tags fa-fw"></i> Categories
                        </a>
                        <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                            <i class="fas fa-book-open fa-fw"></i> Course List
                        </a>
                    </div>
                </div>

                <!-- Trainings & Placements Group -->
                @php $isPlacementsActive = request()->routeIs('admin.trainings.*') || request()->routeIs('admin.students.*') || request()->routeIs('admin.companies.*') || request()->routeIs('admin.placements.*'); @endphp
                <a class="nav-group-title" data-bs-toggle="collapse" href="#collapsePlacements" role="button" aria-expanded="{{ $isPlacementsActive ? 'true' : 'false' }}">
                    <span><i class="fas fa-briefcase fa-fw me-2"></i> Careers</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </a>
                <div class="collapse {{ $isPlacementsActive ? 'show' : '' }}" id="collapsePlacements">
                    <div class="sub-nav">
                        <a href="{{ route('admin.trainings.index') }}" class="nav-link {{ request()->routeIs('admin.trainings.*') ? 'active' : '' }}">
                            <i class="fas fa-chalkboard-teacher fa-fw"></i> Trainings
                        </a>
                        <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate fa-fw"></i> Students
                        </a>
                        <a href="{{ route('admin.companies.index') }}" class="nav-link {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">
                            <i class="fas fa-building fa-fw"></i> Companies
                        </a>
                        <a href="{{ route('admin.placements.index') }}" class="nav-link {{ request()->routeIs('admin.placements.*') ? 'active' : '' }}">
                            <i class="fas fa-award fa-fw"></i> Placements
                        </a>
                    </div>
                </div>

                <!-- Content & Media Group -->
                @php $isContentActive = request()->routeIs('admin.sliders.*') || request()->routeIs('admin.notices.*') || request()->routeIs('admin.gallery-albums.*') || request()->is('admin/pages*') || request()->routeIs('admin.team-members.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.branches.*') || request()->routeIs('admin.media.*'); @endphp
                <a class="nav-group-title" data-bs-toggle="collapse" href="#collapseContent" role="button" aria-expanded="{{ $isContentActive ? 'true' : 'false' }}">
                    <span><i class="fas fa-layer-group fa-fw me-2"></i> Content</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </a>
                <div class="collapse {{ $isContentActive ? 'show' : '' }}" id="collapseContent">
                    <div class="sub-nav">
                        <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                            <i class="fas fa-images fa-fw"></i> Sliders
                        </a>
                        <a href="{{ route('admin.notices.index') }}" class="nav-link {{ request()->routeIs('admin.notices.*') ? 'active' : '' }}">
                            <i class="fas fa-bullhorn fa-fw"></i> Notices
                        </a>
                        <a href="{{ route('admin.gallery-albums.index') }}" class="nav-link {{ request()->routeIs('admin.gallery-albums.*') ? 'active' : '' }}">
                            <i class="fas fa-camera-retro fa-fw"></i> Gallery
                        </a>
                        <a href="{{ route('admin.pages.index') }}" class="nav-link {{ request()->is('admin/pages*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt fa-fw"></i> Pages
                        </a>
                        <a href="{{ route('admin.team-members.index') }}" class="nav-link {{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}">
                            <i class="fas fa-users fa-fw"></i> Team
                        </a>
                        <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                            <i class="fas fa-comment-dots fa-fw"></i> Testimonials
                        </a>
                        <a href="{{ route('admin.branches.index') }}" class="nav-link {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}">
                            <i class="fas fa-map-marker-alt fa-fw"></i> Branches
                        </a>
                        <a href="{{ route('admin.media.index') }}" class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                            <i class="fas fa-folder-open fa-fw"></i> Media Library
                        </a>
                    </div>
                </div>

                <!-- Communications Group -->
                @php $isCommActive = request()->routeIs('admin.enquiries.*') || request()->routeIs('admin.newsletters.*'); @endphp
                <a class="nav-group-title" data-bs-toggle="collapse" href="#collapseComm" role="button" aria-expanded="{{ $isCommActive ? 'true' : 'false' }}">
                    <span><i class="fas fa-envelope-open-text fa-fw me-2"></i> Inbox</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </a>
                <div class="collapse {{ $isCommActive ? 'show' : '' }}" id="collapseComm">
                    <div class="sub-nav">
                        <a href="{{ route('admin.enquiries.index') }}" class="nav-link {{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
                            <i class="fas fa-inbox fa-fw"></i> Enquiries
                        </a>
                        <a href="{{ route('admin.newsletters.index') }}" class="nav-link {{ request()->routeIs('admin.newsletters.*') ? 'active' : '' }}">
                            <i class="fas fa-paper-plane fa-fw"></i> Newsletters
                        </a>
                    </div>
                </div>

                <!-- System Group -->
                @php $isSystemActive = request()->routeIs('admin.settings.*'); @endphp
                <a class="nav-group-title" data-bs-toggle="collapse" href="#collapseSystem" role="button" aria-expanded="{{ $isSystemActive ? 'true' : 'false' }}">
                    <span><i class="fas fa-cogs fa-fw me-2"></i> System</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </a>
                <div class="collapse {{ $isSystemActive ? 'show' : '' }}" id="collapseSystem">
                    <div class="sub-nav">
                        <a href="{{ route('admin.settings.home') }}" class="nav-link {{ request()->routeIs('admin.settings.home*') ? 'active' : '' }}">
                            <i class="fas fa-home fa-fw"></i> Home Settings
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                            <i class="fas fa-sliders-h fa-fw"></i> Global Settings
                        </a>
                    </div>
                </div>

                <!-- Logout -->
                <div class="mt-4 mb-2 px-3">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 text-start d-flex align-items-center gap-2">
                            <i class="fas fa-sign-out-alt fa-fw"></i> Logout
                        </button>
                    </form>
                </div>

            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Topbar -->
        <header id="topbar">
            <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="ms-auto d-flex align-items-center">
                <span class="fw-bold">{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-4 flex-grow-1">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /* ---- Top Progress Bar ---- */
        (function() {
            const bar = document.createElement('div');
            bar.id = 'nprogress-bar';
            document.body.prepend(bar);

            function startBar() {
                bar.style.opacity = '1';
                bar.style.width = '0%';
                // Quickly jump to 70% then wait for completion
                requestAnimationFrame(() => { bar.style.width = '15%'; });
                setTimeout(() => { bar.style.width = '60%'; }, 100);
                setTimeout(() => { bar.style.width = '85%'; }, 400);
            }

            function finishBar() {
                bar.style.width = '100%';
                setTimeout(() => { bar.classList.add('done'); }, 200);
                setTimeout(() => { bar.classList.remove('done'); bar.style.width = '0%'; bar.style.opacity = '0'; }, 650);
            }

            // Trigger on all internal link navigations
            document.addEventListener('click', function(e) {
                const link = e.target.closest('a');
                if (link && link.href && !link.href.startsWith('javascript') && !link.target && link.origin === location.origin) {
                    startBar();
                }
            });

            // Trigger on form submissions
            document.addEventListener('submit', function() { startBar(); });

            // Finish bar on DOMContentLoaded
            window.addEventListener('pageshow', function() { finishBar(); });
        })();

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form').forEach(form => {
                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput && methodInput.value.toUpperCase() === 'DELETE') {
                    form.addEventListener('submit', function (e) {
                        if (!confirm('Are you sure you want to delete this item?')) {
                            e.preventDefault();
                        }
                    });
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
