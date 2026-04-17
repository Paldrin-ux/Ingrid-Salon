@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
            <h1 class="m-0" style="font-weight: 600; color: #2c3e50;">Edit User: {{ $user->name }}</h1>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right">
                <a href="{{ route('user.index') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 10px; padding: 10px 20px; font-weight: 500; margin-right: 10px;">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Users
                </a>
                <a href="{{ route('user.create') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%); color: white; border: none; border-radius: 10px; padding: 10px 20px; font-weight: 500;">
                    <i class="fas fa-plus mr-2"></i>Add New User
                </a>
            </div>
        </div>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (count($errors) > 0)
                <div class="alert alert-dismissable" style="border-radius: 12px; border-left: 4px solid #dc3545; background: #f8d7da; border: 1px solid #f5c6cb;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong><i class="fas fa-exclamation-triangle mr-2"></i>Whoops!</strong> There were some problems with your input.
                    <ul style="margin: 10px 0 0 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissable" style="border-radius: 12px; border-left: 4px solid #28a745; background: #d4edda; border: 1px solid #c3e6cb;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="fas fa-check-circle mr-2"></i><strong>{{ session('success') }}</strong>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                        <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px 15px 0 0; padding: 20px 25px; border: none;">
                            <h3 class="card-title" style="color: white; font-weight: 600; font-size: 1.2rem; margin: 0;">
                                <i class="fas fa-user-edit mr-2"></i>Edit User Information
                            </h3>
                        </div>

                        <div class="card-body" style="padding: 25px;">
                            <form action="{{ route('user.update', $user->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                
                                <div class="row">
                                    <!-- Left Column - Basic Information -->
                                    <div class="col-md-8">
                                        <div class="form-section mb-4">
                                            <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #667eea;">
                                                <i class="fas fa-info-circle mr-2"></i>Basic Information
                                            </h5>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">Full Name *</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                                                    <i class="fas fa-user"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                                   name="name" value="{{ old('name', $user->name) }}" 
                                                                   placeholder="Enter full name" required
                                                                   style="border: 2px solid #e0e0e0; border-radius: 0 8px 8px 0; padding: 12px;">
                                                        </div>
                                                        @error('name')
                                                            <small class="text-danger" style="font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">Phone Number</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                                                    <i class="fas fa-phone"></i>
                                                                </span>
                                                            </div>
                                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                                                   name="phone" value="{{ old('phone', $user->phone) }}" 
                                                                   placeholder="Enter phone number"
                                                                   style="border: 2px solid #e0e0e0; border-radius: 0 8px 8px 0; padding: 12px;">
                                                        </div>
                                                        @error('phone')
                                                            <small class="text-danger" style="font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">Email Address *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                                            <i class="fas fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                           name="email" value="{{ old('email', $user->email) }}" 
                                                           placeholder="Enter email address" required
                                                           style="border: 2px solid #e0e0e0; border-radius: 0 8px 8px 0; padding: 12px;">
                                                </div>
                                                @error('email')
                                                    <small class="text-danger" style="font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">User Roles *</label>
                                                <select name="roles[]" class="form-control select2 @error('roles') is-invalid @enderror" 
                                                        multiple="multiple" data-placeholder="Select roles" required
                                                        style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px;">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            @if ($user->roles->contains('name', $role->name) || in_array($role->name, old('roles', []))) selected @endif>
                                                            {{ ucfirst($role->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('roles')
                                                    <small class="text-danger" style="font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-section mb-4">
                                            <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #667eea;">
                                                <i class="fas fa-shield-alt mr-2"></i>Security Settings
                                            </h5>
                                            
                                            <div class="alert alert-info" style="border-radius: 8px; background: #e3f2fd; border: 1px solid #90caf9;">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                Leave password fields blank if you don't want to change the password.
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">New Password</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                                                    <i class="fas fa-lock"></i>
                                                                </span>
                                                            </div>
                                                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                                   name="password" placeholder="Enter new password" 
                                                                   style="border: 2px solid #e0e0e0; border-radius: 0 8px 8px 0; padding: 12px;">
                                                        </div>
                                                        @error('password')
                                                            <small class="text-danger" style="font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">Confirm Password</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                                                    <i class="fas fa-lock"></i>
                                                                </span>
                                                            </div>
                                                            <input type="password" class="form-control" 
                                                                   name="password_confirmation" placeholder="Confirm new password" 
                                                                   style="border: 2px solid #e0e0e0; border-radius: 0 8px 8px 0; padding: 12px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column - Status & Employee Settings -->
                                    <div class="col-md-4">
                                        <div class="form-section mb-4">
                                            <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #667eea;">
                                                <i class="fas fa-cog mr-2"></i>User Status
                                            </h5>
                                            
                                            <div class="status-card p-4 mb-4" style="background: #f8f9ff; border-radius: 12px; border: 2px solid #e3f2fd;">
                                                <div class="form-group mb-4">
                                                    <div class="custom-control custom-switch">
                                                        <input type="hidden" name="status" value="0">
                                                        <input type="checkbox" class="custom-control-input" id="statusSwitch" 
                                                               name="status" value="1" {{ old('status', $user->status) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="statusSwitch" style="font-weight: 600; color: #2c3e50;">
                                                            <i class="fas fa-user-check mr-2"></i>Active User
                                                        </label>
                                                    </div>
                                                    <small class="text-muted">When inactive, user cannot access the system.</small>
                                                </div>

                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="employeeSwitch" 
                                                               name="is_employee" {{ $user->employee ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="employeeSwitch" style="font-weight: 600; color: #2c3e50;">
                                                            <i class="fas fa-briefcase mr-2"></i>Is Employee
                                                        </label>
                                                    </div>
                                                    <small class="text-muted">Enable to add employee-specific settings.</small>
                                                </div>
                                            </div>

                                            <!-- Current User Info -->
                                            <div class="user-info-card p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; color: white;">
                                                <h6 style="font-weight: 600; margin-bottom: 15px; opacity: 0.9;">
                                                    <i class="fas fa-user-circle mr-2"></i>Current User Info
                                                </h6>
                                                <div class="text-center mb-3">
                                                    <img src="{{ $user->profileImage() }}" 
                                                         alt="{{ $user->name }}"
                                                         style="width: 80px; height: 80px; border-radius: 50%; border: 3px solid white; object-fit: cover;">
                                                </div>
                                                <div style="font-size: 0.9rem;">
                                                    <div class="mb-2">
                                                        <strong>Name:</strong> {{ $user->name }}
                                                    </div>
                                                    <div class="mb-2">
                                                        <strong>Email:</strong> {{ $user->email }}
                                                    </div>
                                                    <div class="mb-2">
                                                        <strong>Role:</strong> 
                                                        @foreach($user->getRoleNames() as $role)
                                                            {{ ucfirst($role) }}@if(!$loop->last), @endif
                                                        @endforeach
                                                    </div>
                                                    <div>
                                                        <strong>Status:</strong> 
                                                        @if($user->status)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Employee Settings (Conditional) -->
                                <div id="employeeSettings" class="form-section mb-4 {{ $user->employee ? '' : 'd-none' }}">
                                    <h5 style="color: #2c3e50; font-weight: 600; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #667eea;">
                                        <i class="fas fa-user-tie mr-2"></i>Employee Settings
                                    </h5>
                                    
                                    <div class="alert alert-warning" style="border-radius: 8px; background: #fff3cd; border: 1px solid #ffeaa7;">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        These settings are only applicable for employees who provide services.
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">Assigned Services</label>
                                                <select class="form-control servicesSelect2 @error('service') is-invalid @enderror" 
                                                        name="service[]" multiple="multiple" data-placeholder="Select services" 
                                                        style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px;">
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->id }}"
                                                            {{ $user->employee && $user->employee->services->contains('id', $service->id) ? 'selected' : '' }}>
                                                            {{ $service->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('service')
                                                    <small class="text-danger" style="font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">Service Duration</label>
                                                <select class="form-control @error('slot_duration') is-invalid @enderror" 
                                                        name="slot_duration" id="slot_duration"
                                                        style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px;">
                                                    <option value="">Select Duration</option>
                                                    @foreach ($steps as $stepValue)
                                                        <option value="{{ $stepValue }}"
                                                            {{ old('slot_duration', optional($user->employee)->slot_duration) == $stepValue ? 'selected' : '' }}>
                                                            {{ $stepValue }} minutes
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('slot_duration')
                                                    <small class="text-danger" style="font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">Break Time</label>
                                                <select class="form-control @error('break_duration') is-invalid @enderror" 
                                                        name="break_duration" id="break_duration"
                                                        style="border: 2px solid #e0e0e0; border-radius: 8px; padding: 12px;">
                                                    <option value="">No Break</option>
                                                    @foreach ($breaks as $breakValue)
                                                        <option value="{{ $breakValue }}"
                                                            {{ old('break_duration', optional($user->employee)->break_duration) == $breakValue ? 'selected' : '' }}>
                                                            {{ $breakValue }} minutes
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('break_duration')
                                                    <small class="text-danger" style="font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg" 
                                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 10px; padding: 12px 40px; font-weight: 600; margin-right: 15px;">
                                                <i class="fas fa-save mr-2"></i>Update User
                                            </button>
                                            <a href="{{ route('user.index') }}" class="btn btn-lg" 
                                               style="background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%); color: white; border: none; border-radius: 10px; padding: 12px 40px; font-weight: 600;">
                                                <i class="fas fa-times mr-2"></i>Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <style>
        /* Custom Form Styling */
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        .custom-control-input:checked ~ .custom-control-label::before {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }

        .select2-container--default .select2-selection--multiple {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            min-height: 46px;
        }

        .select2-container--default .select2-selection--multiple:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            border-radius: 20px;
            padding: 4px 12px;
            font-weight: 500;
        }

        /* Button Hover Effects */
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        /* Form Section Styling */
        .form-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #f0f0f0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* Status Card Hover */
        .status-card:hover {
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        /* User Info Card */
        .user-info-card {
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        /* Input Group Focus */
        .input-group:focus-within .input-group-text {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
            transition: all 0.3s ease;
        }

        /* Required field indicator */
        label[for] {
            position: relative;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                allowClear: true,
                maximumSelectionLength: 5
            });

            $('.servicesSelect2').select2({
                theme: 'bootstrap4',
                allowClear: true
            });

            // Toggle Employee Settings
            $('#employeeSwitch').on('change', function() {
                if (this.checked) {
                    $('#employeeSettings').removeClass('d-none').slideDown(300);
                } else {
                    $('#employeeSettings').slideUp(300, function() {
                        $(this).addClass('d-none');
                    });
                }
            });

            // Auto-hide alerts
            $(".alert").delay(6000).slideUp(300);

            // Form validation
            $('form').on('submit', function(e) {
                const roles = $('select[name="roles[]"]').val();
                if (!roles || roles.length === 0) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Role Required',
                        text: 'Please select at least one role for the user.',
                        confirmButtonColor: '#667eea'
                    });
                    return false;
                }
            });

            // SweetAlert notifications
            @if ($errors->any())
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5500
                });

                Toast.fire({
                    icon: 'error',
                    title: 'There are form validation errors. Please fix them.'
                });
            @endif

            @if (session('success'))
                var successMessage = @json(session('success'));
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5500
                });

                Toast.fire({
                    icon: 'success',
                    title: successMessage
                });
            @endif
        });
    </script>
@stop