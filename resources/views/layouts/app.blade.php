<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="@yield('meta_description', 'Skill Bridge India Technologies - premier job-oriented BTech training & placement institute in Noida, Lucknow, and Bhopal. Offering Fullstack, AI, Data Science, Industrial Automation, PLC SCADA, MEP, HVAC, Embedded Systems, and Robotics.')">
  <title>@yield('title', 'Skill Bridge India Technologies | BTech Training & Placement in Lucknow, Noida, Bhopal')</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome Icons & Google Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('frontend/styles.css') }}">
  <!-- Micro-Interactions -->
  <link rel="stylesheet" href="{{ asset('micro-interactions.css') }}">
  @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">
  @include('frontend.partials.header')

  <main class="flex-grow-1">
    @yield('content')
  </main>

  @include('frontend.partials.modals')

  @include('frontend.partials.footer')

  @stack('scripts')
  <script src="{{ asset('frontend/script.js') }}"></script>

  <!-- Top Progress Bar + Page Transitions -->
  <script>
    (function() {
        const bar = document.createElement('div');
        bar.id = 'nprogress-bar';
        document.body.prepend(bar);

        function startBar() {
            bar.style.opacity = '1';
            bar.style.width = '0%';
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

        // Finish bar when page is ready
        window.addEventListener('pageshow', function() { finishBar(); });
    })();
  </script>
</body>

</html>
