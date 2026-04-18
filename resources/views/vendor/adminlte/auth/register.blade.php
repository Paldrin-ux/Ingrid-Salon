<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Salon Pro</title>
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

        .register-card {
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

        .form-input:disabled {
            background: var(--gray-100);
            cursor: not-allowed;
            opacity: 0.6;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
            font-size: 16px;
        }

        .email-input-wrapper {
            position: relative;
        }

        .verify-btn {
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            cursor: pointer;
            font-weight: 500;
            font-size: 12px;
            transition: all 0.2s ease;
        }

        .verify-btn:hover:not(:disabled) {
            background: var(--primary-dark);
        }

        .verify-btn:disabled {
            background: var(--gray-600);
            cursor: not-allowed;
        }

        .otp-container {
            display: none;
            animation: slideIn 0.3s ease;
        }

        .password-requirements {
            font-size: 12px;
            color: var(--gray-600);
            margin-top: -10px;
            margin-bottom: 15px;
            line-height: 1.4;
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

        .divider {
            text-align: center;
            margin: 25px 0;
            color: var(--gray-600);
            font-size: 13px;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: var(--gray-100);
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
        }

        .social-login {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
        }

        .social-btn {
            flex: 1;
            padding: 10px;
            border: 2px solid var(--gray-100);
            border-radius: 8px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-900);
            transition: all 0.2s ease;
        }

        .social-btn:hover {
            border-color: var(--primary);
            transform: translateY(-1px);
        }

        .social-icon {
            width: 16px;
            height: 16px;
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

        .alert-warning {
            background: #fffbeb;
            color: var(--yellow-500);
            border-left: 4px solid var(--yellow-500);
        }

        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border-left: 4px solid #16a34a;
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
            .register-card {
                width: 100%;
                max-width: 350px;
            }
            
            .card-body {
                padding: 25px 20px;
            }
            
            .social-login {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="register-card">
        <!-- Header -->
        <div class="card-header">
            <div class="logo">
                <i class="fas fa-cut"></i>
            </div>
            <h1>Create Account</h1>
            <p>Join us and start managing your appointments</p>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Alerts -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Register Form -->
            <form action="{{ route('register.custom') }}" method="POST" id="registerForm">
                @csrf
                
                <!-- Full Name -->
<div class="form-group">
    <input type="text" name="name" class="form-input" placeholder="Full Name" 
           value="{{ old('name') }}" required
           onkeydown="return /[a-zA-Z\s]/.test(event.key) || ['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(event.key)"
           onpaste="let p=event.clipboardData.getData('text');if(/\d/.test(p))event.preventDefault()"
           oninput="this.value=this.value.replace(/[0-9]/g,'')">
    <i class="fas fa-user input-icon"></i>
</div>
                <!-- Email with Verify Button -->
                <div class="form-group">
                    <div class="email-input-wrapper">
                        <input type="email" id="email" name="email" class="form-input" 
                               placeholder="Email address" value="{{ old('email') }}" required>
                        <button type="button" id="verifyBtn" class="verify-btn">Verify</button>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <!-- OTP Input -->
                <div class="form-group otp-container" id="otpContainer">
                    <input type="text" id="otp" name="otp" class="form-input" placeholder="Enter OTP Code">
                    <i class="fas fa-shield-alt input-icon"></i>
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <input type="tel" name="phone" class="form-input" placeholder="Phone Number" 
                           value="{{ old('phone') }}" maxlength="11" pattern="\d{11}" 
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" required>
                    <i class="fas fa-phone input-icon"></i>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="Password" 
                           minlength="10" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>
                <div class="password-requirements">
                    Password must be at least 10 characters with 1 uppercase letter, 1 number, and 1 special character
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-input" 
                           placeholder="Confirm Password" minlength="10" required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                <button type="submit" class="btn btn-primary">
                    Create Account
                </button>
            </form>

            <!-- Login Button -->
            <a href="{{ route('login') }}" class="btn btn-secondary">
                Already have an account? Sign In
            </a>

            <div class="divider">
                <span>Or continue with</span>
            </div>

            <!-- Social Login -->
            <div class="social-login">
                <a href="{{ route('social.redirect', 'google') }}" class="social-btn">
                    <img src="{{ asset('images/google.jpg') }}" alt="Google" class="social-icon">
                    Google
                </a>
                <a href="{{ route('social.redirect', 'facebook') }}" class="social-btn">
                    <img src="{{ asset('images/facebook.jpg') }}" alt="Facebook" class="social-icon">
                    Facebook
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const verifyBtn = document.getElementById('verifyBtn');
            const otpContainer = document.getElementById('otpContainer');
            const emailInput = document.getElementById('email');

            verifyBtn.addEventListener('click', function() {
                const email = emailInput.value;
                
                if (!email) {
                    alert('Please enter an email address first.');
                    return;
                }

                // Simple email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    alert('Please enter a valid email address.');
                    return;
                }

                // Disable button and show loading state
                verifyBtn.disabled = true;
                verifyBtn.textContent = 'Sending...';

                // Send OTP request
                $.ajax({
                    url: "{{ route('send.otp') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: email
                    },
                    success: function (response) {
                        alert(response.message || 'OTP sent successfully!');
                        otpContainer.style.display = 'block';
                        verifyBtn.textContent = 'Resend OTP';
                        verifyBtn.disabled = false;
                    },
                    error: function (xhr) {
                        alert(xhr.responseJSON?.message || 'Something went wrong. Please try again.');
                        verifyBtn.textContent = 'Verify';
                        verifyBtn.disabled = false;
                    }
                });
            });

            // Form submission validation
            const registerForm = document.getElementById('registerForm');
            registerForm.addEventListener('submit', function(e) {
                const password = document.querySelector('input[name="password"]').value;
                const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;
                
                // Check if passwords match
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Passwords do not match. Please check and try again.');
                    return;
                }

                // Basic password strength validation
                const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{10,}$/;
                if (!passwordRegex.test(password)) {
                    e.preventDefault();
                    alert('Password must be at least 10 characters long and contain at least one uppercase letter, one number, and one special character.');
                    return;
                }
            });
        });
    </script>
</body>
</html>