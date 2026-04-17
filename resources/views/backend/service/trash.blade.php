@extends('adminlte::page')

@section('title', 'Trash Services')

@section('content_header')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-1 font-weight-bold text-dark">
                <i class="fas fa-trash mr-2 text-danger"></i>Deleted Services
            </h1>
            <p class="text-muted mb-0 small">All deleted services - you can restore or delete permanently</p>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('service.create') }}" class="btn btn-primary btn-sm shadow-sm mr-2">
                <i class="fas fa-plus mr-1"></i> Add New
            </a>
            <a href="{{ route('service.index') }}" class="btn btn-outline-primary btn-sm shadow-sm">
                <i class="fas fa-list mr-1"></i> View All
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
        margin-bottom: 20px;
    }
    
    .profile-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    }

    /* Table Styling */
    .custom-table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }
    
    .custom-table thead th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        font-weight: 600;
        padding: 15px 12px;
    }
    
    .custom-table tbody td {
        padding: 12px;
        vertical-align: middle;
        border-color: #f8f9fa;
    }
    
    .custom-table tbody tr {
        transition: all 0.3s ease;
    }
    
    .custom-table tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    /* Badge Styling */
    .badge-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .badge-danger {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
    }

    /* Button Styling */
    .btn-restore {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        color: white;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-restore:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        color: white;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        border: none;
        color: white;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-delete:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        color: white;
    }

    /* Alert Styling */
    .alert {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Image Styling */
    .table-img {
        width: 75px;
        height: 75px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    /* Status Styling */
    .project-state {
        font-weight: 600;
    }

    /* Action Buttons Container */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #dee2e6;
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
        <div class="card profile-card">
            <div class="card-body p-4">
                @if($services->count() > 0)
                    <div class="table-responsive">
                        <table id="table-1" class="table custom-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%">
                                        #
                                    </th>
                                    <th style="width: 25%">
                                        Service Details
                                    </th>
                                    <th style="width: 15%">
                                        Image
                                    </th>
                                    <th style="width: 15%">
                                        Category
                                    </th>
                                    <th style="width: 10%">
                                        Featured
                                    </th>
                                    <th style="width: 10%" class="text-center">
                                        Status
                                    </th>
                                    <th style="width: 20%" class="text-center">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td class="font-weight-bold">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="font-weight-bold text-dark mb-1">
                                                    {{ $service->title }}
                                                </span>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Deleted: {{ $service->deleted_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($service->image)
                                                <img class="table-img"
                                                    src="{{ asset('uploads/images/service/' . $service->image) }}"
                                                    alt="{{ $service->title }}">
                                            @else
                                                <img class="table-img"
                                                    src="{{ asset('uploads/images/no-image.jpg') }}" 
                                                    alt="No Image">
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-light border px-3 py-2">
                                                <i class="fas fa-folder mr-1"></i>
                                                {{ $service->category->title ?? 'NA' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($service->featured)
                                                <span class="badge badge-warning px-3 py-2">
                                                    <i class="fas fa-star mr-1"></i>Yes
                                                </span>
                                            @else
                                                <span class="badge badge-secondary px-3 py-2">
                                                    <i class="fas fa-star mr-1"></i>No
                                                </span>
                                            @endif
                                        </td>
                                        <td class="project-state text-center">
                                            @if ($service->status)
                                                <span class="badge badge-success px-3 py-2">Active</span>
                                            @else
                                                <span class="badge badge-danger px-3 py-2">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a onclick="return confirm('Are you sure you want to Restore this service?');"
                                                    class="btn btn-restore btn-sm"
                                                    href="{{ route('service.restore', $service->id) }}">
                                                    <i class="fas fa-undo mr-1"></i> Restore
                                                </a>
                                                <form action="{{ route('service.force.delete', $service->id) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to permanently delete this service? This action cannot be undone.');"
                                                        type="submit" class="btn btn-delete btn-sm">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-trash-alt"></i>
                        <h4 class="mt-3">No Deleted Services</h4>
                        <p class="text-muted">There are no services in the trash bin.</p>
                        <a href="{{ route('service.index') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Services
                        </a>
                    </div>
                @endif
                
                @if($services->count() > 0)
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Showing {{ $services->count() }} deleted services
                        </div>
                        <div class="float-right">
                            {{-- {{ $services->links() }} --}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Auto-hide alerts
        $(".alert").delay(6000).slideUp(300);
        
        // Initialize DataTable
        $('#table-1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "emptyTable": "No deleted services found",
                "info": "Showing _START_ to _END_ of _TOTAL_ services",
                "infoEmpty": "Showing 0 to 0 of 0 services",
                "infoFiltered": "(filtered from _MAX_ total services)",
                "search": "Search services:",
                "zeroRecords": "No matching services found"
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // show error message
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

        // success message
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