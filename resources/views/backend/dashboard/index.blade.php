@extends('adminlte::page')

@section('title', 'Salon Appointments')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --primary-light: #8a6dcc;
        --primary-dark: #5a4fcf;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --bg-light: #f8fafc;
        --bg-dark: #0f172a;
        --card-light: #ffffff;
        --card-dark: #1e293b;
        --text-light: #334155;
        --text-dark: #e2e8f0;
        --border-light: #e2e8f0;
        --border-dark: #334155;
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
        --shadow-md: 0 8px 25px rgba(0,0,0,0.12);
        --shadow-lg: 0 20px 50px rgba(0,0,0,0.15);
        --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --border-radius: 16px;
    }

    /* Base Styles */
    body {
        background: var(--bg-light);
        color: var(--text-light);
        transition: var(--transition);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        line-height: 1.6;
    }

    body.dark-mode {
        background: var(--bg-dark);
        color: var(--text-dark);
    }

    /* Modern Container */
    .modern-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Header Section - FIXED */
    .content-header-modern {
        background: var(--card-light);
        padding: 2.5rem;
        border-radius: var(--border-radius);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-light);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .content-header-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    body.dark-mode .content-header-modern {
        background: var(--card-dark);
        border-color: var(--border-dark);
    }

    /* Header Content - FIXED ALIGNMENT */
    .header-content-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .header-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-light);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
        letter-spacing: -0.025em;
    }

    body.dark-mode .header-title {
        color: var(--text-dark);
    }

    .header-icon {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2rem;
    }

    .header-subtitle {
        color: #64748b;
        font-size: 1.1rem;
        margin: 0.75rem 0 0 0;
        font-weight: 500;
    }

    body.dark-mode .header-subtitle {
        color: #94a3b8;
    }

    /* Theme Toggle - FIXED */
    .btn-theme-toggle {
        background: var(--card-light);
        border: 2px solid var(--border-light);
        color: var(--text-light);
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        transition: var(--transition);
        cursor: pointer;
        box-shadow: var(--shadow-sm);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-theme-toggle:hover {
        background: var(--primary-gradient);
        border-color: transparent;
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    body.dark-mode .btn-theme-toggle {
        background: var(--card-dark);
        border-color: var(--border-dark);
        color: var(--text-dark);
    }

    /* Stats Cards - FIXED HOVER */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-light);
        padding: 2rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-light);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: var(--primary-light);
    }

    body.dark-mode .stat-card {
        background: var(--card-dark);
        border-color: var(--border-dark);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        background: var(--primary-gradient);
        color: white;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-light);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    body.dark-mode .stat-value {
        color: var(--text-dark);
    }

    .stat-label {
        color: #64748b;
        font-weight: 600;
        font-size: 0.95rem;
    }

    body.dark-mode .stat-label {
        color: #94a3b8;
    }

    /* Calendar Section - FIXED PADDING */
    .calendar-section {
        background: var(--card-light);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-light);
        overflow: hidden;
        transition: var(--transition);
    }

    body.dark-mode .calendar-section {
        background: var(--card-dark);
        border-color: var(--border-dark);
    }

    .calendar-header {
        padding: 2rem 2rem 1.5rem;
        border-bottom: 2px solid var(--border-light);
    }

    body.dark-mode .calendar-header {
        border-bottom-color: var(--border-dark);
    }

    .calendar-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-light);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    body.dark-mode .calendar-title {
        color: var(--text-dark);
    }

    /* FIXED - Consistent padding */
    .calendar-wrapper {
        padding: 2rem;
    }

    /* FullCalendar Customization */
    .fc {
        font-family: 'Inter', sans-serif;
    }

    .fc-toolbar {
        padding: 1.5rem 0;
        border-bottom: none;
        margin-bottom: 1.5rem;
    }

    .fc-toolbar h2 {
        color: var(--text-light) !important;
        font-weight: 700;
        font-size: 1.5rem;
    }

    body.dark-mode .fc-toolbar h2 {
        color: var(--text-dark) !important;
    }

    .fc-button {
        background: var(--card-light) !important;
        border: 2px solid var(--border-light) !important;
        color: var(--text-light) !important;
        border-radius: 10px !important;
        padding: 0.75rem 1.25rem !important;
        font-weight: 600 !important;
        transition: var(--transition) !important;
        box-shadow: none !important;
        text-transform: none !important;
    }

    .fc-button:hover {
        background: var(--primary-gradient) !important;
        border-color: transparent !important;
        color: white !important;
        transform: translateY(-2px);
    }

    .fc-button.fc-state-active {
        background: var(--primary-gradient) !important;
        border-color: transparent !important;
        color: white !important;
    }

    body.dark-mode .fc-button {
        background: var(--card-dark) !important;
        border-color: var(--border-dark) !important;
        color: var(--text-dark) !important;
    }

    .fc-day-header {
        background: var(--bg-light);
        color: var(--text-light);
        font-weight: 600;
        padding: 1rem;
        border-color: var(--border-light) !important;
    }

    body.dark-mode .fc-day-header {
        background: var(--bg-dark);
        color: var(--text-dark);
        border-color: var(--border-dark) !important;
    }

    .fc-day {
        border-color: var(--border-light) !important;
        transition: var(--transition);
    }

    body.dark-mode .fc-day {
        border-color: var(--border-dark) !important;
        background: var(--card-dark);
    }

    .fc-day:hover {
        background: rgba(102, 126, 234, 0.05);
    }

    body.dark-mode .fc-day:hover {
        background: rgba(102, 126, 234, 0.1);
    }

    .fc-today {
        background: rgba(102, 126, 234, 0.1) !important;
    }

    /* Event Styling */
    .fc-event {
        border: none !important;
        border-radius: 8px !important;
        padding: 0.5rem 0.75rem !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        box-shadow: var(--shadow-sm) !important;
        transition: var(--transition) !important;
    }

    .fc-event:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-md) !important;
    }

    /* Modal Styling - FIXED BACKDROP */
    .modal-backdrop.show {
        opacity: 0.7;
    }

    body.dark-mode .modal-backdrop {
        background-color: #000;
        opacity: 0.85;
    }

    .modern-modal {
        border: none;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    body.dark-mode .modern-modal {
        background: var(--card-dark);
    }

    .modal-header-modern {
        background: var(--primary-gradient);
        color: white;
        padding: 2rem;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .modal-title-modern {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .modal-subtitle {
        font-size: 0.95rem;
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
        font-weight: 500;
    }

    .btn-modal-close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        font-size: 1.1rem;
    }

    .btn-modal-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .modal-body-modern {
        padding: 2rem;
        background: var(--card-light);
    }

    body.dark-mode .modal-body-modern {
        background: var(--card-dark);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .detail-item label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    body.dark-mode .detail-item label {
        color: #94a3b8;
    }

    .detail-item span {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-light);
        padding: 0.75rem;
        background: var(--bg-light);
        border-radius: 8px;
        border: 1px solid var(--border-light);
    }

    body.dark-mode .detail-item span {
        color: var(--text-dark);
        background: var(--bg-dark);
        border-color: var(--border-dark);
    }

    .detail-full {
        grid-column: 1 / -1;
    }

    .status-update-section {
        padding: 1.5rem;
        background: var(--bg-light);
        border-radius: 12px;
        border: 2px dashed var(--border-light);
    }

    body.dark-mode .status-update-section {
        background: var(--bg-dark);
        border-color: var(--border-dark);
    }

    .status-label {
        font-weight: 700;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    body.dark-mode .status-label {
        color: var(--text-dark);
    }

    .form-control-modern {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid var(--border-light);
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 500;
        transition: var(--transition);
        background: var(--card-light);
        color: var(--text-light);
    }

    .form-control-modern:focus {
        border-color: var(--primary-light);
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-1px);
    }

    body.dark-mode .form-control-modern {
        background: var(--card-dark);
        border-color: var(--border-dark);
        color: var(--text-dark);
    }

    .modal-footer-modern {
        padding: 1.5rem 2rem;
        border: none;
        background: var(--bg-light);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    body.dark-mode .modal-footer-modern {
        background: var(--bg-dark);
    }

    .btn-modern {
        padding: 1rem 2rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: var(--transition);
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-modern.btn-primary {
        background: var(--primary-gradient);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .btn-modern.btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-modern.btn-secondary {
        background: var(--card-light);
        color: var(--text-light);
        border: 2px solid var(--border-light);
    }

    .btn-modern.btn-secondary:hover {
        background: var(--border-light);
        transform: translateY(-2px);
    }

    body.dark-mode .btn-modern.btn-secondary {
        background: var(--card-dark);
        color: var(--text-dark);
        border-color: var(--border-dark);
    }

    /* Status Badges */
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-block;
    }

    /* Alerts - FIXED POSITIONING */
    .alert-modern {
        border: none;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        box-shadow: var(--shadow-sm);
        border-left: 4px solid;
        margin-top: 1.5rem;
    }

    .alert-modern.alert-success {
        background: #f0fdf4;
        border-left-color: var(--success);
        color: #065f46;
    }

    .alert-modern.alert-danger {
        background: #fef2f2;
        border-left-color: var(--danger);
        color: #991b1b;
    }

    body.dark-mode .alert-modern.alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: #6ee7b7;
    }

    body.dark-mode .alert-modern.alert-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #fca5a5;
    }

    .alert-modern .alert-content {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
    }

    .alert-modern .close {
        opacity: 0.7;
        transition: var(--transition);
        background: none;
        border: none;
        font-size: 1.25rem;
    }

    .alert-modern .close:hover {
        opacity: 1;
        transform: scale(1.1);
    }

    /* Responsive Design - FIXED */
    @media (max-width: 1024px) {
        .modern-container {
            padding: 0 15px;
        }
        
        .content-header-modern {
            padding: 2rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .calendar-wrapper {
            padding: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .content-header-modern {
            padding: 1.5rem;
        }

        .header-content-wrapper {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-theme-toggle {
            width: 100%;
            justify-content: center;
        }

        .header-title {
            font-size: 1.75rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .modal-body-modern {
            padding: 1.5rem;
        }

        .modal-header-modern {
            padding: 1.5rem;
        }

        .fc-toolbar {
            flex-direction: column;
            gap: 1rem;
        }

        .calendar-wrapper {
            padding: 1rem;
        }
    }

    @media (max-width: 480px) {
        .modal-footer-modern {
            flex-direction: column;
        }

        .btn-modern {
            width: 100%;
            justify-content: center;
        }

        .stat-card {
            padding: 1.5rem;
        }

        .stat-value {
            font-size: 2rem;
        }
    }
</style>

<div class="modern-container">
    <!-- Header Section -->
    <div class="content-header-modern">
        <div class="header-content-wrapper">
            <div>
                <h1 class="header-title">
                    <i class="fas fa-calendar-check header-icon"></i>
                    Salon Appointments
                </h1>
                <p class="header-subtitle">Manage and track all your salon bookings efficiently</p>
            </div>
            
            <button id="themeToggle" class="btn-theme-toggle">
                <i class="fas fa-moon"></i>
                <span>Dark Mode</span>
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-modern alert-success alert-dismissible fade show">
                <div class="alert-content">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-modern alert-danger alert-dismissible fade show">
                <div class="alert-content">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    </div>

    <!-- Stats Overview -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-value">{{ $stats['today'] ?? 0 }}</div>
            <div class="stat-label">Today's Appointments</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-value">{{ $stats['confirmed'] ?? 0 }}</div>
            <div class="stat-label">Confirmed</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="stat-value">{{ $stats['pending'] ?? 0 }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="stat-value">{{ $stats['weekly'] ?? 0 }}</div>
            <div class="stat-label">This Week</div>
        </div>
    </div>

    <!-- Calendar Section -->
    <div class="calendar-section">
        <div class="calendar-header">
            <h3 class="calendar-title">
                <i class="fas fa-calendar-alt"></i>
                Appointment Calendar
            </h3>
        </div>
        <div class="calendar-wrapper">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<!-- Appointment Modal -->
<form id="appointmentStatusForm" method="POST" action="{{ route('dashboard.update.status') }}">
    @csrf
    <input type="hidden" name="appointment_id" id="modalAppointmentId">

    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modern-modal">
                <div class="modal-header-modern">
                    <div>
                        <h5 class="modal-title-modern">
                            <i class="fas fa-calendar-alt"></i>
                            Appointment Details
                        </h5>
                        <p class="modal-subtitle">View and manage appointment information</p>
                    </div>
                    <button type="button" class="btn-modal-close" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="modal-body-modern">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <label><i class="fas fa-user"></i> Client Name</label>
                            <span id="modalAppointmentName">N/A</span>
                        </div>
                        <div class="detail-item">
                            <label><i class="fas fa-cut"></i> Service</label>
                            <span id="modalService">N/A</span>
                        </div>
                        <div class="detail-item">
                            <label><i class="fas fa-envelope"></i> Email</label>
                            <span id="modalEmail">N/A</span>
                        </div>
                        <div class="detail-item">
                            <label><i class="fas fa-phone"></i> Phone</label>
                            <span id="modalPhone">N/A</span>
                        </div>
                        <div class="detail-item">
                            <label><i class="fas fa-user-tie"></i> Assigned Staff</label>
                            <span id="modalStaff">N/A</span>
                        </div>
                        <div class="detail-item">
                            <label><i class="fas fa-clock"></i> Date & Time</label>
                            <span id="modalStartTime">N/A</span>
                        </div>
                        <div class="detail-item">
                            <label><i class="fas fa-money-bill"></i> Amount</label>
                            <span id="modalAmount">N/A</span>
                        </div>
                        <div class="detail-item">
                            <label><i class="fas fa-info-circle"></i> Current Status</label>
                            <span id="modalStatusBadge">N/A</span>
                        </div>
                        <div class="detail-item detail-full">
                            <label><i class="fas fa-sticky-note"></i> Additional Notes</label>
                            <span id="modalNotes">N/A</span>
                        </div>
                    </div>

                    <div class="status-update-section">
                        <label class="status-label">
                            <i class="fas fa-edit"></i> Update Appointment Status
                        </label>
                        <select name="status" class="form-control-modern" id="modalStatusSelect">
                            <option value="Pending payment">Pending payment</option>
                            <option value="Processing">Processing</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Completed">Completed</option>
                            <option value="On Hold">On Hold</option>
                            <option value="No Show">No Show</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer-modern">
                    <button type="button" class="btn-modern btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button type="submit" class="btn-modern btn-primary">
                        <i class="fas fa-check"></i> Update Status
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" />
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>
<script>
    // Theme Toggle
    const themeToggle = document.getElementById('themeToggle');
    const currentTheme = localStorage.getItem('theme') || 'light';
    
    function setTheme(mode) {
        document.body.classList.remove('light-mode', 'dark-mode');
        document.body.classList.add(mode + '-mode');
        localStorage.setItem('theme', mode);
        
        const icon = themeToggle.querySelector('i');
        const text = themeToggle.querySelector('span');
        
        if (mode === 'dark') {
            icon.className = 'fas fa-sun';
            text.textContent = 'Light Mode';
        } else {
            icon.className = 'fas fa-moon';
            text.textContent = 'Dark Mode';
        }
    }

    themeToggle.addEventListener('click', () => {
        const isDark = document.body.classList.contains('dark-mode');
        setTheme(isDark ? 'light' : 'dark');
    });

    setTheme(currentTheme);

    // Calendar Setup
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: { 
                left: 'prev,next today', 
                center: 'title', 
                right: 'month,agendaWeek,agendaDay' 
            },
            defaultView: 'month',
            editable: false,
            slotDuration: '00:30:00',
            minTime: '06:00:00',
            maxTime: '22:00:00',
            events: @json($appointments ?? []),
            eventRender: function(event, element) {
                // Add custom styling based on status
                const statusColors = {
                    'Pending payment': '#f59e0b',
                    'Processing': '#3b82f6',
                    'Confirmed': '#10b981',
                    'Cancelled': '#ef4444',
                    'Completed': '#059669',
                    'On Hold': '#6b7280',
                    'No Show': '#d97706'
                };
                
                element.css({
                    'background': statusColors[event.status] || '#667eea',
                    'border': 'none',
                    'color': 'white'
                });
            },
            eventClick: function(calEvent) {
                $('#modalAppointmentId').val(calEvent.id);
                $('#modalAppointmentName').text(calEvent.name || 'N/A');
                $('#modalService').text(calEvent.service_title || 'N/A');
                $('#modalEmail').text(calEvent.email || 'N/A');
                $('#modalPhone').text(calEvent.phone || 'N/A');
                $('#modalStaff').text(calEvent.staff || 'N/A');
                $('#modalAmount').text(calEvent.amount ? '₱' + calEvent.amount : 'N/A');
                $('#modalNotes').text(calEvent.description || 'No additional notes');
                $('#modalStartTime').text(moment(calEvent.start).format('dddd, MMMM D, YYYY [at] h:mm A'));

                let status = calEvent.status || 'Pending payment';
                $('#modalStatusSelect').val(status);
                
                let statusColors = {
                    'Pending payment': '#f59e0b',
                    'Processing': '#3b82f6',
                    'Confirmed': '#10b981',
                    'Cancelled': '#ef4444',
                    'Completed': '#059669',
                    'On Hold': '#6b7280',
                    'No Show': '#d97706'
                };
                
                $('#modalStatusBadge').html(
                    `<span class="status-badge text-white" style="background-color:${statusColors[status]}">${status}</span>`
                );
                
                $('#appointmentModal').modal('show');
            }
        });

        // Auto-hide alerts
        $(".alert").delay(5000).slideUp(400);
    });
</script>
@stop