<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduSkill Admin')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="offcanvas-md offcanvas-start bg-navy" tabindex="-1">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            EduSkill
        </a>
        <nav class="nav flex-column mt-3">
            <div class="nav-group-title">Dashboard</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Overview</a>
            
            <div class="nav-group-title">Courses</div>
            <a href="{{ route('admin.course-categories.index') }}" class="nav-link {{ request()->routeIs('admin.course-categories.*') ? 'active' : '' }}">Categories</a>
            <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">Courses</a>
            
            <div class="nav-group-title">Trainings & Placements</div>
            <a href="{{ route('admin.trainings.index') }}" class="nav-link {{ request()->routeIs('admin.trainings.*') ? 'active' : '' }}">Trainings</a>
            <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">Students</a>
            <a href="{{ route('admin.companies.index') }}" class="nav-link {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">Companies</a>
            <a href="{{ route('admin.placements.index') }}" class="nav-link {{ request()->routeIs('admin.placements.*') ? 'active' : '' }}">Placements</a>
            
            <div class="nav-group-title">Content & Media</div>
            <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">Home Sliders</a>
            <a href="{{ route('admin.notices.index') }}" class="nav-link {{ request()->routeIs('admin.notices.*') ? 'active' : '' }}">Notices & Marquee</a>
            <a href="{{ route('admin.gallery-albums.index') }}" class="nav-link {{ request()->routeIs('admin.gallery-albums.*') ? 'active' : '' }}">Gallery</a>
            <a href="{{ route('admin.pages.index') }}" class="nav-link {{ request()->is('admin/pages*') ? 'active' : '' }}">Pages</a>
            <a href="{{ route('admin.team-members.index') }}" class="nav-link {{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}">Team</a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">Testimonials</a>
            <a href="{{ route('admin.branches.index') }}" class="nav-link {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}">Branches</a>
            <a href="{{ route('admin.media.index') }}" class="nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">Media Library</a>
            
            <div class="nav-group-title">Communications</div>
            <a href="{{ route('admin.enquiries.index') }}" class="nav-link {{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">Enquiries</a>
            <a href="{{ route('admin.newsletters.index') }}" class="nav-link {{ request()->routeIs('admin.newsletters.*') ? 'active' : '' }}">Newsletters</a>
            
            <div class="nav-group-title">System</div>
            <a href="{{ route('admin.settings.home') }}" class="nav-link {{ request()->routeIs('admin.settings.home*') ? 'active' : '' }}">Home Settings</a>
            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">Settings</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="nav-link text-start w-100 bg-transparent border-0 text-danger">Logout</button>
            </form>
        </nav>
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
