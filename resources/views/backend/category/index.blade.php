@extends('adminlte::page')

@section('title', 'All Categories')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-weight: 600; color: #2c3e50;">All Categories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background: transparent; padding: 0; margin: 0;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" style="color: #667eea; text-decoration: none;">
                            <i class="fas fa-home mr-1"></i>Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" style="color: #6c757d;">Category</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
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

    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <div class="mb-3">
                    <a href="{{ route('category.create') }}" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 10px; padding: 10px 20px; font-weight: 500;">
                        <i class="fas fa-plus mr-2"></i>Add New Category
                    </a>
                </div>

                <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px 15px 0 0; padding: 20px 25px; border: none;">
                        <h3 class="card-title" style="color: white; font-weight: 600; font-size: 1.2rem; margin: 0;">
                            <i class="fas fa-folder-open mr-2"></i>Categories List
                        </h3>
                    </div>

                    <div class="card-body" style="padding: 25px;">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover" style="width: 100%;">
                                <thead>
                                    <tr style="background: #f8f9fa;">
                                        <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none; text-align: center;">#</th>
                                        <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">Name</th>
                                        <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">Slug</th>
                                        <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none; text-align: center;">Service Count</th>
                                        <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none; text-align: center;">Status</th>
                                        <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none; text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr style="border-bottom: 1px solid #f0f0f0; transition: all 0.3s ease;">
                                            <td style="padding: 15px; vertical-align: middle; text-align: center;">
                                                <span style="font-weight: 600; color: #667eea;">{{ $loop->iteration }}</span>
                                            </td>
                                            <td style="padding: 15px; vertical-align: middle;">
                                                <a style="font-weight: 500; color: #2c3e50; font-size: 0.95rem;">{{ $category->title }}</a>
                                            </td>
                                            <td style="padding: 15px; vertical-align: middle; color: #6c757d; font-size: 0.9rem;">
                                                <i class="fas fa-link mr-1" style="color: #667eea;"></i>{{ $category->slug }}
                                            </td>
                                            <td style="padding: 15px; vertical-align: middle; text-align: center;">
                                                <span style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; display: inline-block; min-width: 50px;">
                                                    {{ $category->services->count() }}
                                                </span>
                                            </td>
                                            <td style="padding: 15px; vertical-align: middle; text-align: center;">
                                                @if ($category->status)
                                                    <span class="badge" style="background-color: #2ecc71; color: white; padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">
                                                        <i class="fas fa-check-circle mr-1"></i>Active
                                                    </span>
                                                @else
                                                    <span class="badge" style="background-color: #e74c3c; color: white; padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">
                                                        <i class="fas fa-times-circle mr-1"></i>Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td style="padding: 15px; vertical-align: middle; text-align: center;">
                                                <div style="display: flex; gap: 8px; justify-content: center;">
                                                    <a class="btn btn-sm" href="{{ route('category.edit', $category->id) }}"
                                                       style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; padding: 8px 16px; font-weight: 500; transition: all 0.3s ease;">
                                                        <i class="fas fa-pencil-alt mr-1"></i>Edit
                                                    </a>
                                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Are you sure you want to delete this category?');"
                                                                type="submit" class="btn btn-sm"
                                                                style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); color: white; border: none; border-radius: 8px; padding: 8px 16px; font-weight: 500; transition: all 0.3s ease;">
                                                            <i class="fas fa-trash mr-1"></i>Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Custom DataTable Styling */
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 8px 12px;
            transition: all 0.3s ease;
        }

        .dataTables_wrapper .dataTables_length select:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: none !important;
            color: white !important;
            border-radius: 8px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: none !important;
            color: white !important;
            border-radius: 8px;
        }

        /* Table Row Hover */
        #myTable tbody tr:hover {
            background-color: #f8f9ff !important;
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
        }

        /* Button Hover Effects */
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        button[type="submit"]:hover {
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }

        /* Custom Scrollbar */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
    </style>
@stop

@section('js')
    <script>
        $('#title').on("change keyup paste click", function() {
            var Text = $(this).val().trim();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $('#slug').val(Text);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search categories..."
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".alert").delay(6000).slideUp(300);
        });
    </script>
@stop