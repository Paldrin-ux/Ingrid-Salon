@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('body')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Salon Pro</title>
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

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 400px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 40px 30px 30px;
            text-align: center;
        }

        .logo {
            width: 60px; height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
            backdrop-filter: blur(10px);
        }

        .card-header h1 { font-size: 24px; font-weight: 700; margin-bottom: 8px; }
        .card-header p  { opacity: 0.9; font-size: 14px; }
        .card-body      { padding: 30px; }

        .form-group { margin-bottom: 20px; position: relative; }

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
            border-color: var(--primary); background: white; outline: none;
            box-shadow: 0 0 0 3px rgba(139,92,246,0.1);
        }

        .form-input:disabled { background: var(--gray-100); cursor: not-allowed; opacity: 0.6; }

        .input-icon {
            position: absolute; right: 16px; top: 50%;
            transform: translateY(-50%); color: var(--gray-600); font-size: 16px;
        }

        .form-options {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 25px; font-size: 14px;
        }

        .remember { display: flex; align-items: center; gap: 8px; color: var(--gray-600); }
        .remember input { width: 16px; height: 16px; }

        .forgot-link { color: var(--primary); text-decoration: none; font-weight: 500; }
        .forgot-link:hover { text-decoration: underline; }

        .btn {
            width: 100%; padding: 12px; border: none; border-radius: 10px;
            font-size: 14px; font-weight: 600; font-family: 'Inter', sans-serif;
            cursor: pointer; transition: all 0.2s ease; margin-bottom: 15px;
            display: block; text-align: center; text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }
        .btn-primary:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(139,92,246,0.3);
        }
        .btn-primary:disabled {
            background: var(--gray-100); color: var(--gray-600);
            cursor: not-allowed; transform: none; box-shadow: none;
        }

        .btn-secondary {
            background: transparent; color: var(--primary);
            border: 2px solid var(--primary);
        }
        .btn-secondary:hover { background: var(--primary); color: white; }

        .divider {
            text-align: center; margin: 25px 0; color: var(--gray-600);
            font-size: 13px; position: relative;
        }
        .divider::before {
            content: ''; position: absolute; left: 0; top: 50%;
            width: 100%; height: 1px; background: var(--gray-100);
        }
        .divider span { background: white; padding: 0 15px; position: relative; }

        .social-login { display: flex; gap: 12px; margin-bottom: 25px; }

        .social-btn {
            flex: 1; padding: 10px; border: 2px solid var(--gray-100); border-radius: 8px;
            background: white; display: flex; align-items: center; justify-content: center;
            gap: 8px; text-decoration: none; font-size: 13px; font-weight: 500;
            color: var(--gray-900); transition: all 0.2s ease;
        }
        .social-btn:hover { border-color: var(--primary); transform: translateY(-1px); }
        .social-icon { width: 16px; height: 16px; }

        .alert {
            border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
            font-size: 13px; animation: slideIn 0.3s ease;
        }
        .alert-danger  { background: #fef2f2; color: var(--red-500); border-left: 4px solid var(--red-500); }
        .alert-warning { background: #fffbeb; color: var(--yellow-500); border-left: 4px solid var(--yellow-500); }
        .alert-success { background: #f0fdf4; color: #16a34a; border-left: 4px solid #16a34a; }

        .countdown-timer { font-weight: 700; color: var(--red-500); }
        .login-attempts  { font-size: 12px; color: var(--gray-600); text-align: center; margin: 10px 0; }

        .progress-bar  { background: var(--gray-100); border-radius: 10px; height: 4px; margin: 5px 0; overflow: hidden; }
        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 10px; transition: width 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .login-card  { width: 100%; max-width: 350px; }
            .card-body   { padding: 25px 20px; }
            .social-login { flex-direction: column; }
        }

        /* ===================== CAPTCHA MODAL ===================== */
        .captcha-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(6px);
            display: flex; align-items: center; justify-content: center;
            z-index: 9999;
            opacity: 0; visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
        }
        .captcha-overlay.active { opacity: 1; visibility: visible; }

        .captcha-box {
            background: #fff;
            border-radius: 16px;
            width: 340px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.2);
            overflow: hidden;
            transform: scale(0.92) translateY(12px);
            transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
        }
        .captcha-overlay.active .captcha-box { transform: scale(1) translateY(0); }

        .captcha-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            padding: 20px 24px 18px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .captcha-header-left { display: flex; align-items: center; gap: 10px; }
        .captcha-header-left .shield-icon {
            width: 36px; height: 36px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: #fff;
        }
        .captcha-header-title   { font-size: 14px; font-weight: 700; color: #fff; }
        .captcha-header-sub     { font-size: 11px; color: rgba(255,255,255,0.75); margin-top: 1px; }
        .captcha-close-btn {
            background: rgba(255,255,255,0.15); border: none; color: #fff;
            width: 28px; height: 28px; border-radius: 50%; cursor: pointer;
            font-size: 16px; display: flex; align-items: center; justify-content: center;
            transition: background 0.2s;
        }
        .captcha-close-btn:hover { background: rgba(255,255,255,0.3); }

        .captcha-body { padding: 24px; }

        /* Checkbox row */
        .captcha-check-row {
            display: flex; align-items: center; gap: 14px;
            background: var(--gray-50);
            border: 2px solid var(--gray-100);
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 18px;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            user-select: none;
        }
        .captcha-check-row:hover { border-color: var(--primary); background: #f5f0ff; }
        .captcha-check-row.verified { border-color: #16a34a; background: #f0fdf4; }

        /* Custom checkbox */
        .captcha-checkbox {
            width: 24px; height: 24px; min-width: 24px;
            border: 2px solid #d1d5db;
            border-radius: 6px; background: #fff;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s ease; position: relative;
        }
        .captcha-check-row:hover .captcha-checkbox { border-color: var(--primary); }
        .captcha-check-row.verified .captcha-checkbox {
            background: #16a34a; border-color: #16a34a;
        }
        .captcha-checkbox .tick {
            display: none; color: #fff; font-size: 13px;
        }
        .captcha-check-row.verified .captcha-checkbox .tick { display: block; }

        /* Spinner inside checkbox (while "verifying") */
        .captcha-checkbox .spinner {
            display: none;
            width: 14px; height: 14px;
            border: 2px solid rgba(139,92,246,0.3);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }
        .captcha-check-row.checking .captcha-checkbox .spinner { display: block; }
        .captcha-check-row.checking .captcha-checkbox .tick    { display: none; }

        .captcha-check-label { font-size: 14px; font-weight: 500; color: var(--gray-900); }
        .captcha-check-sub   { font-size: 11px; color: var(--gray-600); margin-top: 2px; }

        /* reCAPTCHA-style branding strip */
        .captcha-brand {
            display: flex; align-items: center; justify-content: flex-end; gap: 4px;
            font-size: 10px; color: #9ca3af; margin-bottom: 18px;
        }
        .captcha-brand .lock-icon { font-size: 10px; }

        /* Challenge grid (appears after checking) */
        .captcha-challenge {
            display: none;
            animation: slideIn 0.3s ease;
            margin-bottom: 16px;
        }
        .captcha-challenge.show { display: block; }
        .challenge-label {
            font-size: 12px; font-weight: 600; color: var(--gray-600);
            margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.04em;
        }
        .challenge-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;
        }
        .challenge-tile {
            aspect-ratio: 1;
            border-radius: 8px;
            background: var(--gray-100);
            border: 2px solid transparent;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            transition: all 0.15s ease;
            position: relative; overflow: hidden;
        }
        .challenge-tile:hover { border-color: var(--primary); background: #f5f0ff; transform: scale(1.04); }
        .challenge-tile.selected { border-color: var(--primary); background: #ede9fe; }
        .challenge-tile.selected::after {
            content: '✓';
            position: absolute; top: 4px; right: 6px;
            font-size: 11px; font-weight: 700; color: var(--primary);
        }

        .captcha-continue-btn {
            width: 100%; padding: 11px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff; border: none; border-radius: 10px;
            font-size: 14px; font-weight: 600; font-family: 'Inter', sans-serif;
            cursor: pointer; transition: all 0.2s ease; display: none;
        }
        .captcha-continue-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(139,92,246,0.35); }
        .captcha-continue-btn.show { display: block; animation: slideIn 0.3s ease; }

        .captcha-error {
            font-size: 12px; color: var(--red-500);
            background: #fef2f2; border-radius: 8px;
            padding: 8px 12px; margin-bottom: 12px;
            display: none; animation: slideIn 0.3s ease;
        }
        .captcha-error.show { display: block; }

        @keyframes spin { to { transform: rotate(360deg); } }
        /* ====================================================== */
    </style>
</head>
<body>
    <div class="login-card">
        <div class="card-header">
            <div class="logo"><i class="fas fa-spa"></i></div>
            <h1>Welcome Back</h1>
            <p>Sign in to your account</p>
        </div>

        <div class="card-body">
            @if (session('rate_limit_remaining'))
                <div class="alert alert-warning">
                    <i class="fas fa-clock mr-2"></i>
                    Please wait <span class="countdown-timer" id="countdown">{{ session('rate_limit_remaining') }}</span>s
                </div>
            @endif

            @if (session('attempts_remaining'))
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    {{ session('attempts_remaining') }} attempt(s) remaining
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    @foreach ($errors->all() as $error) {{ $error }} @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Email address"
                           value="{{ old('email') }}"
                           @if(session('rate_limit_remaining')) disabled @endif required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="Password"
                           @if(session('rate_limit_remaining')) disabled @endif required>
                    <i class="fas fa-lock input-icon"></i>
                </div>

                @if(session('attempts_count'))
                    <div class="login-attempts">
                        {{ session('attempts_count') }}/5 attempts
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ (session('attempts_count') / 5) * 100 }}%"></div>
                        </div>
                    </div>
                @endif

                <div class="form-options">
                    <label class="remember">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary" id="loginButton"
                        @if(session('rate_limit_remaining')) disabled @endif>
                    <span id="buttonText">
                        @if(session('rate_limit_remaining'))
                            Try again in <span id="buttonCountdown">{{ session('rate_limit_remaining') }}</span>s
                        @else
                            Sign In
                        @endif
                    </span>
                </button>
            </form>

            {{-- ✅ Register button now triggers captcha, NOT a direct link --}}
            <button type="button" class="btn btn-secondary" id="registerTrigger">
                Create new account
            </button>

            <div class="divider"><span>Or continue with</span></div>

            <div class="social-login">
                <a href="{{ route('social.redirect', 'google') }}" class="social-btn">
                    <img src="{{ asset('images/google.jpg') }}" alt="Google" class="social-icon"> Google
                </a>
                <a href="{{ route('social.redirect', 'facebook') }}" class="social-btn">
                    <img src="{{ asset('images/facebook.jpg') }}" alt="Facebook" class="social-icon"> Facebook
                </a>
            </div>
        </div>
    </div>

    {{-- ===================== CAPTCHA MODAL ===================== --}}
    <div class="captcha-overlay" id="captchaOverlay">
        <div class="captcha-box">

            {{-- Header --}}
            <div class="captcha-header">
                <div class="captcha-header-left">
                    <div class="shield-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <div class="captcha-header-title">Security Verification</div>
                        <div class="captcha-header-sub">Confirm you're a real person</div>
                    </div>
                </div>
                <button class="captcha-close-btn" id="captchaClose">&times;</button>
            </div>

            {{-- Body --}}
            <div class="captcha-body">

                {{-- Step 1: Checkbox --}}
                <div class="captcha-check-row" id="captchaCheckRow">
                    <div class="captcha-checkbox" id="captchaCheckbox">
                        <span class="tick"><i class="fas fa-check"></i></span>
                        <span class="spinner"></span>
                    </div>
                    <div>
                        <div class="captcha-check-label">I am not a robot</div>
                        <div class="captcha-check-sub">Click to verify your identity</div>
                    </div>
                </div>

                {{-- Brand strip --}}
                <div class="captcha-brand">
                    <i class="fas fa-lock lock-icon"></i> Protected by SalonPro Security
                </div>

                {{-- Error message --}}
                <div class="captcha-error" id="captchaError">
                    <i class="fas fa-exclamation-circle"></i>
                    Please select all matching images to continue.
                </div>

                {{-- Step 2: Image challenge --}}
                <div class="captcha-challenge" id="captchaChallenge">
                    <div class="challenge-label" id="challengeLabel">Select all images with: 🌸 Flowers</div>
                    <div class="challenge-grid" id="challengeGrid"></div>
                </div>

                {{-- Step 3: Continue button --}}
                <button class="captcha-continue-btn" id="captchaContinue">
                    <i class="fas fa-arrow-right mr-1"></i> Continue to Register
                </button>

            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // ── Login countdown ──────────────────────────────────────
        const countdownEl       = document.getElementById('countdown');
        const buttonCountdownEl = document.getElementById('buttonCountdown');
        const loginButton       = document.getElementById('loginButton');
        const loginForm         = document.getElementById('loginForm');
        const inputs            = loginForm.querySelectorAll('input');
        const buttonText        = document.getElementById('buttonText');
        let remainingTime       = {{ session('rate_limit_remaining') ?? 0 }};

        if (remainingTime > 0) {
            const interval = setInterval(() => {
                remainingTime--;
                if (countdownEl)       countdownEl.textContent       = remainingTime;
                if (buttonCountdownEl) buttonCountdownEl.textContent = remainingTime;
                if (remainingTime <= 0) {
                    clearInterval(interval);
                    inputs.forEach(i => i.disabled = false);
                    loginButton.disabled = false;
                    if (buttonText) buttonText.textContent = 'Sign In';
                    if (countdownEl) countdownEl.parentElement.style.display = 'none';
                }
            }, 1000);
        }

        loginForm.addEventListener('submit', e => { if (remainingTime > 0) e.preventDefault(); });

        // ── CAPTCHA logic ─────────────────────────────────────────
        const registerTrigger  = document.getElementById('registerTrigger');
        const overlay          = document.getElementById('captchaOverlay');
        const captchaClose     = document.getElementById('captchaClose');
        const checkRow         = document.getElementById('captchaCheckRow');
        const challenge        = document.getElementById('captchaChallenge');
        const challengeLabel   = document.getElementById('challengeLabel');
        const challengeGrid    = document.getElementById('challengeGrid');
        const continueBtn      = document.getElementById('captchaContinue');
        const captchaError     = document.getElementById('captchaError');

        // Each challenge: a label + 9 tiles with emojis, and which indices are "correct"
        const challenges = [
            {
                label: 'Select all images with: 🌸 Flowers',
                emojis: ['🌸','🚗','🌸','🍎','🌸','🏠','🌸','🎵','🌸'],
                correct: [0,2,4,6,8]
            },
            {
                label: 'Select all images with: 🐶 Dogs',
                emojis: ['🐶','🌴','🐶','🍕','🐱','🐶','🚀','🐶','🎸'],
                correct: [0,2,5,7]
            },
            {
                label: 'Select all images with: ⭐ Stars',
                emojis: ['⭐','🍦','🚂','⭐','🦋','⭐','🎃','⭐','🌊'],
                correct: [0,3,5,7]
            },
        ];

        let currentChallenge = null;
        let captchaPassed    = false;
        let state            = 'idle'; // idle | checking | challenge | done

        function openCaptcha() {
            captchaPassed = false;
            state = 'idle';
            resetUI();
            overlay.classList.add('active');
        }

        function closeCaptcha() {
            overlay.classList.remove('active');
        }

        function resetUI() {
            checkRow.classList.remove('verified','checking');
            challenge.classList.remove('show');
            continueBtn.classList.remove('show');
            captchaError.classList.remove('show');
            challengeGrid.innerHTML = '';
        }

        registerTrigger.addEventListener('click', openCaptcha);
        captchaClose.addEventListener('click', closeCaptcha);
        overlay.addEventListener('click', e => { if (e.target === overlay) closeCaptcha(); });

        // Step 1 – clicking the checkbox
        checkRow.addEventListener('click', function () {
            if (state !== 'idle') return;
            state = 'checking';
            checkRow.classList.add('checking');

            // Simulate a brief "verification" delay, then show challenge
            setTimeout(() => {
                checkRow.classList.remove('checking');
                state = 'challenge';

                // Pick a random challenge
                currentChallenge = challenges[Math.floor(Math.random() * challenges.length)];
                challengeLabel.textContent = currentChallenge.label;

                // Build grid
                challengeGrid.innerHTML = '';
                currentChallenge.emojis.forEach((emoji, i) => {
                    const tile = document.createElement('div');
                    tile.className = 'challenge-tile';
                    tile.textContent = emoji;
                    tile.dataset.index = i;
                    tile.addEventListener('click', () => {
                        tile.classList.toggle('selected');
                        captchaError.classList.remove('show');
                        evaluateSelections();
                    });
                    challengeGrid.appendChild(tile);
                });

                challenge.classList.add('show');
            }, 1200);
        });

        function evaluateSelections() {
            const selected = [...challengeGrid.querySelectorAll('.challenge-tile.selected')]
                .map(t => parseInt(t.dataset.index));

            const correct = currentChallenge.correct;
            const allCorrectSelected  = correct.every(i => selected.includes(i));
            const noWrongSelected     = selected.every(i => correct.includes(i));

            if (allCorrectSelected && noWrongSelected && selected.length > 0) {
                // All correct — mark verified
                checkRow.classList.add('verified');
                captchaPassed = true;
                continueBtn.classList.add('show');
            } else {
                continueBtn.classList.remove('show');
            }
        }

        // Step 3 – Continue button
        continueBtn.addEventListener('click', function () {
            if (!captchaPassed) {
                captchaError.classList.add('show');
                return;
            }
            // Redirect to register page
            window.location.href = "{{ route('register') }}";
        });
    });
    </script>
</body>
</html>
@stop