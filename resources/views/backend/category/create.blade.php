@extends('adminlte::page')

@section('title', 'Create Category')

@section('content_header')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1 font-weight-bold text-dark">
                <i class="fas fa-plus-circle mr-2 text-primary"></i>Add New Category
            </h1>
            <p class="text-muted mb-0 small">Create a new category</p>
        </div>
        <a href="{{ route('category.index') }}" class="btn btn-outline-primary btn-sm shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back to Categories
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
        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <!-- Basic Information Card -->
                    <div class="card profile-card">
                        <div class="card-body p-4">
                            <div class="section-header">
                                <h4><i class="fas fa-info-circle mr-2"></i>Basic Information</h4>
                                <small>Enter the category details</small>
                            </div>

                            <div class="custom-form-group">
                                <label for="title" class="custom-label">
                                    <i class="fas fa-heading"></i>Category Title
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" placeholder="Enter category title" value="{{ old('title') }}">
                                <small class="text-muted d-block mt-1">The name is how it appears on your site.</small>
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
                                <small class="text-muted d-block mb-2">The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
                                <input type="text" class="form-control bg-light @error('slug') is-invalid @enderror" 
                                       id="slug" name="slug" placeholder="category-url-slug" value="{{ old('slug') }}" readonly>
                                @error('slug')
                                    <span class="text-danger small mt-1 d-block">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description Card -->
                    <div class="card profile-card">
                        <div class="card-body p-4">
                            <div class="section-header">
                                <h4><i class="fas fa-align-left mr-2"></i>Description</h4>
                                <small>The description is not prominent by default; however, some themes may show it.</small>
                            </div>

                            <div class="custom-form-group">
                                <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30" rows="5" 
                                          placeholder="Enter category description...">{{ old('body') }}</textarea>
                                @error('body')
                                    <span class="text-danger small mt-1 d-block">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </span>
                                @enderror
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
                                    <h4><i class="fas fa-cog mr-2"></i>Category Settings</h4>
                                    <small>Configure publication options</small>
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
                                        <i class="fas fa-save mr-2"></i>Publish Category
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image Card -->
                        <div class="card profile-card">
                            <div class="card-body p-4">
                                <div class="section-header">
                                    <h4><i class="fas fa-image mr-2"></i>Featured Image</h4>
                                    <small>Upload category image</small>
                                </div>

                                <div class="image-upload-wrapper">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                    <p class="text-muted mb-2">Click to upload or drag and drop</p>
                                    <small class="text-muted">Recommended: 1280x720px</small>
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
});
</script>
@stop