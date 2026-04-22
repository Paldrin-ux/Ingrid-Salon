@extends('adminlte::page')
@section('title', 'Edit Service')

@section('content_header')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1 font-weight-bold text-dark">
                <i class="fas fa-edit mr-2 text-primary"></i>Edit Service
            </h1>
            <p class="text-muted mb-0 small">Update service details and information</p>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
            </a>
        </div>
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

    /* Alert Styling */
    .alert {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .alert-danger {
        background: #fef2f2;
        color: #dc3545;
        border-left: 4px solid #dc3545;
    }

    .alert-success {
        background: #f0fdf4;
        color: #198754;
        border-left: 4px solid #198754;
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

    /* Image Preview */
    .image-preview-container {
        position: relative;
        width: 100%;
        max-width: 300px;
        margin: 15px 0;
    }
    
    .image-preview {
        width: 100%;
        border-radius: 10px;
        border: 2px solid #e9ecef;
        transition: all 0.3s;
    }
    
    .image-preview:hover {
        border-color: #667eea;
    }

    /* Select2 Customization */
    .select2-container .select2-selection--single {
        height: 45px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 41px;
        padding-left: 15px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 43px;
    }
    
    .select2-container--default .select2-selection--single:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    /* Status Badge */
    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* Price Input Groups */
    .price-input-group {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid #667eea;
    }

    /* Sticky Sidebar */
    .sticky-sidebar {
        position: sticky;
        top: 20px;
    }

    /* Custom Switch */
    .custom-switch .custom-control-label::before {
        background-color: #e9ecef;
        border: none;
    }
    
    .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Card Header Styling */
    .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px 12px 0 0 !important;
        padding: 20px;
    }
    
    .card-header-custom h3 {
        margin: 0;
        font-weight: 600;
    }

    /* Help Text */
    .help-text {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 5px;
    }

    /* Summernote Customization */
    .note-editor {
        border-radius: 8px;
        border: 2px solid #e9ecef;
    }
    
    .note-editor:focus-within {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }
</style>

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

<div class="container-fluid">
    <form action="{{ route('service.update', $service->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-8">
                <!-- Service Information Card -->
                <div class="card profile-card mb-4">
                    <div class="card-header-custom">
                        <h3><i class="fas fa-edit mr-2"></i>Service Information</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="section-header">
                            <h4><i class="fas fa-info-circle mr-2"></i>Basic Details</h4>
                            <small>Update the basic information about your service</small>
                        </div>

                        <div class="custom-form-group">
                            <label for="title" class="custom-label">
                                <i class="fas fa-heading"></i>Service Title
                            </label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text"
                                id="title" name="title" placeholder="Enter service title..." value="{{ old('title', $service->title) }}">
                            @error('title')
                                <span class="text-danger small mt-1 d-block"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="custom-form-group">
                            <label for="slug" class="custom-label">
                                <i class="fas fa-link"></i>Service Slug
                            </label>
                            <input class="form-control bg-light @error('slug') is-invalid @enderror" type="text"
                                id="slug" name="slug" placeholder="Service URL slug..." value="{{ old('slug', $service->slug) }}">
                            <div class="help-text">Unique URL identifier for the service</div>
                            @error('slug')
                                <span class="text-danger small mt-1 d-block"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pricing Card -->
<div class="card profile-card mb-4">
    <div class="card-header-custom">
        <h3><i class="fas fa-tag mr-2"></i>Pricing Information</h3>
    </div>
    <div class="card-body p-4">
        <div class="section-header">
            <h4><i class="fas fa-money-bill mr-2"></i>Price Configuration</h4>
            <small>Set your service pricing</small>
        </div>

        <div class="price-input-group">
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-form-group">
                        <label class="custom-label mb-0">
                            <i class="fas fa-money-bill-wave"></i>Regular Price
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">(₱)</span>
                            </div>
                            <input class="form-control" type="number" step="0.01" name="price" placeholder="0.00"
                                value="{{ old('price', $service->price) }}">
                        </div>
                        <div class="help-text">Main price for the service</div>
                        @error('price')
                            <span class="text-danger small mt-1 d-block"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="custom-form-group">
                        <label class="custom-label mb-0">
                            <i class="fas fa-percentage"></i>Sale Discount 
                        </label>
                        <div class="input-group">
                            <input class="form-control" type="number" step="1" min="0" max="100" name="sale_price" placeholder="0"
                                value="{{ old('sale_price', $service->sale_price) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">(₱)</span>
                            </div>
                        </div>
                        <div class="help-text">Price Discount</div>
                        @error('sale_price')
                            <span class="text-danger small mt-1 d-block"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                <!-- Excerpt Card -->
                <div class="card profile-card mb-4">
                    <div class="card-header-custom">
                        <h3><i class="fas fa-file-alt mr-2"></i>Service Excerpt</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="section-header">
                            <h4><i class="fas fa-align-left mr-2"></i>Short Description</h4>
                            <small>Brief description of your service</small>
                        </div>

                        <div class="custom-form-group">
                            <textarea class="form-control" name="excerpt" id="excerpt" cols="30" rows="5" 
                                placeholder="Enter a short description of your service...">{{ old('excerpt', $service->excerpt) }}</textarea>
                            <div class="help-text">This will be shown in service listings and previews</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sticky-sidebar">
                    <!-- Service Details Card -->
                    <div class="card profile-card mb-4">
                        <div class="card-header-custom">
                            <h3><i class="fas fa-cog mr-2"></i>Service Settings</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="section-header">
                                <h4><i class="fas fa-sliders-h mr-2"></i>Configuration</h4>
                                <small>Manage service settings</small>
                            </div>

                            <div class="custom-form-group">
                                <label class="custom-label">
                                    <i class="fas fa-folder"></i>Category
                                </label>
                                <select id="category" name="category_id" class="form-control select2">
                                    <option value="">None</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (old('category_id', $service->category_id) == $category->id) ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="help-text">Select category for this service</div>
                                @error('category_id')
                                    <span class="text-danger small mt-1 d-block"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="custom-form-group">
                                <label for="inputStatus" class="custom-label">
                                    <i class="fas fa-eye"></i>Status
                                </label>
                                <select required name="status" id="inputStatus" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ (old('status', $service->status) == 1) ? 'selected' : '' }}>
                                        PUBLISHED
                                    </option>
                                    <option value="0" {{ (old('status', $service->status) == 0) ? 'selected' : '' }}>
                                        DRAFT
                                    </option>
                                </select>
                                <div class="help-text">Control service visibility</div>
                            </div>

                            <div class="custom-form-group text-center mt-4">
                                <button onclick="return confirm('Are you sure you want to update this service?');" 
                                        type="submit" class="btn btn-gradient btn-block">
                                    <i class="fas fa-save mr-2"></i>Update Service
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image Card -->
                    <div class="card profile-card">
                        <div class="card-header-custom">
                            <h3><i class="fas fa-image mr-2"></i>Service Image</h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="section-header">
                                <h4><i class="fas fa-camera mr-2"></i>Featured Image</h4>
                                <small>Upload service preview image</small>
                            </div>

                            <div class="custom-form-group">
                                <label class="custom-label mb-3">
                                    <i class="fas fa-upload"></i>Upload Image
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imgInp" name="image" accept="image/*">
                                    <label class="custom-file-label" for="imgInp">Choose image file</label>
                                </div>
                                <div class="help-text mt-2">Recommended size: 1200px × 800px</div>
                            </div>

                            <div class="image-preview-container text-center">
                                @if ($service->image)
                                    <img class="image-preview"
                                        id="blah"
                                        src="{{ asset('uploads/images/service/' . $service->image) }}"
                                        alt="Service image">
                                @else
                                    <img class="image-preview"
                                        id="blah" 
                                        src="{{ asset('uploads/images/no-image.jpg') }}"
                                        alt="No service image">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 45px !important;
        border: 2px solid #e9ecef !important;
        border-radius: 8px !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 41px !important;
        padding-left: 15px !important;
        color: #495057 !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 43px !important;
        right: 8px !important;
    }
    
    .select2-container--default .select2-selection--single:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15) !important;
    }
    
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
    }
    
    .select2-dropdown {
        border: 2px solid #e9ecef !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    }
    
    .custom-file-input:focus ~ .custom-file-label {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }
    
    .custom-file-label::after {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 for category dropdown
        $('#category').select2({
            placeholder: "Select a category",
            allowClear: false,
            width: '100%',
            theme: 'default'
        });

        // Image preview
        $('#imgInp').on('change', function() {
            const [file] = this.files;
            if (file) {
                $('#blah').attr('src', URL.createObjectURL(file));
            }
        });

        // Auto-generate slug from title
        $('#title').on('input', function() {
            var text = $(this).val().trim();
            text = text.toLowerCase();
            text = text.replace(/[^a-zA-Z0-9]+/g, '-');
            $('#slug').val(text);
        });

        // Update custom file input label
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
        });

        // Auto-hide alerts
        $(".alert").delay(6000).slideUp(300);

        // Success and error notification alerts
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
