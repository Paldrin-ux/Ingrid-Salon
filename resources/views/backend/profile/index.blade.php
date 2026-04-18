@extends('adminlte::page')
@section('title', 'User Profile')

@section('content_header')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1 font-weight-bold text-dark">
                <i class="fas fa-user-circle mr-2 text-primary"></i>User Profile
            </h1>
            <p class="text-muted mb-0 small">Manage your profile and appointments</p>
        </div>
        @if (Auth::check() && Auth::user()->hasRole('subscriber'))
            <a href="{{ route('frontend') }}" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-home mr-1"></i> Book Now!
            </a>
        @endif
    </div>
@stop

@section('content')
<style>
    /* Modern Card Styles */
    .profile-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .profile-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    }

    /* Profile Image Styling */
    .profile-img-container {
        position: relative;
        width: 140px;
        height: 140px;
        margin: 0 auto 20px;
    }
    
    .profile-user-img {
        width: 140px;
        height: 140px;
        border: 4px solid #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        object-fit: cover;
    }
    
    .profile-img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .profile-img-container:hover .profile-img-overlay {
        opacity: 1;
    }

    /* Tab Styling */
    .nav-pills .nav-link {
        border-radius: 10px;
        padding: 10px 20px;
        margin-right: 5px;
        color: #6c757d;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
        color: #007bff;
    }
    
    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    /* Info List Styling */
    .info-list {
        list-style: none;
        padding: 0;
    }
    
    .info-list-item {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.2s;
    }
    
    .info-list-item:hover {
        background-color: #f8f9fa;
    }
    
    .info-list-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #495057;
        display: flex;
        align-items: center;
    }
    
    .info-label i {
        margin-right: 8px;
        color: #667eea;
    }

    /* Form Styling */
    .custom-form-group {
        margin-bottom: 25px;
    }
    
    .custom-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }
    
    .custom-label i {
        margin-right: 8px;
        color: #667eea;
    }
    
    .form-control {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        padding: 10px 15px;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    /* Button Styling */
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 10px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-outline-custom {
        border: 2px solid #667eea;
        color: #667eea;
        background: transparent;
        border-radius: 8px;
        padding: 8px 20px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-outline-custom:hover {
        background: #667eea;
        color: white;
    }

    /* Status Badge */
    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* Table Styling */
    .custom-table {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .custom-table thead th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        border: none;
        padding: 15px;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    .custom-table tbody tr {
        transition: all 0.2s;
    }
    
    .custom-table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }
    
    .custom-table tbody td {
        padding: 15px;
        vertical-align: middle;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    
    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 20px;
    }
    
    .modal-header .close {
        color: white;
        opacity: 0.8;
        text-shadow: none;
    }
    
    .modal-header .close:hover {
        opacity: 1;
    }
    
    .modal-body {
        padding: 30px;
    }

    /* Alert Styling */
    .alert {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Time Slot Styling */
    .time-slot-row {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        border-left: 4px solid #667eea;
    }

    /* Switch Styling */
    .custom-switch .custom-control-label::before {
        background-color: #e9ecef;
        border: none;
    }
    
    .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Holiday Row Styling */
    .holiday-row {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 15px;
        border: 2px solid #e9ecef;
        transition: all 0.3s;
    }
    
    .holiday-row:hover {
        border-color: #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    }

    /* Icon Badges */
    .icon-badge {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    /* Section Headers */
    .section-header {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
    }
    
    .section-header h4 {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 5px;
    }
    
    .section-header small {
        color: #718096;
    }

    /* Action Buttons */
    .action-btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s;
    }
    
    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
</style>

@if ($user->appointments->count())
    <div class="modal fade" id="CustomerBookings" tabindex="-1" role="dialog" aria-labelledby="CustomerBookingsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CustomerBookingsLabel">
                        <i class="fas fa-calendar-check mr-2"></i>Appointment Details
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-user mr-2"></i>Client Name</label>
                            <p class="font-weight-bold" id="modalUserName"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-cut mr-2"></i>Service</label>
                            <p class="font-weight-bold" id="modalService"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-user-tie mr-2"></i>Staff Member</label>
                            <p class="font-weight-bold" id="modalStaff"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-dollar-sign mr-2"></i>Amount</label>
                            <p class="font-weight-bold" id="modalAmount"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-calendar mr-2"></i>Date</label>
                            <p class="font-weight-bold" id="modalDate"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-clock mr-2"></i>Time</label>
                            <p class="font-weight-bold" id="modalTime"></p>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-sticky-note mr-2"></i>Notes</label>
                            <p class="font-weight-bold" id="modalNotes"></p>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small mb-1"><i class="fas fa-info-circle mr-2"></i>Status</label>
                            <div id="modalStatusBadge"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($user->employee && $user->employee->appointments)
    <form id="appointmentStatusForm" method="POST" action="{{ route('appointments.update.status') }}">
        @csrf
        <input type="hidden" name="appointment_id" id="modalAppointmentId">
        <div class="modal fade" id="appointmentModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-calendar-alt mr-2"></i>Appointment Details
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small mb-1"><i class="fas fa-user mr-2"></i>Client</label>
                                <p class="font-weight-bold" id="modalAppointmentName">N/A</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small mb-1"><i class="fas fa-cut mr-2"></i>Service</label>
                                <p class="font-weight-bold" id="Service">N/A</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small mb-1"><i class="fas fa-envelope mr-2"></i>Email</label>
                                <p class="font-weight-bold" id="modalEmail">N/A</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small mb-1"><i class="fas fa-phone mr-2"></i>Phone</label>
                                <p class="font-weight-bold" id="modalPhone">N/A</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small mb-1"><i class="fas fa-user-tie mr-2"></i>Staff</label>
                                <p class="font-weight-bold" id="Staff">N/A</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small mb-1"><i class="fas fa-clock mr-2"></i>Start Time</label>
                                <p class="font-weight-bold" id="modalStartTime">N/A</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small mb-1"><i class="fas fa-dollar-sign mr-2"></i>Amount</label>
                                <p class="font-weight-bold" id="Amount">N/A</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small mb-1"><i class="fas fa-info-circle mr-2"></i>Current Status</label>
                                <div id="modalStatusBadgeforEmployee"></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="text-muted small mb-1"><i class="fas fa-sticky-note mr-2"></i>Notes</label>
                                <p class="font-weight-bold" id="Notes">N/A</p>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif

<div class="modal fade" id="profileImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('user.profile.image.update', $user->id) }}" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-image mr-2"></i>Update Profile Picture
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    @error('image')
                        <span class="text-danger d-block mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Close
                    </button>
                    <button type="submit" class="btn btn-gradient">
                        <i class="fas fa-save mr-1"></i>Save changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x mr-3"></i>
                    <div>
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fa-2x mr-3"></i>
                    <strong>{{ session('success') }}</strong>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <div class="row">
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card profile-card">
                    <div class="card-body text-center py-4">
                        <div class="profile-img-container">
                            <img class="profile-user-img img-fluid img-circle" src="{{ $user->profileImage() }}" alt="User profile picture">
                            <div class="profile-img-overlay">
                                <a data-toggle="modal" data-target="#profileImageModal" class="text-white">
                                    <i class="fas fa-camera fa-2x"></i>
                                </a>
                            </div>
                        </div>
                        
                        <h3 class="font-weight-bold mb-1">{{ $user->name }}</h3>
                        <p class="text-muted mb-3">{{ $user->email }}</p>
                        
                        @if ($user->image)
                            <form action="{{ route('delete.profile.image', $user->id) }}" method="post" class="mb-3">
                                @csrf
                                @method('PATCH')
                                <button onclick="return confirm('Are you sure you want to remove profile image?')" type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash mr-1"></i>Remove Image
                                </button>
                            </form>
                        @endif
                        
                        <ul class="info-list mt-4">
                            <li class="info-list-item">
                                <span class="info-label"><i class="fas fa-sign-in-alt"></i>Last Login</span>
                                <span class="text-muted small">{{ $user->lastSuccessfulLoginAt() ? $user->lastSuccessfulLoginAt()->diffForHumans() : 'NA' }}</span>
                            </li>
                            <li class="info-list-item">
                                <span class="info-label"><i class="fas fa-calendar-plus"></i>Joined</span>
                                <span class="text-muted small">{{ $user->created_at->diffForHumans() }}</span>
                            </li>
                            <li class="info-list-item">
                                <span class="info-label"><i class="fas fa-user-tag"></i>Role</span>
                                <span class="badge badge-primary">{{ ucwords($user->getRoleNames()->first()) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-lg-9">
                <div class="card profile-card">
                    <div class="card-header bg-white border-0 pt-3">
                        <ul class="nav nav-pills flex-wrap">
                            <ul class="nav nav-pills flex-wrap">
    <li class="nav-item mb-2">
        <a class="nav-link active" href="#settings" data-toggle="tab">
            <i class="fas fa-user-edit mr-1"></i>Profile
        </a>
    </li>
    <li class="nav-item mb-2">
        <a class="nav-link" href="#logs" data-toggle="tab">
            <i class="fas fa-history mr-1"></i>Activity Logs
        </a>
    </li>
    
    {{-- Show Bio tab if user has employee record --}}
    @if ($user->employee)
        <li class="nav-item mb-2">
            <a class="nav-link" href="#bio" data-toggle="tab">
                <i class="fas fa-address-card mr-1"></i>Bio
            </a>
        </li>
        
        {{-- Only show Availability and Appointments tabs if NOT admin --}}
        @if (!$user->hasRole('admin'))
            <li class="nav-item mb-2">
                <a class="nav-link" href="#availibility" data-toggle="tab">
                    <i class="fas fa-calendar-check mr-1"></i>Availability
                </a>
            </li>
            @if ($user->employee->appointments)
                <li class="nav-item mb-2">
                    <a class="nav-link" href="#appointments" data-toggle="tab">
                        <i class="fas fa-clipboard-list mr-1"></i>Appointments
                    </a>
                </li>
            @endif
        @endif
    @endif
    
    {{-- Show bookings tab for all users if they have bookings --}}
    @if ($user->appointments->count())
        <li class="nav-item mb-2">
            <a class="nav-link" href="#bookings" data-toggle="tab">
                <i class="fas fa-book mr-1"></i>My Bookings
            </a>
        </li>
    @endif
    
    <li class="nav-item mb-2">
        <a class="nav-link" href="#password" data-toggle="tab">
            <i class="fas fa-lock mr-1"></i>Password
        </a>
    </li>
</ul>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="settings">
                                <div class="section-header">
                                    <h4><i class="fas fa-user-edit mr-2"></i>Profile Information</h4>
                                    <small>Update your personal details</small>
                                </div>
                                
                                <form action="{{ route('user.profile.update', $user->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="custom-form-group">
                                        <label for="inputName" class="custom-label">
                                            <i class="fas fa-user"></i>Full Name
                                        </label>
                                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter your name" value="{{ $user->name }}">
                                    </div>
                                    
                                    <div class="custom-form-group">
                                        <label for="inputEmail" class="custom-label">
                                            <i class="fas fa-envelope"></i>Email Address
                                        </label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Enter your email" value="{{ $user->email }}">
                                        @error('email')
                                            <span class="text-danger small mt-1 d-block"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mt-4">
                                        <button onclick="return confirm('Are you sure you want to update your profile?')" type="submit" class="btn btn-gradient">
                                            <i class="fas fa-save mr-2"></i>Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="logs">
                                <div class="section-header">
                                    <h4><i class="fas fa-history mr-2"></i>Activity Logs</h4>
                                    <small>Your login and logout history</small>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table custom-table">
                                        <thead>
                                            <tr>
                                                <th><i class="fas fa-sign-in-alt mr-2"></i>Login Time</th>
                                                <th><i class="fas fa-sign-out-alt mr-2"></i>Logout Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->authentications as $auth)
                                                <tr>
                                                    <td>{{ $auth->login_at ? $auth->login_at->format('H:i | d M Y') : 'NA' }}</td>
                                                    <td>{{ $auth->logout_at ? $auth->logout_at->format('H:i | d M Y') : 'NA' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @if ($user->employee)
                                <div class="tab-pane" id="bio">
                                    <div class="section-header">
                                        <h4><i class="fas fa-address-card mr-2"></i>Professional Bio</h4>
                                        <small>Share your experience and social profiles</small>
                                    </div>
                                    
                                    <form action="{{ route('employee.bio.update', $user->employee->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="custom-form-group">
                                            <label for="inputExperience" class="custom-label">
                                                <i class="fas fa-user-circle"></i>About Me
                                            </label>
                                            <textarea class="form-control" id="inputExperience" placeholder="Tell us about yourself, your experience, and specialties..." rows="8" name="bio">{{ $user->employee->bio }}</textarea>
                                        </div>
                                        
                                        <div class="section-header mt-4">
                                            <h5><i class="fas fa-share-alt mr-2"></i>Social Media Links</h5>
                                            <small>Connect your social media profiles</small>
                                        </div>
                                        
                                        <div class="custom-form-group">
                                            <label class="custom-label">
                                                <i class="fab fa-facebook"></i>Facebook
                                            </label>
                                            <input type="text" class="form-control" name="social[facebook]" placeholder="www.facebook.com/your-profile" value="{{ $user->employee->social['facebook'] ?? '' }}">
                                        </div>
                                        
                                        <div class="custom-form-group">
                                            <label class="custom-label">
                                                <i class="fab fa-instagram"></i>Instagram
                                            </label>
                                            <input type="text" class="form-control" name="social[instagram]" placeholder="www.instagram.com/your-profile" value="{{ $user->employee->social['instagram'] ?? '' }}">
                                        </div>
                                        
                                        <div class="custom-form-group">
                                            <label class="custom-label">
                                                <i class="fab fa-twitter"></i>Twitter
                                            </label>
                                            <input type="text" class="form-control" name="social[twitter]" placeholder="www.x.com/your-profile" value="{{ $user->employee->social['twitter'] ?? '' }}">
                                        </div>
                                        
                                        <div class="custom-form-group">
                                            <label class="custom-label">
                                                <i class="fab fa-linkedin"></i>LinkedIn
                                            </label>
                                            <input type="text" class="form-control" name="social[linkedin]" placeholder="www.linkedin.com/your-profile" value="{{ $user->employee->social['linkedin'] ?? '' }}">
                                        </div>
                                        
                                        <div class="mt-4">
                                            <button onclick="return confirm('Are you sure you want to update your bio?')" type="submit" class="btn btn-gradient">
                                                <i class="fas fa-save mr-2"></i>Update Bio
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            @if ($user->employee)
                                <div class="tab-pane" id="availibility">
                                    <div class="section-header">
                                        <h4><i class="fas fa-calendar-check mr-2"></i>Availability Settings</h4>
                                        <small>Manage your working hours and appointment slots</small>
                                    </div>
                                    
                                    <form action="{{ route('employee.profile.update', $user->employee->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="custom-form-group">
                                                    <label for="slot_duration" class="custom-label">
                                                        <i class="fas fa-stopwatch"></i>Service Duration
                                                    </label>
                                                    <small class="text-muted d-block mb-2">Set your default appointment duration</small>
                                                    <select class="form-control @error('slot_duration') is-invalid @enderror" name="slot_duration" id="slot_duration">
                                                        <option value="" {{ old('slot_duration', optional($user->employee)->slot_duration) == '' ? 'selected' : '' }}>Select Duration</option>
                                                        @foreach ($steps as $stepValue)
                                                            <option value="{{ $stepValue }}" {{ old('slot_duration', optional($user->employee)->slot_duration) == $stepValue ? 'selected' : '' }}>
                                                                {{ $stepValue }} minutes
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('slot_duration')
                                                        <small class="text-danger d-block mt-1"><strong>{{ $message }}</strong></small>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="custom-form-group">
                                                    <label for="break_duration" class="custom-label">
                                                        <i class="fas fa-coffee"></i>Break Time
                                                    </label>
                                                    <small class="text-muted d-block mb-2">Time between appointments</small>
                                                    <select class="form-control @error('break_duration') is-invalid @enderror" name="break_duration" id="break_duration">
                                                        <option value="" {{ old('break_duration', optional($user->employee)->break_duration) == '' ? 'selected' : '' }}>No Break</option>
                                                        @foreach ($breaks as $breakValue)
                                                            <option value="{{ $breakValue }}" {{ old('break_duration', optional($user->employee)->break_duration) == $breakValue ? 'selected' : '' }}>
                                                                {{ $breakValue }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('break_duration')
                                                        <small class="text-danger d-block mt-1"><strong>{{ $message }}</strong></small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr class="my-4">
                                        
                                        <div class="section-header">
                                            <h5><i class="fas fa-clock mr-2"></i>Weekly Schedule</h5>
                                            <small>Set your working hours for each day</small>
                                        </div>
                                        
                                        @foreach ($days as $day)
                                            <div class="time-slot-row">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="{{ $day }}" @if (old('days.' . $day) || isset($employeeDays[$day])) checked @endif>
                                                            <label class="custom-control-label font-weight-bold" for="{{ $day }}">
                                                                {{ ucfirst($day) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <label class="small text-muted mb-1">From</label>
                                                        <input type="time" class="form-control from" name="days[{{ $day }}][]" id="{{ $day }}From" value="{{ old('days.' . $day . '.0') ?? ($employeeDays[$day][0] ?? '') }}" />
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <label class="small text-muted mb-1">To</label>
                                                        <input type="time" class="form-control to" name="days[{{ $day }}][]" id="{{ $day }}To" value="{{ old('days.' . $day . '.1') ?? ($employeeDays[$day][1] ?? '') }}" />
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                        <div id="{{ $day }}AddMore" class="btn btn-sm btn-outline-custom d-none mt-3">
                                                            <i class="fas fa-plus mr-1"></i>Add
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                @if (old('days.' . $day) || isset($employeeDays[$day]))
                                                    @foreach (old('days.' . $day) ?: $employeeDays[$day] as $index => $time)
                                                        @if ($index > 1 && $index % 2 == 0)
                                                            <div class="row additional-{{ $day }} mt-3">
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-4">
                                                                    <label class="small text-muted mb-1">From</label>
                                                                    <input type="time" class="form-control from" name="days[{{ $day }}][]" value="{{ $time }}" id="{{ $day }}MoreFrom" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="small text-muted mb-1">To</label>
                                                                    <input type="time" class="form-control to" name="days[{{ $day }}][]" value="{{ old('days.' . $day . '.' . ($index + 1)) ?? ($employeeDays[$day][$index + 1] ?? '') }}" id="{{ $day }}" />
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" class="btn btn-sm btn-danger remove-field mt-4">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                        
                                        <hr class="my-4">
                                        
                                        <div class="section-header">
                                            <h5><i class="fas fa-umbrella-beach mr-2"></i>Holidays & Days Off</h5>
                                            <small>Schedule your time off</small>
                                        </div>
                                        
                                        <button type="button" id="addHoliday" class="btn btn-outline-custom mb-3">
                                            <i class="fas fa-plus mr-2"></i>Add Holiday
                                        </button>
                                        
                                        <div class="holidayContainer">
                                            @php
                                                $holidaysInput = old('holidays.date', []);
                                                $dbHolidays = $user->employee->holidays ?? [];
                                                $holidaysToDisplay = !empty($holidaysInput) ? $holidaysInput : $dbHolidays;
                                            @endphp

                                            @forelse($holidaysToDisplay as $index => $holidayItem)
                                                @php
                                                    $usingOldInput = !empty($holidaysInput);
                                                    if ($usingOldInput) {
                                                        $date = old("holidays.date.$index");
                                                        $holiday = null;
                                                    } else {
                                                        $holiday = $holidayItem;
                                                        $date = $holiday->date;
                                                        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                                                            try {
                                                                $date = \Carbon\Carbon::parse($date)->format('Y-m-d');
                                                            } catch (Exception $e) {
                                                                $date = '';
                                                            }
                                                        }
                                                    }
                                                    $fromTime = old("holidays.from_time.$index", $holiday && $holiday->hours ? explode('-', $holiday->hours[0])[0] ?? '' : '');
                                                    $toTime = old("holidays.to_time.$index", $holiday && $holiday->hours ? explode('-', $holiday->hours[0])[1] ?? '' : '');
                                                    $recurring = old("holidays.recurring.$index", $holiday->recurring ?? 0);
                                                @endphp
                                                <div class="holiday-row">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4">
                                                            <label class="small text-muted mb-1">Date</label>
                                                            <input class="form-control" type="date" name="holidays[date][]" value="{{ $date }}" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="small text-muted mb-1">From</label>
                                                            <input type="time" class="form-control from" name="holidays[from_time][]" value="{{ $fromTime }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="small text-muted mb-1">To</label>
                                                            <input type="time" class="form-control to" name="holidays[to_time][]" value="{{ $toTime }}">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-sm btn-danger removeHoliday mt-3">
                                                                <i class="fas fa-trash mr-1"></i>Remove
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="holidays[recurring][]" value="{{ $recurring }}">
                                                </div>
                                            @empty
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle mr-2"></i>No holidays scheduled. Click "Add Holiday" to create one.
                                                </div>
                                            @endforelse
                                        </div>
                                        
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-gradient" onclick="return confirm('Are you sure you want to update availability?')">
                                                <i class="fas fa-save mr-2"></i>Update Availability
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            @if ($user->employee && $user->employee->appointments)
                                <div class="tab-pane" id="appointments">
                                    <div class="section-header">
                                        <h4><i class="fas fa-clipboard-list mr-2"></i>My Appointments</h4>
                                        <small>Manage appointments assigned to you</small>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table custom-table myTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><i class="fas fa-user mr-1"></i>Client</th>
                                                    <th><i class="fas fa-cut mr-1"></i>Service</th>
                                                    <th><i class="fas fa-user-tie mr-1"></i>Staff</th>
                                                    <th><i class="fas fa-calendar mr-1"></i>Date</th>
                                                    <th><i class="fas fa-clock mr-1"></i>Time</th>
                                                    <th><i class="fas fa-info-circle mr-1"></i>Status</th>
                                                    <th><i class="fas fa-cog mr-1"></i>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->employee->appointments->sortByDesc('created_at') as $appointment)
                                                    <tr>
                                                        <td><span class="badge badge-light">{{ $loop->iteration }}</span></td>
                                                        <td class="font-weight-bold">{{ $appointment->name }}</td>
                                                        <td>{{ $appointment->service?->title ?? 'No Service' }}</td>
                                                        <td>{{ $appointment->employee->user->name ?? 'No Staff' }}</td>
                                                        <td>{{ $appointment->booking_date }}</td>
                                                        <td>{{ $appointment->booking_time }}</td>
                                                        <td>
                                                            @php
                                                                $statusColors = [
                                                                    'Pending payment' => '#f39c12',
                                                                    'Processing' => '#3498db',
                                                                    'Confirmed' => '#2ecc71',
                                                                    'Cancelled' => '#ff0000',
                                                                    'Completed' => '#008000',
                                                                    'On Hold' => '#95a5a6',
                                                                    'Rescheduled' => '#f1c40f',
                                                                    'No Show' => '#e67e22',
                                                                ];
                                                                $status = $appointment->status;
                                                                $color = $statusColors[$status] ?? '#7f8c8d';
                                                            @endphp
                                                            <span class="status-badge" style="background-color: {{ $color }}; color: white;">
                                                                {{ $status }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-primary action-btn view-appointment-btn-employee" data-toggle="modal" data-target="#appointmentModal" data-id="{{ $appointment->id }}" data-name="{{ $appointment->name }}" data-service="{{ $appointment->service?->title ?? 'No Service' }}" data-email="{{ $appointment->email }}" data-phone="{{ $appointment->phone }}" data-employee="{{ $appointment->employee->user->name ?? 'No Staff' }}" data-start="{{ $appointment->booking_date . ' ' . $appointment->booking_time }}" data-amount="{{ $appointment->amount }}" data-notes="{{ $appointment->notes }}" data-status="{{ $appointment->status }}">
                                                                <i class="fas fa-eye mr-1"></i>View
                                                            </button>
                                                            
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            @if ($user->appointments->count())
                                <div class="tab-pane" id="bookings">
                                    <div class="section-header">
                                        <h4><i class="fas fa-book mr-2"></i>My Bookings</h4>
                                        <small>View all your salon appointments</small>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table custom-table myTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><i class="fas fa-user mr-1"></i>Client</th>
                                                    <th><i class="fas fa-cut mr-1"></i>Service</th>
                                                    <th><i class="fas fa-user-tie mr-1"></i>Staff</th>
                                                    <th><i class="fas fa-calendar mr-1"></i>Date</th>
                                                    <th><i class="fas fa-clock mr-1"></i>Time</th>
                                                    <th><i class="fas fa-info-circle mr-1"></i>Status</th>
                                                    <th><i class="fas fa-cog mr-1"></i>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->appointments->sortByDesc('created_at') as $appointment)
                                                    <tr>
                                                        <td><span class="badge badge-light">{{ $loop->iteration }}</span></td>
                                                        <td class="font-weight-bold">{{ $appointment->name }}</td>
                                                        <td>{{ $appointment->service->title }}</td>
                                                        <td>{{ $appointment->employee->user->name }}</td>
                                                        <td>{{ $appointment->booking_date }}</td>
                                                        <td>{{ $appointment->booking_time }}</td>
                                                        <td>
                                                            @php
                                                                $statusColors = [
                                                                    'Pending payment' => '#f39c12',
                                                                    'Processing' => '#3498db',
                                                                    'Confirmed' => '#2ecc71',
                                                                    'Cancelled' => '#ff0000',
                                                                    'Completed' => '#008000',
                                                                    'On Hold' => '#95a5a6',
                                                                    'Rescheduled' => '#f1c40f',
                                                                    'No Show' => '#e67e22',
                                                                ];
                                                                $status = $appointment->status;
                                                                $color = $statusColors[$status] ?? '#7f8c8d';
                                                            @endphp
                                                            <span class="status-badge" style="background-color: {{ $color }}; color: white;">
                                                                {{ $status }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-primary action-btn view-booking-btn" data-toggle="modal" data-target="#CustomerBookings" data-name="{{ $appointment->name }}" data-service="{{ $appointment->service->title }}" data-staff="{{ $appointment->employee->user->name }}" data-date="{{ $appointment->booking_date }}" data-time="{{ $appointment->booking_time }}" data-amount="{{ $appointment->amount }}" data-status="{{ $appointment->status }}" data-notes="{{ $appointment->notes }}">
                                                                <i class="fas fa-eye mr-1"></i>View
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            <div class="tab-pane" id="password">
                                <div class="section-header">
                                    <h4><i class="fas fa-lock mr-2"></i>Change Password</h4>
                                    <small>Update your account password</small>
                                </div>
                                
                                <form action="{{ route('user.password.update', $user->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <div class="custom-form-group">
                                        <label for="inputCurrentPassword" class="custom-label">
                                            <i class="fas fa-key"></i>Current Password
                                        </label>
                                        <input type="password" class="form-control" id="inputCurrentPassword" placeholder="Enter current password" name="current_password" autocomplete="current_password">
                                    </div>
                                    
                                    <div class="custom-form-group">
                                        <label for="inputNewPassword" class="custom-label">
                                            <i class="fas fa-lock"></i>New Password
                                        </label>
                                        <input type="password" class="form-control" id="inputNewPassword" placeholder="Enter new password" name="password" autocomplete="password_confirmation">
                                    </div>
                                    
                                    <div class="custom-form-group">
                                        <label for="inputConfirmPassword" class="custom-label">
                                            <i class="fas fa-lock"></i>Confirm New Password
                                        </label>
                                        <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm new password" name="password_confirmation" autocomplete="password_confirmation">
                                    </div>
                                    
                                    <div class="mt-4">
                                        <button onclick="return confirm('Are you sure you want to update your password?');" type="submit" class="btn btn-gradient">
                                            <i class="fas fa-save mr-2"></i>Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Custom file input label update
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
        });
        
        // Show profile image modal on error
        @if ($errors->has('image'))
            $('#profileImageModal').modal('show');
        @endif
        
        // Auto-hide alerts
        $(".alert").delay(6000).slideUp(300);
        
        // Day toggle functionality
        function toggleDayFields(dayId) {
            var isChecked = $('#' + dayId).prop('checked');
            $('#' + dayId + 'From, #' + dayId + 'To').prop('disabled', !isChecked);
            
            if (isChecked) {
                $('#' + dayId + 'AddMore').removeClass('d-none');
            } else {
                $('#' + dayId + 'AddMore').addClass('d-none');
                $('.additional-' + dayId).remove();
            }
        }
        
        function addMoreFields(dayId) {
            var originalRow = $('#' + dayId + 'AddMore').closest('.time-slot-row');
            var clonedRow = $('<div class="row additional-' + dayId + ' mt-3"></div>');
            
            clonedRow.html(`
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <label class="small text-muted mb-1">From</label>
                    <input type="time" class="form-control from" name="days[${dayId}][]" />
                </div>
                <div class="col-md-4">
                    <label class="small text-muted mb-1">To</label>
                    <input type="time" class="form-control to" name="days[${dayId}][]" />
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-sm btn-danger remove-field mt-4">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `);
            
            originalRow.after(clonedRow);
        }
        
        $(document).on('click', '.remove-field', function() {
            $(this).closest('.row').remove();
        });
        
        ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'].forEach(function(day) {
            $('#' + day).on('change', function() {
                toggleDayFields(day);
            }).trigger('change');
            
            $('#' + day + 'AddMore').on('click', function() {
                addMoreFields(day);
            });
        });
        
        // Holiday management
        $('#addHoliday').click(function() {
            const holidayRow = `
                <div class="holiday-row">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label class="small text-muted mb-1">Date</label>
                            <input class="form-control" type="date" name="holidays[date][]" required>
                        </div>
                        <div class="col-md-3">
                            <label class="small text-muted mb-1">From</label>
                            <input type="time" class="form-control from" name="holidays[from_time][]">
                        </div>
                        <div class="col-md-3">
                            <label class="small text-muted mb-1">To</label>
                            <input type="time" class="form-control to" name="holidays[to_time][]">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-sm btn-danger removeHoliday mt-3">
                                <i class="fas fa-trash mr-1"></i>Remove
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="holidays[recurring][]" value="0">
                </div>`;
            $('.holidayContainer').append(holidayRow);
        });
        
        $(document).on('click', '.removeHoliday', function() {
            $(this).closest('.holiday-row').remove();
        });
        
        // DataTable initialization
        $('.myTable').DataTable({
            responsive: true,
            order: [[0, 'desc']],
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search appointments..."
            }
        });
        
        // Employee appointment modal
        $(document).on('click', '.view-appointment-btn-employee', function() {
            $('#modalAppointmentId').val($(this).data('id'));
            $('#modalAppointmentName').text($(this).data('name'));
            $('#Service').text($(this).data('service'));
            $('#modalEmail').text($(this).data('email'));
            $('#modalPhone').text($(this).data('phone'));
            $('#Staff').text($(this).data('employee'));
            $('#modalStartTime').text($(this).data('start'));
            $('#Amount').text($(this).data('amount'));
            $('#Notes').text($(this).data('notes'));
            
            var status = $(this).data('status');
            $('#modalStatusSelect').val(status);
            
            var statusColors = {
                'Pending payment': '#f39c12',
                'Processing': '#3498db',
                'Confirmed': '#2ecc71',
                'Cancelled': '#ff0000',
                'Completed': '#008000',
                'On Hold': '#95a5a6',
                'Rescheduled': '#f1c40f',
                'No Show': '#e67e22',
            };
            
            var badgeColor = statusColors[status] || '#7f8c8d';
            $('#modalStatusBadgeforEmployee').html(
                `<span class="status-badge" style="background-color: ${badgeColor}; color: white;">${status}</span>`
            );
        });
        
        // Customer booking modal
        const statusColors = {
            'Pending payment': '#f39c12',
            'Processing': '#3498db',
            'Confirmed': '#2ecc71',
            'Cancelled': '#ff0000',
            'Completed': '#008000',
            'On Hold': '#95a5a6',
            'Rescheduled': '#f1c40f',
            'No Show': '#e67e22',
        };
        
        $(document).on('click', '.view-booking-btn', function() {
            var button = $(this);
            var status = button.data('status');
            var badgeColor = statusColors[status] || '#7f8c8d';
            
            $('#modalUserName').text(button.data('name'));
            $('#modalService').text(button.data('service'));
            $('#modalStaff').text(button.data('staff'));
            $('#modalDate').text(button.data('date'));
            $('#modalAmount').text(button.data('amount'));
            $('#modalTime').text(button.data('time'));
            $('#modalNotes').text(button.data('notes'));
            
            $('#modalStatusBadge').html(
                `<span class="status-badge" style="background-color: ${badgeColor}; color: white;">${status}</span>`
            );
        });
    });
</script>
@stop
