<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Salon Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #8b5cf6;
            --primary-dark: #7c3aed;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-600: #4b5563;
            --gray-900: #111827;
            --red-500: #ef4444;
            --yellow-500: #eab308;
            --green-500: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .reset-card {
            width: 400px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 40px 30px 30px;
            text-align: center;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
            backdrop-filter: blur(10px);
        }

        .card-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .card-header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .card-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 12px 45px 12px 16px;
            border: 2px solid var(--gray-100);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
            background: var(--gray-50);
        }

        .form-input:focus {
            border-color: var(--primary);
            background: white;
            outline: none;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
            font-size: 16px;
        }

        .password-requirements {
            font-size: 12px;
            color: var(--gray-600);
            margin-top: -10px;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .password-strength {
            height: 4px;
            background: var(--gray-100);
            border-radius: 2px;
            margin: 8px 0;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            border-radius: 2px;
            transition: all 0.3s ease;
            width: 0%;
        }

        .strength-weak {
            background: var(--red-500);
            width: 33%;
        }

        .strength-medium {
            background: var(--yellow-500);
            width: 66%;
        }

        .strength-strong {
            background: var(--green-500);
            width: 100%;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 15px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        }

        .btn-primary:disabled {
            background: var(--gray-100);
            color: var(--gray-600);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: white;
        }

        /* Alert Styles */
        .alert {
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            animation: slideIn 0.3s ease;
        }

        .alert-danger {
            background: #fef2f2;
            color: var(--red-500);
            border-left: 4px solid var(--red-500);
        }

        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border-left: 4px solid #16a34a;
        }

        .alert-warning {
            background: #fffbeb;
            color: var(--yellow-500);
            border-left: 4px solid var(--yellow-500);
        }

        .alert-info {
            background: #eff6ff;
            color: var(--primary);
            border-left: 4px solid var(--primary);
        }

        .instructions {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 13px;
            color: var(--gray-600);
        }

        .instructions ul {
            padding-left: 20px;
            margin: 8px 0;
        }

        .instructions li {
            margin-bottom: 4px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .reset-card {
                width: 100%;
                max-width: 350px;
            }
            
            .card-body {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="reset-card">
        <!-- Header -->
        <div class="card-header">
            <div class="logo">
                <i class="fas fa-key"></i>
            </div>
            <h1>Reset Password</h1>
            <p>Create a new secure password for your account</p>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Alerts -->
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <!-- Password Reset Form -->
            <form action="{{ route('password.update') }}" method="POST" id="resetForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Email address" 
                           value="{{ $email ?? old('email') }}" required readonly>
                    <i class="fas fa-envelope input-icon"></i>
                </div>

                <!-- New Password -->
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-input" 
                           placeholder="New Password" minlength="10" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <!-- Password Strength Meter -->
                <div class="password-strength">
                    <div class="strength-fill" id="passwordStrength"></div>
                </div>

                <!-- Password Requirements -->
                <div class="password-requirements">
                    Password must be at least 10 characters with 1 uppercase letter, 1 number, and 1 special character
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="form-input" placeholder="Confirm New Password" minlength="10" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <!-- Password Match Indicator -->
                <div id="passwordMatch" style="display: none;">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>
                        Passwords match
                    </div>
                </div>

                <div id="passwordMismatch" style="display: none;">
                    <div class="alert alert-danger">
                        <i class="fas fa-times-circle mr-2"></i>
                        Passwords do not match
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" id="resetButton">
                    Reset Password
                </button>
            </form>

            <!-- Back to Login -->
            <a href="{{ route('login') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Login
            </a>

            <!-- Additional Instructions -->
            <div class="instructions">
                <strong>Password Requirements:</strong>
                <ul>
                    <li>Minimum 10 characters</li>
                    <li>At least one uppercase letter (A-Z)</li>
                    <li>At least one number (0-9)</li>
                    <li>At least one special character (!@#$%^&* etc.)</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const passwordStrength = document.getElementById('passwordStrength');
            const passwordMatch = document.getElementById('passwordMatch');
            const passwordMismatch = document.getElementById('passwordMismatch');
            const resetButton = document.getElementById('resetButton');
            const resetForm = document.getElementById('resetForm');

            // Password strength checker
            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                let strength = 0;

                // Length check
                if (password.length >= 10) strength += 25;

                // Uppercase check
                if (/[A-Z]/.test(password)) strength += 25;

                // Number check
                if (/[0-9]/.test(password)) strength += 25;

                // Special character check
                if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) strength += 25;

                // Update strength meter
                passwordStrength.className = 'strength-fill';
                if (strength <= 25) {
                    passwordStrength.classList.add('strength-weak');
                } else if (strength <= 75) {
                    passwordStrength.classList.add('strength-medium');
                } else {
                    passwordStrength.classList.add('strength-strong');
                }
            });

            // Password match checker
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (password === '' && confirmPassword === '') {
                    passwordMatch.style.display = 'none';
                    passwordMismatch.style.display = 'none';
                    return;
                }

                if (password === confirmPassword && password.length >= 10) {
                    passwordMatch.style.display = 'block';
                    passwordMismatch.style.display = 'none';
                } else {
                    passwordMatch.style.display = 'none';
                    passwordMismatch.style.display = 'block';
                }
            }

            passwordInput.addEventListener('input', checkPasswordMatch);
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);

            // Form validation
            resetForm.addEventListener('submit', function(e) {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                // Check if passwords match
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Passwords do not match. Please check and try again.');
                    return;
                }

                // Check password strength requirements
                const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{10,}$/;
                if (!passwordRegex.test(password)) {
                    e.preventDefault();
                    alert('Password must be at least 10 characters long and contain at least one uppercase letter, one number, and one special character.');
                    return;
                }
            });

            // Auto-check password match when page loads (if values exist)
            checkPasswordMatch();
        });
    </script>
</body>
</html>