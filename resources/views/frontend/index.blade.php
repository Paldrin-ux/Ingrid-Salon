<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->meta_title }}</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $setting->meta_description }}">
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #8b5cf6;
            --primary-dark: #7c3aed;
            --primary-light: #a78bfa;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-600: #4b5563;
            --gray-900: #111827;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        /* Header Styling */
        .header-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            color: white;
            font-size: 2rem;
        }

        .navbar-light .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 20px !important;
            border-radius: 25px;
            margin: 0 5px;
        }

        .navbar-light .nav-link:hover,
        .navbar-light .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
            transform: translateY(-2px);
        }

        /* Booking Container */
        .booking-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .booking-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .booking-header::before {
            content: '✂';
            position: absolute;
            font-size: 150px;
            opacity: 0.1;
            top: -30px;
            right: 50px;
            transform: rotate(-15deg);
        }

        .booking-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
        }

        .booking-header p {
            font-size: 1.1rem;
            opacity: 0.95;
        }

        /* Step Indicator */
        .booking-steps {
            display: flex;
            justify-content: space-between;
            padding: 50px 40px 30px;
            position: relative;
            background: linear-gradient(to bottom, var(--gray-50) 0%, white 100%);
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            position: relative;
            z-index: 2;
            flex: 1;
        }

        .step-number {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: white;
            border: 4px solid #E0E0E0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.3rem;
            color: #999;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .step-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #666;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-color: var(--primary-light);
            color: white;
            transform: scale(1.15);
            box-shadow: 0 6px 25px rgba(139, 92, 246, 0.4);
        }

        .step.active .step-title {
            color: var(--primary);
            font-weight: 700;
        }

        .step.completed .step-number {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .step.completed .step-number::after {
            content: '✓';
            font-size: 1.5rem;
        }

        .step.completed .step-title {
            color: var(--primary-dark);
        }

        /* Progress Bar */
        .progress-bar-steps {
            position: absolute;
            top: 75px;
            left: 100px;
            right: 100px;
            height: 4px;
            background: #E0E0E0;
            z-index: 1;
            border-radius: 2px;
        }

        .progress-bar-steps .progress {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-light) 0%, var(--primary) 100%);
            transition: width 0.6s ease;
            position: relative;
            border-radius: 2px;
        }

        .progress-bar-steps .progress::after {
            content: '✂';
            position: absolute;
            right: -15px;
            top: -15px;
            font-size: 30px;
            color: var(--primary);
            animation: scissors-bounce 1s ease-in-out infinite;
        }

        @keyframes scissors-bounce {
            0%, 100% { transform: translateY(0) rotate(-45deg); }
            50% { transform: translateY(-5px) rotate(-35deg); }
        }

        /* Content Area */
        .booking-content {
            padding: 50px 40px;
            min-height: 500px;
        }

        .booking-step {
            display: none;
            animation: fadeInUp 0.5s ease;
        }

        .booking-step.active {
            display: block;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .booking-step h3 {
            color: var(--gray-900);
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        /* Card Styling */
        .category-card,
        .service-card,
        .employee-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid transparent !important;
            border-radius: 15px !important;
            overflow: hidden;
            height: 100%;
            position: relative;
        }

        .category-card:hover,
        .service-card:hover,
        .employee-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(139, 92, 246, 0.15);
            border-color: var(--primary-light) !important;
        }

        .category-card.selected,
        .service-card.selected,
        .employee-card.selected {
            border-color: var(--primary) !important;
            background: linear-gradient(135deg, var(--gray-50) 0%, white 100%);
            box-shadow: 0 15px 40px rgba(139, 92, 246, 0.25);
        }

        .category-card.selected::before,
        .service-card.selected::before,
        .employee-card.selected::before {
            content: '✓';
            position: absolute;
            top: 15px;
            right: 15px;
            width: 35px;
            height: 35px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            z-index: 10;
        }

        .card-body {
            padding: 25px !important;
        }

        .card-title {
            color: var(--gray-900);
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .card-text {
            color: var(--gray-600);
            font-size: 0.95rem;
        }

        /* Calendar Styling */
        .table-calendar {
            margin: 0;
        }

        .table-calendar th {
            background: var(--gray-50);
            color: var(--gray-900);
            font-weight: 700;
            text-align: center;
            padding: 15px;
            border: none;
        }

        .calendar-day {
            width: 50px;
            height: 50px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 50%;
            position: relative;
        }

        .calendar-day:hover:not(.disabled) {
            background: var(--primary-light);
            color: white;
            transform: scale(1.1);
        }

        .calendar-day.selected {
            background: var(--primary);
            color: white;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }

        .calendar-day.disabled {
            color: #ccc;
            cursor: not-allowed;
            opacity: 0.5;
        }

        /* Time Slots */
        .time-slot {
            margin: 5px;
            padding: 12px 20px;
            border: 2px solid var(--primary-light);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            background: white;
            color: var(--primary);
        }

        .time-slot:hover:not(.disabled) {
            background: var(--primary-light);
            border-color: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.2);
        }

        .time-slot.selected {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* Footer Buttons */
        .booking-footer {
            padding: 30px 40px;
            background: var(--gray-50);
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .booking-footer .btn {
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-outline-secondary {
            background: white;
            color: var(--gray-900);
            border: 2px solid var(--gray-600) !important;
        }

        .btn-outline-secondary:hover:not(:disabled) {
            background: var(--gray-600);
            color: white;
            transform: translateX(-5px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(139, 92, 246, 0.4);
        }

        /* Summary Section */
        .summary-item {
            padding: 15px;
            border-bottom: 1px solid var(--gray-100);
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        /* Form Styling */
        .form-control,
        .form-select {
            border: 2px solid var(--gray-100);
            border-radius: 12px;
            padding: 12px 18px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.15);
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 8px;
        }

        /* Footer */
        footer {
            margin-top: 50px;
            text-align: center;
            color: white;
            padding: 30px 0;
        }

        footer a {
            color: white;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: var(--primary-light);
        }

        /* Animations */
        .animate-slide-in {
            animation: slideIn 0.5s ease forwards;
            opacity: 0;
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
        }

        /* Loading States */
        .spinner-border {
            color: var(--primary);
        }

        /* Modal Enhancements */
        .modal-header.bg-success {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%) !important;
        }

        .text-success {
            color: var(--primary) !important;
        }

        /* Selected Display Names */
        .selected-category-name,
        .selected-service-name,
        .selected-employee-name {
            color: var(--primary);
            font-size: 1.1rem;
            padding: 12px 20px;
            background: var(--gray-50);
            border-radius: 12px;
            border-left: 4px solid var(--primary);
        }

        /* Price Styling */
        .price-display {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .sale-price {
            color: var(--success);
        }

        .original-price {
            text-decoration: line-through;
            color: var(--gray-600);
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .booking-steps {
                padding: 40px 20px 20px;
            }

            .step-number {
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }

            .step-title {
                font-size: 0.75rem;
            }

            .progress-bar-steps {
                left: 50px;
                right: 50px;
                top: 60px;
            }

            .booking-header h2 {
                font-size: 1.8rem;
            }

            .booking-content {
                padding: 30px 20px;
            }

            .booking-footer {
                padding: 20px;
                flex-direction: column;
            }

            .booking-footer .btn {
                width: 100%;
            }
        }
    </style>

    @if ($setting->header)
        {!! $setting->header !!}
    @endif
</head>

<body>
    <header class="header-section">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-spa"></i> Ingrid Salon
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-1"></i>Register
                                </a>
                            </li>
                        @endguest

                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile') }}">
                                    <i class="fas fa-user me-1"></i>Profile
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="booking-container">
            <div class="booking-header">
                <h2><i class="fas fa-calendar-alt me-2"></i> Book Your Appointment</h2>
                <p class="mb-0">Pamper yourself in just a few simple steps</p>
            </div>

            <div class="booking-steps position-relative">
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-title">Category</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-title">Service</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-title">Staff</div>
                </div>
                <div class="step" data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-title">Date & Time</div>
                </div>
                <div class="step" data-step="5">
                    <div class="step-number">5</div>
                    <div class="step-title">Confirm</div>
                </div>
                <div class="progress-bar-steps">
                    <div class="progress"></div>
                </div>
            </div>

            <div class="booking-content">
                <!-- Step 1: Category Selection -->
                <div class="booking-step active" id="step1">
                    <h3 class="mb-4"><i class="fas fa-star me-2"></i> Select a Category</h3>
                    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center" id="categories-container">
                        <!-- Categories will be inserted here by jQuery -->
                    </div>
                </div>

                <!-- Step 2: Service Selection -->
                <div class="booking-step" id="step2">
                    <h3 class="mb-4"><i class="fas fa-cut me-2"></i> Select a Service</h3>
                    <div class="selected-category-name mb-3"></div>
                    <div class="row row-cols-1 row-cols-md-3 g-4" id="services-container">
                        <!-- Services will be loaded dynamically based on category -->
                    </div>
                </div>

                <!-- Step 3: Employee Selection -->
                <div class="booking-step" id="step3">
                    <h3 class="mb-4"><i class="fas fa-user-tie me-2"></i> Select a Staff Member</h3>
                    <div class="selected-service-name mb-3"></div>
                    <div class="row row-cols-1 row-cols-md-3 g-4" id="employees-container">
                        <!-- Employees will be loaded dynamically based on service -->
                    </div>
                </div>

                <!-- Step 4: Date and Time Selection -->
                <div class="booking-step" id="step4">
                    <h3 class="mb-4"><i class="fas fa-calendar me-2"></i> Select Date & Time</h3>
                    <div class="selected-employee-name mb-3"></div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <button class="btn btn-sm btn-outline-secondary" id="prev-month">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <h5 class="mb-0" id="current-month">March 2023</h5>
                                    <button class="btn btn-sm btn-outline-secondary" id="next-month">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-calendar">
                                        <thead>
                                            <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                            </tr>
                                        </thead>
                                        <tbody id="calendar-body">
                                            <!-- Calendar will be generated dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Available Time Slots</h5>
                                    <div id="selected-date-display" class="text-muted small"></div>
                                </div>
                                <div class="card-body">
                                    <div id="time-slots-container" class="d-flex flex-wrap">
                                        <div class="text-center text-muted w-100 py-4">
                                            Please select a date to view available times
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Confirmation -->
                <div class="booking-step" id="step5">
                    <h3 class="mb-4"><i class="fas fa-check-circle me-2"></i> Confirm Your Booking</h3>
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Booking Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="summary-item">
                                <div class="row">
                                    <div class="col-md-4 text-muted">Category:</div>
                                    <div class="col-md-8 fw-bold" id="summary-category"></div>
                                </div>
                            </div>
                            <div class="summary-item">
                                <div class="row">
                                    <div class="col-md-4 text-muted">Service:</div>
                                    <div class="col-md-8 fw-bold" id="summary-service"></div>
                                </div>
                            </div>
                            <div class="summary-item">
                                <div class="row">
                                    <div class="col-md-4 text-muted">Staff Member:</div>
                                    <div class="col-md-8 fw-bold" id="summary-employee"></div>
                                </div>
                            </div>
                            <div class="summary-item">
                                <div class="row">
                                    <div class="col-md-4 text-muted">Date & Time:</div>
                                    <div class="col-md-8 fw-bold" id="summary-datetime"></div>
                                </div>
                            </div>
                            <div class="summary-item">
                                <div class="row">
                                    <div class="col-md-4 text-muted">Duration:</div>
                                    <div class="col-md-8 fw-bold" id="summary-duration"></div>
                                </div>
                            </div>
                            <div class="summary-item">
                                <div class="row">
                                    <div class="col-md-4 text-muted">Price:</div>
                                    <div class="col-md-8 fw-bold price-display" id="summary-price"></div>
                                </div>
                            </div>

                           <div class="mt-4">
    <h5><i class="fas fa-user me-2"></i> Your Information</h5>

    @auth
    <div class="alert alert-success d-flex align-items-center mb-3">
        <i class="fas fa-check-circle me-2"></i>
        <div>Logged in as <strong>{{ auth()->user()->name }}</strong> — your details have been auto-filled.</div>
    </div>
    @endauth

    <form id="customer-info-form">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="customer-name" class="form-label">Full Name</label>
                <div class="position-relative">
                    <input
                        type="text"
                        class="form-control {{ auth()->check() ? 'pe-5' : '' }}"
                        id="customer-name"
                        value="{{ auth()->user()->name ?? '' }}"
                        {{ auth()->check() ? 'readonly' : 'required' }}>
                    @auth
                        <i class="fas fa-lock position-absolute text-muted"
                           style="right:12px; top:50%; transform:translateY(-50%); font-size:0.8rem;"></i>
                    @endauth
                </div>
            </div>
            <div class="col-md-6">
                <label for="customer-email" class="form-label">Email</label>
                <div class="position-relative">
                    <input
                        type="email"
                        class="form-control {{ auth()->check() ? 'pe-5' : '' }}"
                        id="customer-email"
                        value="{{ auth()->user()->email ?? '' }}"
                        {{ auth()->check() ? 'readonly' : 'required' }}>
                    @auth
                        <i class="fas fa-lock position-absolute text-muted"
                           style="right:12px; top:50%; transform:translateY(-50%); font-size:0.8rem;"></i>
                    @endauth
                </div>
            </div>
            <div class="col-md-12">
                <label for="customer-phone" class="form-label">Phone</label>
                <div class="position-relative">
                    <input
                        type="tel"
                        class="form-control {{ auth()->check() ? 'pe-5' : '' }}"
                        id="customer-phone"
                        value="{{ auth()->user()->phone ?? '' }}"
                        {{ auth()->check() ? 'readonly' : 'required' }}>
                    @auth
                        <i class="fas fa-lock position-absolute text-muted"
                           style="right:12px; top:50%; transform:translateY(-50%); font-size:0.8rem;"></i>
                    @endauth
                </div>
            </div>
            <div class="col-12">
                <label for="customer-notes" class="form-label">
                    <i class="fas fa-home me-1"></i>
                    If you selected HOME SERVICE Please leave your Full Address below
                </label>
                <textarea
                    class="form-control"
                    id="customer-notes"
                    rows="3"
                    placeholder="Enter your complete address for home service..."></textarea>
            </div>
        </div>
    </form>
</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="booking-footer">
                <button class="btn btn-outline-secondary" id="prev-step" disabled>
                    <i class="fas fa-arrow-left me-2"></i> Previous
                </button>
                <button class="btn btn-primary" id="next-step">
                    Next <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>

    <footer>
        <div class="container pb-2">
            <div class="row text-center">
                <span>Designed & Developed by <a target="_blank" href="https://www.facebook.com/ingridsalon88">Ingrid Salon Devs</a></span>
            </div>
        </div>
    </footer>

    <!-- Success Modal -->
    <div class="modal fade" id="bookingSuccessModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Booking Confirmed!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    <h4 class="mt-3">Thank You for Choosing Ingrid Salon</h4>
                    <p>Your appointment has been successfully booked.</p>
                    <div class="alert alert-info mt-3">
                        <p class="mb-0">A confirmation email has been sent to your email address.</p>
                    </div>
                    <div class="booking-details mt-4 text-start">
                        <h5>Booking Details:</h5>
                        <div id="modal-booking-details"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    const currentAuthUser = @json($authUser ?? null);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            const categories = @json($categories);
            const employees = @json($employees);

            // Initialize categories
            const container = $('#categories-container');
            let html = '';
            $.each(categories, function(index, category) {
                html += `
                    <div class="col">
                        <div class="card border h-100 category-card text-center rounded p-2" data-category="${category.id}">
                            <div class="card-body">
                                ${category.image ? `<img class="img-fluid w-25 mb-2" src="/uploads/images/category/${category.image}">` : ""}
                                <h5 class="card-title">${category.title}</h5>
                                <p class="card-text">${category.body}</p>
                            </div>
                        </div>
                    </div>
                `;
            });
            container.html(html);

            // Booking state
            let bookingState = {
                currentStep: 1,
                selectedCategory: null,
                selectedService: null,
                selectedEmployee: null,
                selectedDate: null,
                selectedTime: null
            };

            // Initialize the booking system
            updateProgressBar();
            generateCalendar();

            // Step navigation
            $("#next-step").click(function() {
                const currentStep = bookingState.currentStep;

                // Validate current step before proceeding
                if (!validateStep(currentStep)) {
                    return;
                }

                if (currentStep < 5) {
                    goToStep(currentStep + 1);
                } else {
                    // Submit booking
                    if ($("#customer-info-form")[0].checkValidity()) {
                        submitBooking();
                    } else {
                        $("#customer-info-form")[0].reportValidity();
                    }
                }
            });

            $("#prev-step").click(function() {
                if (bookingState.currentStep > 1) {
                    goToStep(bookingState.currentStep - 1);
                }
            });

            // Category selection
            $(document).on("click", ".category-card", function() {
                $(".category-card").removeClass("selected");
                $(this).addClass("selected");

                const categoryId = $(this).data("category");
                bookingState.selectedCategory = categoryId;

                // Reset subsequent selections
                bookingState.selectedService = null;
                bookingState.selectedEmployee = null;
                bookingState.selectedDate = null;
                bookingState.selectedTime = null;

                // Update the service step with services for this category
                updateServicesStep(categoryId);
            });

            // Service selection
            $(document).on("click", ".service-card", function() {
                $(".service-card").removeClass("selected");
                $(this).addClass("selected");

                const serviceId = $(this).data("service");
                const serviceTitle = $(this).find('.card-title').text();
                const servicePrice = $(this).find('.fw-bold').text();
                const serviceDuration = $(this).find('.card-text:contains("Duration:")').text().replace('Duration: ', '');

                // Store the selected service in booking state
                bookingState.selectedService = {
                    id: serviceId,
                    title: serviceTitle,
                    price: servicePrice,
                    duration: serviceDuration
                };

                // Reset subsequent selections
                bookingState.selectedEmployee = null;
                bookingState.selectedDate = null;
                bookingState.selectedTime = null;

                // Clear previous selections UI
                $(".employee-card").removeClass("selected");
                $("#selected-date").text("");
                $("#selected-time").text("");
                $("#employees-container").empty();

                // Show loading state for employees
                $("#employees-container").html(
                    '<div class="col-12 text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>'
                );

                // Update the employee step with employees for this service
                updateEmployeesStep(serviceId);
            });

            // Employee selection
            $(document).on("click", ".employee-card", function() {
                $(".employee-card").removeClass("selected");
                $(this).addClass("selected");

                const employeeId = $(this).data("employee");
                const employee = employees.find(e => e.id === employeeId);

                bookingState.selectedEmployee = employee;

                // Reset subsequent selections
                bookingState.selectedDate = null;
                bookingState.selectedTime = null;

                // Update the calendar
                updateCalendar();
            });

            // Date selection
            $(document).on("click", ".calendar-day:not(.disabled)", function() {
                $(".calendar-day").removeClass("selected");
                $(this).addClass("selected");

                const date = $(this).data("date");
                bookingState.selectedDate = date;

                // Update selected date display
                const formattedDate = new Date(date).toLocaleDateString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                $("#selected-date-display").text(`Selected: ${formattedDate}`);

                // Reset time selection
                bookingState.selectedTime = null;

                // Update time slots based on employee availability
                updateTimeSlots(date);
            });

            // Time slot selection
            $(document).on("click", ".time-slot:not(.disabled)", function() {
                $(".time-slot").removeClass("selected");
                $(this).addClass("selected");

                const time = $(this).data("time");
                bookingState.selectedTime = time;
                
                // Update booking summary when time is selected
                updateBookingSummary();
            });

            // Calendar navigation
            $("#prev-month").click(function() {
                navigateMonth(-1);
            });

            $("#next-month").click(function() {
                navigateMonth(1);
            });

            // Functions
            function goToStep(step) {
                // Hide all steps
                $(".booking-step").removeClass("active");

                // Show the target step
                $(`#step${step}`).addClass("active");

                // Update the step indicators
                $(".step").removeClass("active completed");

                for (let i = 1; i <= 5; i++) {
                    if (i < step) {
                        $(`.step[data-step="${i}"]`).addClass("completed");
                    } else if (i === step) {
                        $(`.step[data-step="${i}"]`).addClass("active");
                    }
                }

                // Update the current step
                bookingState.currentStep = step;

                // Update the navigation buttons
                updateNavigationButtons();

                // Update the progress bar
                updateProgressBar();

                // If we're on the confirmation step, update the summary
                if (step === 5) {
                    updateSummary();
                }

                // Scroll to top of booking container
                $(".booking-container")[0].scrollIntoView({
                    behavior: "smooth"
                });
            }

            function updateProgressBar() {
                const progress = ((bookingState.currentStep - 1) / 4) * 100;
                $(".progress-bar-steps .progress").css("width", `${progress}%`);
            }

            function updateNavigationButtons() {
                // Enable/disable previous button
                if (bookingState.currentStep === 1) {
                    $("#prev-step").prop("disabled", true);
                } else {
                    $("#prev-step").prop("disabled", false);
                }

                // Update next button text
                if (bookingState.currentStep === 5) {
                    $("#next-step").html('Confirm Booking <i class="fas fa-check-circle"></i>');
                } else {
                    $("#next-step").html('Next <i class="fas fa-arrow-right"></i>');
                }
            }

            function validateStep(step) {
                switch (step) {
                    case 1:
                        if (!bookingState.selectedCategory) {
                            alert("Please select a category");
                            return false;
                        }
                        return true;
                    case 2:
                        if (!bookingState.selectedService) {
                            alert("Please select a service");
                            return false;
                        }
                        return true;
                    case 3:
                        if (!bookingState.selectedEmployee) {
                            alert("Please select a staff member");
                            return false;
                        }
                        return true;
                    case 4:
                        if (!bookingState.selectedDate) {
                            alert("Please select a date");
                            return false;
                        }
                        if (!bookingState.selectedTime) {
                            alert("Please select a time slot");
                            return false;
                        }
                        return true;
                    default:
                        return true;
                }
            }

            function updateServicesStep(categoryId) {
                // Show loading state
                $("#services-container").html(
                    '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>'
                );

                // Make AJAX request to get services for this category
                $.ajax({
                    url: `/categories/${categoryId}/services`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success && response.services) {
                            const services = response.services;

                            // Update category name display
                            const selectedCategory = categories.find(cat => cat.id == categoryId);
                            $(".selected-category-name").text(
                                `Selected Category: ${selectedCategory?.title || ''}`);

                            // Clear services container
                            $("#services-container").empty();

                            // Add services with animation delay
                            services.forEach((service, index) => {
                                // Determine the price display
                                let priceDisplay;
                                if (service.sale_price) {
                                    priceDisplay =
                                        `<span class="text-decoration-line-through text-muted">₱${service.price}</span> <span class="fw-bold sale-price">₱${service.sale_price}</span>`;
                                } else {
                                    priceDisplay =
                                        `<span class="fw-bold price-display">₱${service.price}</span>`;
                                }

                                const serviceCard = `
                                    <div class="col animate-slide-in" style="animation-delay: ${index * 100}ms">
                                        <div class="card border h-100 service-card text-center p-2" data-service="${service.id}">
                                            <div class="card-body">
                                                ${service.image ? `<img class="img-fluid rounded mb-2" src="/uploads/images/service/${service.image}">` : ""}
                                                <h5 class="card-title mb-1">${service.title}</h5>
                                                <p class="card-text mb-1">${service.excerpt}</p>
                                                <p class="card-text">${priceDisplay}</p>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                $("#services-container").append(serviceCard);
                            });
                        } else {
                            $("#services-container").html(
                                '<div class="col-12 text-center py-5"><p>No services available for this category.</p></div>'
                            );
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        $("#services-container").html(
                            '<div class="col-12 text-center py-5"><p>Error loading services. Please try again.</p></div>'
                        );
                    }
                });
            }

            function updateEmployeesStep(serviceId) {
                // Show loading state
                $("#employees-container").html(
                    '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>'
                );

                // Make AJAX request to get employees for this service
                $.ajax({
                    url: `/services/${serviceId}/employees`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success && response.employees) {
                            const employees = response.employees;
                            const service = response.service;

                            // Update service name display
                            $(".selected-service-name").html(
                                `Selected Service: ${service.title} (${bookingState.selectedService.price})`
                            );

                            // Clear employees container
                            $("#employees-container").empty();

                            // Add employees with animation delay
                            employees.forEach((employee, index) => {
                                const employeeCard = `
                                <div class="col animate-slide-in" style="animation-delay: ${index * 100}ms">
                                    <div class="card border h-100 employee-card text-center p-2" data-employee="${employee.id}">
                                        <div class="card-body">
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                                ${employee.user.image ?
                                                    `<img src="/uploads/images/profile/${employee.user.image}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">` :
                                                    `<i class="fas fa-user text-primary" style="font-size: 2rem;"></i>`
                                                }
                                            </div>
                                            <h5 class="card-title">${employee.user.name}</h5>
                                            <p class="card-text text-muted">${employee.position || 'Professional'}</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                                $("#employees-container").append(employeeCard);
                            });
                        } else {
                            $("#employees-container").html(
                                '<div class="col-12 text-center py-5"><p>No employees available for this service.</p></div>'
                            );
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        $("#employees-container").html(
                            '<div class="col-12 text-center py-5"><p>Error loading employees. Please try again.</p></div>'
                        );
                    }
                });
            }

            function generateCalendar() {
                const today = new Date();
                const currentMonth = today.getMonth();
                const currentYear = today.getFullYear();

                renderCalendar(currentMonth, currentYear);
            }

            function renderCalendar(month, year) {
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const daysInMonth = lastDay.getDate();
                const startingDay = firstDay.getDay();

                // Update month display
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August",
                    "September", "October", "November", "December"
                ];
                $("#current-month").text(`${monthNames[month]} ${year}`);

                // Clear calendar
                $("#calendar-body").empty();

                // Build calendar
                let date = 1;
                for (let i = 0; i < 6; i++) {
                    const row = $("<tr></tr>");

                    for (let j = 0; j < 7; j++) {
                        if (i === 0 && j < startingDay) {
                            row.append("<td></td>");
                        } else if (date > daysInMonth) {
                            break;
                        } else {
                            const today = new Date();
                            const cellDate = new Date(year, month, date);
                            const formattedDate =
                                `${year}-${(month + 1).toString().padStart(2, '0')}-${date.toString().padStart(2, '0')}`;

                            const isPast = cellDate < new Date(today.setHours(0, 0, 0, 0));

                            const cell = $(
                                `<td class="text-center calendar-day${isPast ? ' disabled' : ''}" data-date="${formattedDate}">${date}</td>`
                            );

                            row.append(cell);
                            date++;
                        }
                    }

                    if (row.children().length > 0) {
                        $("#calendar-body").append(row);
                    }
                }
            }

            function navigateMonth(direction) {
                const currentMonthText = $("#current-month").text();
                const [monthName, year] = currentMonthText.split(" ");

                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August",
                    "September", "October", "November", "December"
                ];
                let month = monthNames.indexOf(monthName);
                let yearNum = parseInt(year);

                month += direction;

                if (month < 0) {
                    month = 11;
                    yearNum--;
                } else if (month > 11) {
                    month = 0;
                    yearNum++;
                }

                renderCalendar(month, yearNum);
            }

            function updateCalendar() {
                // Update employee name display
                const employee = bookingState.selectedEmployee;
                $(".selected-employee-name").text(`Selected Staff: ${employee.user.name}`);

                // Clear previous selections
                bookingState.selectedDate = null;
                bookingState.selectedTime = null;
                $(".calendar-day").removeClass("selected");
                $(".time-slot").removeClass("selected");

                // Show initial state
                $("#time-slots-container").html(`
                    <div class="text-center w-100 py-4">
                        <div class="alert alert-info">
                            <i class="fas fa-calendar-event me-2"></i>
                            Please select a date to view available time slots
                        </div>
                    </div>
                `);
            }

            function updateTimeSlots(selectedDate) {
                if (!selectedDate) {
                    $("#time-slots-container").html(`
                    <div class="text-center w-100 py-4">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            No date selected
                        </div>
                    </div>
                `);
                    return;
                }

                const employeeId = bookingState.selectedEmployee.id;
                const apiDate = new Date(selectedDate).toISOString().split('T')[0];

                // Show loading state
                $("#time-slots-container").html(`
                    <div class="text-center w-100 py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="mt-2">Checking availability...</div>
                    </div>
                `);

                $.ajax({
                    url: `/employees/${employeeId}/availability/${apiDate}`,
                    success: function(response) {
                        $("#time-slots-container").empty();

                        if (response.available_slots.length === 0) {
                            $("#time-slots-container").html(`
                    <div class="text-center py-4">
                        <div class="alert alert-warning">
                            <i class="fas fa-clock-history me-2"></i>
                            No available slots for this date
                        </div>
                        <button class="btn btn-sm btn-outline-primary mt-2" onclick="updateCalendar()">
                            <i class="fas fa-arrow-left me-1"></i> Back to calendar
                        </button>
                    </div>
                `);
                            return;
                        }

                        // Add slot duration info
                        $("#time-slots-container").append(`
                            <div class="slot-info mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Each slot: ${response.slot_duration} mins
                                        ${response.break_duration ? ` | Break: ${response.break_duration} mins` : ''}
                                    </small>
                                </div>
                            </div>
                        `);

                        // Add each time slot
                        const $slotsContainer = $("<div class='slots-grid'></div>");
                        response.available_slots.forEach(slot => {
                            const slotElement = $(`
                            <div class="time-slot btn btn-outline-primary mb-2"
                                data-start="${slot.start}"
                                data-end="${slot.end}"
                                title="Select ${slot.display}"
                                data-time="${slot.display}">
                                <i class="fas fa-clock me-1"></i>
                                ${slot.display}
                            </div>
                        `);

                            $slotsContainer.append(slotElement);
                        });
                        $("#time-slots-container").append($slotsContainer);
                    },
                    error: function(xhr) {
                        $("#time-slots-container").html(`
                            <div class="text-center py-4">
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-octagon me-2"></i>
                                    Error loading availability
                                </div>
                                <button class="btn btn-sm btn-outline-primary mt-2" onclick="updateTimeSlots('${selectedDate}')">
                                    <i class="fas fa-redo me-1"></i> Try again
                                </button>
                            </div>
                        `);
                    }
                });
            }

            function updateBookingSummary() {
                // This function updates the summary when time slot is selected
                // It's called from the time slot click handler
                console.log("Booking summary updated with time selection");
            }

            function updateSummary() {
                // Find the selected category
                const selectedCategory = categories.find(cat => cat.id == bookingState.selectedCategory);

                // Update summary with booking details
                $("#summary-category").text(selectedCategory ? selectedCategory.title : 'Not selected');

                // Update service info
                if (bookingState.selectedService) {
                    $("#summary-service").text(
                        `${bookingState.selectedService.title} (${bookingState.selectedService.price})`);
                    $("#summary-duration").text(`${bookingState.selectedService.duration || '30'} minutes`);
                    $("#summary-price").text(bookingState.selectedService.price);
                }

                // Update employee info
                if (bookingState.selectedEmployee) {
                    $("#summary-employee").text(bookingState.selectedEmployee.user.name);
                }

                // Update date/time info
                if (bookingState.selectedDate && bookingState.selectedTime) {
                    const formattedDate = new Date(bookingState.selectedDate).toLocaleDateString('en-US', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    $("#summary-datetime").text(
                        `${formattedDate} at ${bookingState.selectedTime}`);
                }
            }

            function submitBooking() {
                // Get form data
                const form = $('#customer-info-form');
                const csrfToken = form.find('input[name="_token"]').val();

                // Prepare booking data
                const bookingData = {
                    employee_id: bookingState.selectedEmployee.id,
                    service_id: bookingState.selectedService.id,
                    name: $('#customer-name').val(),
                    email: $('#customer-email').val(),
                    phone: $('#customer-phone').val(),
                    notes: $('#customer-notes').val(),
                    amount: parseFloat(bookingState.selectedService.price.replace(/[^0-9.]/g, '')),
                    booking_date: bookingState.selectedDate,
                    booking_time: bookingState.selectedTime,
                    status: 'Pending payment',
                    _token: csrfToken
                };

                // Add user_id if authenticated
                if (typeof currentAuthUser !== 'undefined' && currentAuthUser) {
                    bookingData.user_id = currentAuthUser.id;
                }

                // Show loading state
                const nextBtn = $("#next-step");
                nextBtn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status"></span> Processing...'
                );

                // Submit via AJAX
                $.ajax({
                    url: '/bookings',
                    method: 'POST',
                    data: bookingData,
                    success: function(response) {
                        // Update modal with booking details
                        const formattedDate = new Date(bookingState.selectedDate).toLocaleDateString(
                            'en-US', {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });

                        const bookingDetails = `
                                <div class="mb-2"><strong>Customer:</strong> ${$("#customer-name").val()}</div>
                                <div class="mb-2"><strong>Service:</strong> ${bookingState.selectedService.title}</div>
                                <div class="mb-2"><strong>Staff:</strong> ${bookingState.selectedEmployee.user.name}</div>
                                <div class="mb-2"><strong>Date & Time:</strong> ${formattedDate} at ${bookingState.selectedTime}</div>
                                 <div class="mb-2"><strong>Amount:</strong> ${bookingState.selectedService.price}</div>
                                <div><strong>Reference:</strong> ${response.booking_id || 'BK-' + Math.random().toString(36).substr(2, 8).toUpperCase()}</div>
                            `;

                        $('#modal-booking-details').html(bookingDetails);

                        // Show success modal
                        const successModal = new bootstrap.Modal(document.getElementById('bookingSuccessModal'));
                        successModal.show();

                        // Reset form after delay
                        setTimeout(resetBooking, 1000);
                    },
                    error: function(xhr) {
                        let errorMessage = 'Booking failed. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.status === 422) {
                            errorMessage = 'Validation error: Please check your information.';
                        }

                        alert(errorMessage);
                        nextBtn.prop('disabled', false).html(
                            'Confirm Booking <i class="fas fa-check-circle"></i>');
                    },
                    complete: function() {
                        if (nextBtn.prop('disabled')) {
                            setTimeout(() => {
                                nextBtn.prop('disabled', false).html(
                                    'Confirm Booking <i class="fas fa-check-circle"></i>');
                            }, 2000);
                        }
                    }
                });
            }

            function resetBooking() {
                // Reset booking state
                bookingState = {
                    currentStep: 1,
                    selectedCategory: null,
                    selectedService: null,
                    selectedEmployee: null,
                    selectedDate: null,
                    selectedTime: null
                };

                // Reset UI
                $(".category-card, .service-card, .employee-card, .calendar-day, .time-slot").removeClass(
                    "selected");
                $("#customer-info-form")[0].reset();

                // Go to first step
                goToStep(1);
            }
        });
    </script>

    @if ($setting->footer)
        {!! $setting->footer !!}
    @endif
</body>

</html>