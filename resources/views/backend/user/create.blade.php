@extends('adminlte::page')

@section('title', 'Create User')

@section('content_header')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1 font-weight-bold text-dark">
                <i class="fas fa-user-plus mr-2 text-primary"></i>Add New User
            </h1>
            <p class="text-muted mb-0 small">Create a new user account</p>
        </div>
        <a href="{{ route('user.index') }}" class="btn btn-outline-primary btn-sm shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back to Users
        </a>
    </div>
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
        margin-bottom: 20px;
    }
    
    .profile-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
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
    
    .form-control, .custom-select {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        padding: 10px 15px;
        transition: all 0.3s;
    }
    
    .form-control:focus, .custom-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .input-group-text {
        border-radius: 8px 0 0 8px;
        border: 2px solid #e9ecef;
        border-right: none;
        background: #f8f9fa;
    }

    .input-group .form-control {
        border-left: none;
        border-radius: 0 8px 8px 0;
    }

    .input-group:focus-within .input-group-text {
        border-color: #667eea;
        background: #fff;
    }

    /* Button Styling */
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        padding: 12px 40px;
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

    /* Alert Styling */
    .alert {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* SWITCH STYLING - made smaller & sleeker (only this block changed) */
    .custom-switch .custom-control-label::before {
        /* smaller track */
        background-color: #e9ecef;
        border: none;
        width: 2.2rem;    /* reduced from 3rem */
        height: 1.1rem;   /* reduced from 1.5rem */
        top: 0.25rem;     /* adjust vertical alignment */
        left: -2.6rem;    /* keep placement inline with label */
        transition: all 0.22s ease;
        border-radius: 1.25rem;
    }

    .custom-switch .custom-control-label::after {
        /* smaller knob */
        width: 0.95rem;   /* slightly smaller */
        height: 0.95rem;
        top: 0.3rem;
        left: -2.45rem;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        transition: all 0.22s ease;
        border-radius: 50%;
    }
    
    .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .custom-switch .custom-control-input:checked ~ .custom-control-label::after {
        transform: translateX(1.05rem); /* move knob to the right */
    }

    .custom-switch .custom-control-label {
        font-weight: 600;
        color: #495057;
        padding-left: 0.5rem;
        cursor: pointer;
    }

    /* Time Slot Styling */
    .time-slot-row {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 15px;
        border-left: 4px solid #667eea;
        transition: all 0.3s;
    }

    .time-slot-row:hover {
        background: #fff;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
    }

    /* Info Box */
    .info-box-custom {
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        border-left: 4px solid #667eea;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .info-box-custom i {
        color: #667eea;
        margin-right: 8px;
    }

    /* Select2 Styling */
    .select2-container--default .select2-selection--multiple,
    .select2-container--default .select2-selection--single {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        min-height: 42px;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #667eea;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        border-radius: 6px;
        padding: 5px 10px;
    }

    /* Employee Section */
    #employee {
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Action Buttons */
    .action-btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s;
        cursor: pointer;
    }
    
    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    /* Day Label */
    .day-label {
        font-size: 1rem;
        font-weight: 700;
        color: #2d3748;
    }

    /* Additional Row Styling */
    .additional-row {
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        margin-top: 10px;
        border: 1px solid #e9ecef;
    }
</style>

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

<section class="content">
    <div class="container-fluid">
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <!-- Basic Information Card -->
                    <div class="card profile-card">
                        <div class="card-body p-4">
                            <div class="section-header">
                                <h4><i class="fas fa-user-circle mr-2"></i>User Information</h4>
                                <small>Enter the basic user details</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label for="name" class="custom-label">
                                            <i class="fas fa-user"></i>Full Name
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user text-muted"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" placeholder="Enter full name">
                                        </div>
                                        @error('name')
                                            <small class="text-danger d-block mt-1">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label for="email" class="custom-label">
                                            <i class="fas fa-envelope"></i>Email Address
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope text-muted"></i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" placeholder="user@example.com">
                                        </div>
                                        @error('email')
                                            <small class="text-danger d-block mt-1">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
    <div class="custom-form-group">
        <label for="phone" class="custom-label">
            <i class="fas fa-phone"></i>Phone Number
        </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-phone text-muted"></i>
                </span>
            </div>
            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                name="phone" id="phone" value="{{ old('phone') }}" 
                placeholder="09123456789" maxlength="11"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
        </div>
        <small class="text-muted">Format: 09XXXXXXXXX (11 digits)</small>
        @error('phone')
            <small class="text-danger d-block mt-1">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </small>
        @enderror
    </div>
