@extends('adminlte::page')

@section('title', 'Create Service')

@section('content_header')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1 font-weight-bold text-dark">
                <i class="fas fa-plus-circle mr-2 text-primary"></i>Add New Services
            </h1>
            <p class="text-muted mb-0 small">Create a new service offering</p>
        </div>
        <a href="{{ route('service.index') }}" class="btn btn-outline-primary btn-sm shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back to Services
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

    /* Custom File Upload */
    .image-upload-wrapper {
        position: relative;
        border: 2px dashed #e9ecef;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s;
        background: #f8f9fa;
    }

    .image-upload-wrapper:hover {
        border-color: #667eea;
        background: #fff;
    }

    .image-preview {
        margin-top: 15px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Switch Styling */
    .custom-switch .custom-control-label::before {
        background-color: #e9ecef;
        border: none;
    }
    
    .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Sticky Sidebar */
    .sticky-sidebar {
        position: sticky;
        top: 20px;
    }

    /* Info Box */
    .info-box-custom {
        background: #f8f9fa;
        border-left: 4px solid #667eea;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .info-box-custom i {
        color: #667eea;
        margin-right: 8px;
    }

    /* Price Input Group */
    .price-card {
        background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
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

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
        padding-left: 12px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
    }

    /* Fix Select2 dropdown z-index */
    .select2-container {
        z-index: 9999;
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

<section class="content">
    <div class="container-fluid">
        <form action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <!-- Basic Information Card -->
                    <div class="card profile-card">
                        <div class="card-body p-4">
                            <div class="section-header">
                                <h4><i class="fas fa-info-circle mr-2"></i>Basic Information</h4>
                                <small>Enter the service details</small>
                            </div>

                            <div class="custom-form-group">
                                <label for="title" class="custom-label">
                                    <i class="fas fa-heading"></i>Service Title
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" placeholder="Enter service title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-danger small mt-1 d-block">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="custom-form-group">
                                <label for="slug" class="custom-label">
                                    <i class="fas fa-link"></i>URL Slug
                                </label>
                                <small class="text-muted d-block mb-2">Unique URL for this service (auto-generated)</small>
                                <input type="text" class="form-control bg-light @error('slug') is-invalid @enderror" 
                                       id="slug" name="slug" placeholder="service-url-slug" value="{{ old('slug') }}" readonly>
                                @error('slug')
                                    <span class="text-danger small mt-1 d-block">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="custom-form-group">
                                <label for="excerpt" class="custom-label">
                                    <i class="fas fa-align-left"></i>Short Description
                                </label>
                                <small class="text-muted d-block mb-2">Brief summary of the service</small>
                                <textarea class="form-control" name="excerpt" id="excerpt" rows="4" 
                                          placeholder="Enter a short description...">{{ old('excerpt') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Card -->
                    <div class="card profile-card">
                        <div class="card-body p-4">
                            <div class="section-header">
                                <h4><i class="fas fa-money-bill mr-2"></i>Pricing Details</h4>
                                <small>Set your service prices (numbers only, no currency symbols)</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label for="price" class="custom-label">
                                            <i class="fas fa-tag"></i>Regular Price
                                        </label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                               name="price" id="price" placeholder="0.00" step="0.01" value="{{ old('price') }}">
                                        @error('price')
                                            <span class="text-danger small mt-1 d-block">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-form-group">
                                        <label for="sale_price" class="custom-label">
                                            <i class="fas fa-percent"></i>Sale Price
                                        </label>
                                        <input type="number" class="form-control @error('sale_price') is-invalid @enderror" 
                                               name="sale_price" id="sale_price" placeholder="0.00" step="0.01" value="{{ old('sale_price') }}">
                                        <small class="text-muted">Leave empty if no discount</small>
                                        @error('sale_price')
                                            <span class="text-danger small mt-1 d-block">
                                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="info-box-custom">
                                <i class="fas fa-info-circle"></i>
                                <strong>Pricing Tip:</strong> If you set a sale price, it will be displayed instead of the regular price.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-sidebar">
                        <!-- Publish Card -->
                        <div class="card profile-card">
                            <div class="card-body p-4">
                                <div class="section-header">
                                    <h4><i class="fas fa-cog mr-2"></i>Service Settings</h4>
                                    <small>Configure publication options</small>
                                </div>

                                <div class="custom-form-group">
                                    <label for="category" class="custom-label">
                                        <i class="fas fa-folder"></i>Category
                                    </label>
                                    <small class="text-muted d-block mb-2">Assign to a category</small>
                                    <select id="category" name="category_id" class="form-control select2" 
                                            data-placeholder="Select or search category">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger small mt-1 d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="custom-form-group">
                                    <label for="inputStatus" class="custom-label">
                                        <i class="fas fa-toggle-on"></i>Status
                                    </label>
                                    <select name="status" id="inputStatus" class="form-control custom-select">
                                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Published</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>

                                <div class="text-right mt-4">
                                    <button type="submit" class="btn btn-gradient w-100">
                                        <i class="fas fa-save mr-2"></i>Publish Service
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image Card -->
                        <div class="card profile-card">
                            <div class="card-body p-4">
                                <div class="section-header">
                                    <h4><i class="fas fa-image mr-2"></i>Featured Image</h4>
                                    <small>Upload service image</small>
                                </div>

                                <div class="image-upload-wrapper">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                    <p class="text-muted mb-2">Click to upload or drag and drop</p>
                                    <small class="text-muted">Recommended: 1200x800px</small>
                                    <input name="image" accept="image/*" type="file" id="imgInp" class="d-none">
                                    <label for="imgInp" class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-folder-open mr-1"></i>Choose File
                                    </label>
                                </div>

                                <div class="image-preview">
                                    <img id="blah" src="{{ asset('uploads/images/no-image.jpg') }}" 
                                         alt="Preview" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<script>
$(document).ready(function() {
    // Auto-hide alerts
    $(".alert").delay(6000).slideUp(300);
    
    // Auto-generate slug from title
    $('#title').on("change keyup paste", function() {
        var text = $(this).val().trim();
        text = text.toLowerCase();
        text = text.replace(/[^a-zA-Z0-9]+/g, '-');
        $('#slug').val(text);
    });
    
    // Image preview
    $('#imgInp').on('change', function(evt) {
        const [file] = this.files;
        if (file) {
            $('#blah').attr('src', URL.createObjectURL(file));
        }
    });
    
    // Initialize Select2 with proper configuration
    $('#category').select2({
        placeholder: "Select or search category",
        allowClear: true,
        width: '100%',
        dropdownParent: $('.sticky-sidebar')
    });

    // Fix for Select2 dropdown issues
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
});
</script>
@stop