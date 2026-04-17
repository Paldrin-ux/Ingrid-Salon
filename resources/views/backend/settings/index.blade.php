@extends('adminlte::page')

@section('title', 'Settings')

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

    /* Tab Styling */
    .nav-pills .nav-link {
        border-radius: 8px;
        margin: 2px;
        padding: 12px 20px;
        font-weight: 500;
        color: #495057;
        transition: all 0.3s;
    }
    
    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    
    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
    }

    /* Logo Preview */
    .logo-preview {
        border: 3px dashed #e9ecef;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s;
        background: #f8f9fa;
    }
    
    .logo-preview:hover {
        border-color: #667eea;
        background: #fff;
    }

    /* Switch Styling */
    .custom-switch .custom-control-label::before {
        background-color: #e9ecef;
        border: none;
    }
    
    .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

<div class="container-fluid py-4">
    <div class="row">
        <!-- Logo Preview Sidebar -->
        <div class="col-md-3">
            <div class="profile-card">
                <div class="card-body p-4">
                    <div class="section-header">
                        <h4><i class="fas fa-image mr-2"></i>Logo Preview</h4>
                        <small>Current website branding</small>
                    </div>
                    
                    @if ($setting->dark_logo)
                        <div class="logo-preview mb-4">
                            <div class="text-center">
                                <img class="img-fluid" style="max-height: 120px;"
                                    src="{{ asset('uploads/images/logo/' . $setting->dark_logo) }}" 
                                    alt="Dark Logo">
                                <p class="text-muted mt-2 mb-0">Dark Logo</p>
                            </div>
                        </div>
                    @endif
                    
                    <div class="logo-preview">
                        <div class="text-center">
                            @if ($setting->logo)
                                <img class="img-fluid" style="max-height: 120px;" 
                                     src="{{ asset('uploads/images/logo/' . $setting->logo) }}" 
                                     alt="Main Logo">
                                <hr>
                            @endif
                            <span class="h5 font-weight-bold text-dark">{{ $setting->bname }}</span>
                            <p class="text-muted mb-0 small">Business Name</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Form -->
        <div class="col-md-9">
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

            <div class="card profile-card">
                <form action="{{ route('setting.update', $setting->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-header p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px 15px 0 0;">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active" href="#business" data-toggle="tab">
                                    <i class="fas fa-building mr-2"></i>Business
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#social" data-toggle="tab">
                                    <i class="fas fa-share-alt mr-2"></i>Social
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#seo" data-toggle="tab">
                                    <i class="fas fa-search mr-2"></i>SEO
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body p-4">
                        <div class="tab-content">
                            <!-- Business Information Tab -->
                            <div class="active tab-pane" id="business">
                                <div class="section-header">
                                    <h4><i class="fas fa-info-circle mr-2"></i>Business Information</h4>
                                    <small>Update your business details and contact information</small>
                                </div>

                                <div class="custom-form-group">
                                    <label for="bname" class="custom-label">
                                        <i class="fas fa-signature"></i>Business Name
                                    </label>
                                    <input type="text" class="form-control @error('bname') is-invalid @enderror"
                                        name="bname" id="bname" placeholder="Enter business name"
                                        value="{{ old('bname', $setting->bname) }}">
                                    @error('bname')
                                        <span class="text-danger small mt-1 d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="email" class="custom-label">
                                                <i class="fas fa-envelope"></i>Email
                                            </label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                name="email" id="email" placeholder="contact@business.com"
                                                value="{{ old('email', $setting->email) }}">
                                            @error('email')
                                                <span class="text-danger small mt-1 d-block">
                                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="currency" class="custom-label">
                                                <i class="fas fa-dollar-sign"></i>Currency
                                            </label>
                                            <input type="text" class="form-control @error('currency') is-invalid @enderror" 
                                                name="currency" id="currency" placeholder="USD"
                                                value="{{ old('currency', $setting->currency) }}">
                                            <small class="text-muted">Use currency abbreviation (e.g., USD, EUR, GBP)</small>
                                            @error('currency')
                                                <span class="text-danger small mt-1 d-block">
                                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="phone" class="custom-label">
                                                <i class="fas fa-phone"></i>Phone
                                            </label>
                                            <input type="text" class="form-control" name="phone" id="phone"
                                                placeholder="+1 234 567 8900" value="{{ old('phone', $setting->phone) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="whatsapp" class="custom-label">
                                                <i class="fab fa-whatsapp"></i>WhatsApp
                                            </label>
                                            <input type="text" class="form-control" name="whatsapp" id="whatsapp"
                                                placeholder="919865322154" value="{{ old('whatsapp', $setting->whatsapp) }}">
                                            <small class="text-muted">Include country code without spaces</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-form-group">
                                    <label for="logo" class="custom-label">
                                        <i class="fas fa-upload"></i>Website Logo
                                    </label>
                                    <input type="file" class="form-control" name="logo" id="logo">
                                    <small class="text-muted">Upload your main website logo</small>
                                </div>

                                <div class="custom-form-group">
                                    <label for="address" class="custom-label">
                                        <i class="fas fa-map-marker-alt"></i>Address
                                    </label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        placeholder="Enter business address" value="{{ old('address', $setting->address) }}">
                                    <small class="text-muted">Address will be displayed on the contact page</small>
                                </div>

                                <div class="custom-form-group">
                                    <label for="map" class="custom-label">
                                        <i class="fas fa-map"></i>Google Map Embed
                                    </label>
                                    <textarea name="map" id="map" class="form-control" rows="6" 
                                              placeholder="Paste Google Maps iframe code here">{{ old('map', $setting->map) }}</textarea>
                                    <small class="text-muted">Embed code for Google Maps on contact page</small>
                                </div>
                            </div>

                            <!-- Social Media Tab -->
                            <div class="tab-pane" id="social">
                                <div class="section-header">
                                    <h4><i class="fas fa-share-alt mr-2"></i>Social Media Links</h4>
                                    <small>Connect your social media profiles</small>
                                </div>

                                <div class="custom-form-group">
                                    <label for="facebook" class="custom-label">
                                        <i class="fab fa-facebook"></i>Facebook
                                    </label>
                                    <input type="text" class="form-control" name="social[facebook]" 
                                        placeholder="https://facebook.com/yourpage" 
                                        value="{{ old('social.facebook', $setting->social['facebook'] ?? '') }}">
                                </div>

                                <div class="custom-form-group">
                                    <label for="instagram" class="custom-label">
                                        <i class="fab fa-instagram"></i>Instagram
                                    </label>
                                    <input type="text" class="form-control" name="social[instagram]"
                                        placeholder="https://instagram.com/yourprofile"
                                        value="{{ old('social.instagram', $setting->social['instagram'] ?? '') }}">
                                </div>

                                <div class="custom-form-group">
                                    <label for="twitter" class="custom-label">
                                        <i class="fab fa-twitter"></i>Twitter
                                    </label>
                                    <input type="text" class="form-control" name="social[twitter]"
                                        placeholder="https://twitter.com/yourprofile"
                                        value="{{ old('social.twitter', $setting->social['twitter'] ?? '') }}">
                                </div>

                                <div class="custom-form-group">
                                    <label for="linkedin" class="custom-label">
                                        <i class="fab fa-linkedin"></i>LinkedIn
                                    </label>
                                    <input type="text" class="form-control" name="social[linkedin]"
                                        placeholder="https://linkedin.com/company/yourcompany"
                                        value="{{ old('social.linkedin', $setting->social['linkedin'] ?? '') }}">
                                </div>

                                <div class="custom-form-group">
                                    <label for="youtube" class="custom-label">
                                        <i class="fab fa-youtube"></i>YouTube
                                    </label>
                                    <input type="text" class="form-control" name="social[youtube]"
                                        placeholder="https://youtube.com/yourchannel"
                                        value="{{ old('social.youtube', $setting->social['youtube'] ?? '') }}">
                                </div>
                            </div>

                            <!-- SEO Tab -->
                            <div class="tab-pane" id="seo">
                                <div class="section-header">
                                    <h4><i class="fas fa-search mr-2"></i>SEO Settings</h4>
                                    <small>Optimize your website for search engines</small>
                                </div>

                                <div class="custom-form-group">
                                    <label for="meta_title" class="custom-label">
                                        <i class="fas fa-heading"></i>Meta Title
                                    </label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                        placeholder="Your Website Title" value="{{ old('meta_title', $setting->meta_title) }}">
                                    <small class="text-muted">Primary title for search engines</small>
                                </div>

                                <div class="custom-form-group">
                                    <label for="meta_keywords" class="custom-label">
                                        <i class="fas fa-tags"></i>Meta Keywords
                                    </label>
                                    <textarea name="meta_keywords" id="meta_keywords" class="form-control" rows="3"
                                              placeholder="keyword1, keyword2, keyword3">{{ old('meta_keywords', $setting->meta_keywords) }}</textarea>
                                    <small class="text-muted">Comma-separated keywords for SEO</small>
                                </div>

                                <div class="custom-form-group">
                                    <label for="meta_description" class="custom-label">
                                        <i class="fas fa-align-left"></i>Meta Description
                                    </label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" rows="4"
                                              placeholder="Brief description of your website">{{ old('meta_description', $setting->meta_description) }}</textarea>
                                    <small class="text-muted">This description appears in search engine results</small>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-gradient btn-lg" id="updateButton">
                                <i class="fas fa-save mr-2"></i>Update Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Auto-hide alerts
    $(".alert").delay(6000).slideUp(300);
    
    // Tab persistence
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('.nav-pills a[href="' + activeTab + '"]').tab('show');
    }
    
    // Enhanced form submission
    $('form').on('submit', function(e) {
        $('#updateButton').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Updating...');
        return true;
    });
});
</script>
@stop