</div>

                                <div class="col-md-6">
    <div class="custom-form-group">
        <label for="roles" class="custom-label">
            <i class="fas fa-user-tag"></i>User Role
        </label>
        <select name="roles" class="form-control select2 @error('roles') is-invalid @enderror" 
                data-placeholder="Select a role">
            <option value=""></option> @foreach ($roles as $role)
                <option value="{{ $role->name }}"
                    {{ old('roles') == $role->name ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
            @endforeach
        </select>
        @error('roles')
            <small class="text-danger d-block mt-1">
                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </small>
        @enderror
    </div>
</div>

                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label for="password" class="custom-label">
                                            <i class="fas fa-lock"></i>Password
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock text-muted"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="Enter password">
                                        </div>
                                        @error('password')
                                            <small class="text-danger d-block mt-1">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label for="password_confirmation" class="custom-label">
                                            <i class="fas fa-lock"></i>Confirm Password
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock text-muted"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation" placeholder="Confirm password">
                                        </div>
                                        @error('password_confirmation')
                                            <small class="text-danger d-block mt-1">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Toggle Card -->
                    <div class="card profile-card">
                        <div class="card-body p-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_employee"
                                    name="is_employee" {{ old('is_employee') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_employee">
                                    <i class="fas fa-cut mr-2"></i>This user is an employee
                                </label>
                            </div>
                            <small class="text-muted d-block mt-2">Enable this if the user will provide salon services</small>
                        </div>
                    </div>

                    <!-- Employee Details Section -->
                    <div id="employee" style="display: none;">
                        <div class="card profile-card">
                            <div class="card-body p-4">
                                <div class="section-header">
                                    <h4><i class="fas fa-id-badge mr-2"></i>Employee Settings</h4>
                                    <small>Configure employee-specific details</small>
                                </div>

                                <div class="info-box-custom">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Employee Details:</strong> These settings are only required if this user will be providing services.
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-form-group">
                                            <label for="service" class="custom-label">
                                                <i class="fas fa-cut"></i>Assigned Services
                                            </label>
                                            <small class="text-muted d-block mb-2">Select which services this employee can provide</small>
                                            <select class="form-control select2 @error('service[]') is-invalid @enderror"
                                                    name="service[]" id="service" data-placeholder="Select services" multiple>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}"
                                                        {{ in_array($service->id, old('service', [])) ? 'selected' : '' }}>
                                                        {{ $service->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('service')
                                                <small class="text-danger d-block mt-1">
                                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="slot_duration" class="custom-label">
                                                <i class="fas fa-stopwatch"></i>Service Duration
                                            </label>
                                            <small class="text-muted d-block mb-2">Default appointment slot length</small>
                                            <select class="form-control @error('slot_duration') is-invalid @enderror"
                                                    name="slot_duration" id="slot_duration">
                                                <option value="">Select Duration</option>
                                                @foreach (['10', '15', '20', '30', '45', '60'] as $duration)
                                                    <option value="{{ $duration }}"
                                                        {{ old('slot_duration') == $duration ? 'selected' : '' }}>
                                                        {{ $duration }} minutes
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('slot_duration')
                                                <small class="text-danger d-block mt-1">
                                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="break_duration" class="custom-label">
                                                <i class="fas fa-coffee"></i>Break Time
                                            </label>
                                            <small class="text-muted d-block mb-2">Time between appointments</small>
                                            <select class="form-control @error('break_duration') is-invalid @enderror"
                                                    name="break_duration" id="break_duration">
                                                <option value="">No Break</option>
                                                @foreach (['5', '10', '15', '20', '25', '30'] as $break)
                                                    <option value="{{ $break }}"
                                                        {{ old('break_duration') == $break ? 'selected' : '' }}>
                                                        {{ $break }} minutes
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('break_duration')
                                                <small class="text-danger d-block mt-1">
                                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Availability Schedule -->
                        <div class="card profile-card">
                            <div class="card-body p-4">
                                <div class="section-header">
                                    <h4><i class="fas fa-calendar-check mr-2"></i>Weekly Schedule</h4>
                                    <small>Set working hours for each day of the week</small>
                                </div>

                                @foreach ($days as $day)
                                    <div class="time-slot-row">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" 
                                                           id="{{ $day }}" @if (old('days.' . $day)) checked @endif>
                                                    <label class="custom-control-label day-label" for="{{ $day }}">
                                                        {{ ucfirst($day) }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="small text-muted mb-1">From</label>
                                                <input type="time" class="form-control from"
                                                       name="days[{{ $day }}][]"
                                                       value="{{ old('days.' . $day . '.0') }}"
                                                       id="{{ $day }}From">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="small text-muted mb-1">To</label>
                                                <input type="time" class="form-control to"
                                                       name="days[{{ $day }}][]"
                                                       value="{{ old('days.' . $day . '.1') }}"
                                                       id="{{ $day }}To">
                                            </div>

                                            <div class="col-md-1">
                                                <div id="{{ $day }}AddMore" 
                                                     class="btn btn-sm btn-outline-custom d-none mt-3">
                                                    <i class="fas fa-plus"></i>
                                                </div>
                                            </div>
                                        </div>

                                        @if (old('days.' . $day))
                                            @foreach (old('days.' . $day) as $index => $time)
                                                @if ($index > 1 && $index % 2 == 0)
                                                    <div class="row additional-{{ $day }} additional-row mt-3">
                                                        <div class="col-md-3"></div>
                                                        <div class="col-md-4">
                                                            <label class="small text-muted mb-1">From</label>
                                                            <input type="time" class="form-control from"
                                                                   name="days[{{ $day }}][]"
                                                                   value="{{ $time }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="small text-muted mb-1">To</label>
                                                            <input type="time" class="form-control to"
                                                                   name="days[{{ $day }}][]"
                                                                   value="{{ old('days.' . $day . '.' . ($index + 1)) }}">
                                                        </div>
                                                        <div class="col-md-1">
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
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button Sidebar -->
                <div class="col-lg-4">
                    <div class="card profile-card sticky-top" style="top: 20px;">
                        <div class="card-body p-4">
                            <div class="section-header">
                                <h4><i class="fas fa-save mr-2"></i>Save User</h4>
                                <small>Review and create the user account</small>
                            </div>

                            <div class="info-box-custom mb-4">
                                <i class="fas fa-lightbulb"></i>
                                <strong>Quick Tip:</strong> Make sure all required fields are filled before submitting.
                            </div>

                            <button type="submit" class="btn btn-gradient w-100">
                                <i class="fas fa-user-plus mr-2"></i>Create User
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Auto-hide alerts
    $(".alert").delay(6000).slideUp(300);
    
    // Initialize Select2
    $('.select2').select2({
        allowClear: true,
        theme: 'default',
        width: '100%'
    });
    
    // Toggle employee section
    function toggleEmployeeSection() {
        if ($('#is_employee').prop('checked')) {
            $('#employee').slideDown(400);
        } else {
            $('#employee').slideUp(400);
        }
    }
    
    toggleEmployeeSection();
    
    $('#is_employee').change(function() {
        toggleEmployeeSection();
    });
    
    // Day schedule functionality
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
        var clonedRow = $('<div class="row additional-' + dayId + ' additional-row mt-3"></div>');
        
        clonedRow.html(`
            <div class="col-md-3"></div>
            <div class="col-md-4">
                <label class="small text-muted mb-1">From</label>
                <input type="time" class="form-control from" name="days[${dayId}][]" />
            </div>
            <div class="col-md-4">
                <label class="small text-muted mb-1">To</label>
                <input type="time" class="form-control to" name="days[${dayId}][]" />
            </div>
            <div class="col-md-1">
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
});
</script>
@stop
