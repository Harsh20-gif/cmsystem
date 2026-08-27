<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Skill Bridge India Technologies Admin</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-navy: #0f172a;
            --primary-orange: #f97316;
            --primary-orange-hover: #ea580c;
            --focus-ring: rgba(249, 115, 22, 0.25);
        }

        body {
            /* Subtle radial gradient background */
            background: radial-gradient(circle at top right, #1e293b, var(--primary-navy));
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1rem;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 2.5rem 2rem;
            border-radius: 1.25rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4), 0 5px 15px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }

        /* Branding */
        .brand-logo {
            max-width: 120px;
            height: auto;
            margin-bottom: 1rem;
        }
        .brand-title {
            font-size: 1.4rem;
            color: var(--primary-navy);
            margin-bottom: 0.25rem;
        }
        
        /* Input Groups */
        .input-group-custom {
            position: relative;
            margin-bottom: 1.25rem;
        }
        
        .input-group-custom.has-error {
            margin-bottom: 0;
        }
        
        .input-group-custom .input-icon-left {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            z-index: 5;
            transition: color 0.2s ease;
        }
        
        .input-group-custom .form-control {
            padding-left: 2.75rem;
            padding-right: 2.75rem; /* Space for right toggle icon */
            height: 3rem;
            border-radius: 0.5rem;
            border: 1px solid #cbd5e1;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        
        .input-group-custom .form-control:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 4px var(--focus-ring);
        }
        
        /* Highlight left icon on focus */
        .input-group-custom .form-control:focus ~ .input-icon-left {
            color: var(--primary-orange);
        }
        
        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #64748b;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 5;
            border-radius: 50%;
            transition: color 0.2s ease, background-color 0.2s ease;
        }
        
        .password-toggle:hover {
            color: var(--primary-navy);
            background-color: #f1f5f9;
        }
        
        .password-toggle:focus {
            outline: none;
            box-shadow: 0 0 0 3px var(--focus-ring);
        }

        /* Checkbox */
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .form-check-input {
            margin-top: 0;
            margin-right: 0.5rem;
            cursor: pointer;
        }
        .form-check-input:checked {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
        }
        .form-check-input:focus {
            box-shadow: 0 0 0 4px var(--focus-ring);
            border-color: var(--primary-orange);
        }
        .form-check-label {
            cursor: pointer;
            user-select: none;
            color: #475569;
        }

        /* Button */
        .btn-orange {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
            color: white;
            font-weight: 600;
            height: 3rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .btn-orange:hover, .btn-orange:focus {
            background-color: var(--primary-orange-hover);
            border-color: var(--primary-orange-hover);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3);
        }
        
        .btn-orange:active {
            transform: translateY(0);
        }

        /* Loading state */
        .btn-loading {
            pointer-events: none;
            opacity: 0.9;
        }
        .btn-loading .btn-text {
            visibility: hidden;
            opacity: 0;
        }
        .btn-loading::after {
            content: "";
            position: absolute;
            width: 1.25rem;
            height: 1.25rem;
            top: 50%;
            left: 50%;
            margin-top: -0.625rem;
            margin-left: -0.625rem;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="text-center mb-4">
            <img src="{{ asset('frontend/assets/logo_v1.png') }}" alt="Skill Bridge India Logo" class="brand-logo">
            <h2 class="brand-title fw-bold">Skill Bridge India</h2>
        </div>

        <form action="{{ route('admin.login.submit') }}" method="POST" id="loginForm">
            @csrf
            
            <!-- Email Field -->
            <label for="email" class="form-label fw-semibold small text-dark mb-1">Email address</label>
            <div class="input-group-custom @error('email') has-error @enderror">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                <i class="fas fa-envelope input-icon-left"></i>
            </div>
            @error('email')
                <div class="text-danger small mb-3 mt-1 fw-medium">{{ $message }}</div>
            @enderror

            <!-- Password Field -->
            <label for="password" class="form-label fw-semibold small text-dark mb-1">Password</label>
            <div class="input-group-custom @error('password') has-error @enderror">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="••••••••" required>
                <i class="fas fa-lock input-icon-left"></i>
                <button type="button" class="password-toggle" id="togglePassword" aria-label="Toggle password visibility">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger small mb-3 mt-1 fw-medium">{{ $message }}</div>
            @enderror

            <!-- Remember Me -->
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label small" for="remember">Remember me</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-orange w-100" id="submitBtn">
                <span class="btn-text">Sign In</span>
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Password Visibility Toggle
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Toggle type attribute
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    
                    // Toggle FontAwesome classes
                    if (isPassword) {
                        toggleIcon.classList.remove('fa-eye');
                        toggleIcon.classList.add('fa-eye-slash');
                    } else {
                        toggleIcon.classList.remove('fa-eye-slash');
                        toggleIcon.classList.add('fa-eye');
                    }
                });
            }

            // Loading state on form submit
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            
            if (loginForm && submitBtn) {
                loginForm.addEventListener('submit', function() {
                    // Only show loading if form fields pass HTML5 validation
                    if (loginForm.checkValidity()) {
                        submitBtn.classList.add('btn-loading');
                        // Change text (invisible but good for screen readers/fallback)
                        const btnText = submitBtn.querySelector('.btn-text');
                        if(btnText) btnText.textContent = "Signing in...";
                    }
                });
            }
        });
    </script>
</body>
</html>