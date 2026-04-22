@extends('adminlte::page')

@section('title', 'All Appointments')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0" style="font-weight: 600; color: #2c3e50;">All Appointments</h1>
        </div>
        <div class="col-sm-6 text-right">
            <button type="button" id="bulkDeleteBtn" class="btn btn-danger shadow-sm" style="display:none; border-radius: 10px; padding: 10px 20px; font-weight: 600; background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); border: none;">
                <i class="fas fa-trash-alt mr-2"></i>Delete Selected (<span id="selectedCount">0</span>)
            </button>
        </div>
    </div>
@stop

@section('content')
    <form id="bulkDeleteForm" action="{{ route('appointments.bulkDestroy') }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="modal fade" id="appointmentModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                    <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px 15px 0 0; border: none; padding: 25px 30px;">
                        <h5 class="modal-title" style="color: white; font-weight: 600; font-size: 1.3rem;">
                            <i class="fas fa-calendar-check mr-2"></i>Appointment Details
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 1;">
                            <span aria-hidden="true" style="font-size: 1.8rem;">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" style="padding: 30px;">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="detail-item" style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #667eea;">
                                    <small style="color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">Client Name</small>
                                    <p style="margin: 5px 0 0 0; font-weight: 500; color: #2c3e50; font-size: 1rem;" id="modalAppointmentName">N/A</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item" style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #764ba2;">
                                    <small style="color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">Service</small>
                                    <p style="margin: 5px 0 0 0; font-weight: 500; color: #2c3e50; font-size: 1rem;" id="modalService">N/A</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item" style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #f093fb;">
                                    <small style="color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">Email</small>
                                    <p style="margin: 5px 0 0 0; font-weight: 500; color: #2c3e50; font-size: 1rem;" id="modalEmail">N/A</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item" style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #4facfe;">
                                    <small style="color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">Phone</small>
                                    <p style="margin: 5px 0 0 0; font-weight: 500; color: #2c3e50; font-size: 1rem;" id="modalPhone">N/A</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item" style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #43e97b;">
                                    <small style="color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">Staff Member</small>
                                    <p style="margin: 5px 0 0 0; font-weight: 500; color: #2c3e50; font-size: 1rem;" id="modalStaff">N/A</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item" style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #fa709a;">
                                    <small style="color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">Date & Time</small>
                                    <p style="margin: 5px 0 0 0; font-weight: 500; color: #2c3e50; font-size: 1rem;" id="modalStartTime">N/A</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item" style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #feca57;">
                                    <small style="color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">Amount</small>
                                    <p style="margin: 5px 0 0 0; font-weight: 500; color: #2c3e50; font-size: 1rem;" id="modalAmount">N/A</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-item" style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #ff6b6b;">
                                    <small style="color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">Current Status</small>
                                    <p style="margin: 5px 0 0 0; font-weight: 500; color: #2c3e50; font-size: 1rem;" id="modalStatusBadge">N/A</p>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="detail-item" style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #a29bfe;">
                                    <small style="color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">Notes</small>
                                    <p style="margin: 5px 0 0 0; font-weight: 400; color: #2c3e50; font-size: 0.95rem;" id="modalNotes">N/A</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label style="font-weight: 600; color: #2c3e50; font-size: 1rem; margin-bottom: 10px;">
                                <i class="fas fa-edit mr-2"></i>Update Status
                            </label>
                            <select name="status" class="form-control" id="modalStatusSelect" style="border-radius: 10px; border: 2px solid #e0e0e0; padding: 12px; font-size: 1rem;">
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

                    <div class="modal-footer" style="border: none; padding: 20px 30px; background: #f8f9fa; border-radius: 0 0 15px 15px;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; padding: 10px 25px; font-weight: 500;">
                            <i class="fas fa-times mr-2"></i>Close
                        </button>
                        <button type="button" id="submitStatusUpdate" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 10px; padding: 10px 25px; font-weight: 500;">
                            <i class="fas fa-save mr-2"></i>Update Status
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            @if (session('success'))
                <div class="alert alert-success alert-dismissable" style="border-radius: 12px; border-left: 4px solid #28a745; background: #d4edda; border: 1px solid #c3e6cb;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="fas fa-check-circle mr-2"></i><strong>{{ session('success') }}</strong>
                </div>
            @endif

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px 15px 0 0; padding: 20px 25px; border: none;">
                                    <h3 class="card-title" style="color: white; font-weight: 600; font-size: 1.2rem; margin: 0;">
                                        <i class="fas fa-list-ul mr-2"></i>Appointments List
                                    </h3>
                                </div>
                                
                                <!-- Filter Section -->
                                <div class="card-body" style="padding: 20px 25px; border-bottom: 1px solid #f0f0f0; background: #f8f9fa;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">
                                                    <i class="fas fa-search mr-2"></i>Search Appointments
                                                </label>
                                                <input type="text" id="appointmentSearch" class="form-control" placeholder="Search by name, email, phone..." style="border-radius: 8px; border: 2px solid #e0e0e0; padding: 10px 15px; transition: all 0.3s ease;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label style="font-weight: 600; color: #2c3e50; margin-bottom: 8px;">
                                                    <i class="fas fa-filter mr-2"></i>Filter by Status
                                                </label>
                                                <select id="statusFilter" class="form-control" style="border-radius: 8px; border: 2px solid #e0e0e0; padding: 10px 15px; transition: all 0.3s ease;">
                                                    <option value="">All Statuses</option>
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
                                    </div>
                                </div>

                                <div class="card-body" style="padding: 25px;">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-hover" style="width: 100%;">
                                            <thead>
                                                <tr style="background: #f8f9fa;">
                                                    <th style="padding: 15px; border: none; width: 40px;">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="selectAll">
                                                            <label class="custom-control-label" for="selectAll"></label>
                                                        </div>
                                                    </th>
                                                    <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">User</th>
                                                    <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">Email</th>
                                                    <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">Phone</th>
                                                    <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">Staff</th>
                                                    <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">Service</th>
                                                    <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">Date</th>
                                                    <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">Time</th>
                                                    <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">Status</th>
                                                    <th style="padding: 15px; font-weight: 600; color: #2c3e50; border: none;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
                                                @endphp
                                                @foreach ($appointments as $appointment)
                                                    <tr style="border-bottom: 1px solid #f0f0f0; transition: all 0.3s ease;" data-status="{{ $appointment->status }}">
                                                        <td style="padding: 15px; vertical-align: middle;">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="ids[]" value="{{ $appointment->id }}" class="custom-control-input appointment-checkbox" id="check-{{ $appointment->id }}">
                                                                <label class="custom-control-label" for="check-{{ $appointment->id }}"></label>
                                                            </div>
                                                        </td>
                                                        <td style="padding: 15px; vertical-align: middle;">
                                                            <div>
                                                                <a style="font-weight: 500; color: #2c3e50; font-size: 0.95rem;">{{ $appointment->name }}</a>
                                                                <br>
                                                                <small style="color: #6c757d;">
                                                                    <i class="far fa-calendar-alt mr-1"></i>{{ $appointment->created_at->format('d M Y') }}
                                                                </small>
                                                            </div>
                                                        </td>
                                                        <td style="padding: 15px; vertical-align: middle; color: #6c757d; font-size: 0.9rem;">
                                                            <i class="far fa-envelope mr-1" style="color: #667eea;"></i>{{ $appointment->email }}
                                                        </td>
                                                        <td style="padding: 15px; vertical-align: middle; color: #6c757d; font-size: 0.9rem;">
                                                            <i class="fas fa-phone mr-1" style="color: #764ba2;"></i>{{ $appointment->phone }}
                                                        </td>
                                                        <td style="padding: 15px; vertical-align: middle;">
                                                            <span style="background: #f0f0ff; color: #667eea; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">
                                                                {{ $appointment->employee->user->name }}
                                                            </span>
                                                        </td>
                                                        <td style="padding: 15px; vertical-align: middle; color: #2c3e50; font-weight: 500;">{{ $appointment->service->title ?? 'NA' }}</td>
                                                        <td style="padding: 15px; vertical-align: middle; color: #6c757d;">{{ $appointment->booking_date }}</td>
                                                        <td style="padding: 15px; vertical-align: middle; color: #6c757d; font-weight: 500;">{{ $appointment->booking_time }}</td>
                                                        <td style="padding: 15px; vertical-align: middle; text-align: center;">
                                                            @php
                                                                $status = $appointment->status;
                                                                $color = $statusColors[$status] ?? '#7f8c8d';
                                                            @endphp
                                                            <span class="badge" style="background-color: {{ $color }}; color: white; padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; display: inline-block; min-width: 100px;">
                                                                {{ $status }}
                                                            </span>
                                                        </td>
                                                        <td style="padding: 15px; vertical-align: middle;">
                                                            <div style="display: flex; gap: 8px;">
                                                                <button type="button" class="btn btn-sm view-appointment-btn" 
                                                                    data-toggle="modal" data-target="#appointmentModal"
                                                                    data-id="{{ $appointment->id }}"
                                                                    data-name="{{ $appointment->name }}"
                                                                    data-service="{{ $appointment->service->title ?? 'NA' }}"
                                                                    data-email="{{ $appointment->email }}"
                                                                    data-phone="{{ $appointment->phone }}"
                                                                    data-employee="{{ $appointment->employee->user->name }}"
                                                                    data-start="{{ $appointment->booking_date . ' ' . $appointment->booking_time }}"
                                                                    data-amount="{{ $appointment->amount }}"
                                                                    data-notes="{{ $appointment->notes }}"
                                                                    data-status="{{ $appointment->status }}"
                                                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; padding: 8px 16px; font-weight: 500; transition: all 0.3s ease;">
                                                                    <i class="fas fa-eye mr-1"></i>View
                                                                </button>
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
            </section>
        </div>
    </form>

    <form id="individualDeleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <form id="statusUpdateForm" action="{{ route('appointments.update.status') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="appointment_id" id="status_appointment_id">
        <input type="hidden" name="status" id="status_value">
    </form>
@stop

@section('css')
    <style>
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input { border: 2px solid #e0e0e0; border-radius: 8px; padding: 8px 12px; transition: all 0.3s ease; }
        .dataTables_wrapper .dataTables_length select:focus, .dataTables_wrapper .dataTables_filter input:focus { border-color: #667eea; outline: none; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; border: none !important; color: white !important; border-radius: 8px; }
        #myTable tbody tr:hover { background-color: #f8f9ff !important; transform: scale(1.002); box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1); }
        .view-appointment-btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3); }
        .modal.fade .modal-dialog { transform: scale(0.8); transition: transform 0.3s ease-out; }
        .modal.show .modal-dialog { transform: scale(1); }
        .table-responsive::-webkit-scrollbar { height: 8px; }
        .table-responsive::-webkit-scrollbar-thumb { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; }
        
        /* Filter input focus styles */
        #appointmentSearch:focus, #statusFilter:focus { border-color: #667eea !important; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important; }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                responsive: true,
                pageLength: 10,
                columnDefs: [{ orderable: false, targets: 0 }],
                language: { search: "_INPUT_", searchPlaceholder: "Search appointments..." }
            });

            // Custom search and status filter
            $('#appointmentSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#statusFilter').on('change', function() {
                var statusValue = this.value;
                if (statusValue === '') {
                    // Show all rows
                    table.column(8).search('').draw();
                } else {
                    // Filter by selected status
                    table.column(8).search(statusValue, false, false).draw();
                }
            });

            // Select All logic
            $('#selectAll').on('click', function() {
                var rows = table.rows({ 'search': 'applied' }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
                toggleBulkDeleteBtn();
            });

            $('#myTable tbody').on('change', '.appointment-checkbox', function() {
                if (!this.checked) {
                    var el = $('#selectAll').get(0);
                    if (el && el.checked) el.checked = false;
                }
                toggleBulkDeleteBtn();
            });

            function toggleBulkDeleteBtn() {
                var checkedCount = $('.appointment-checkbox:checked').length;
                if (checkedCount > 0) {
                    $('#bulkDeleteBtn').fadeIn();
                    $('#selectedCount').text(checkedCount);
                } else {
                    $('#bulkDeleteBtn').fadeOut();
                }
            }

            // Handle Bulk Delete Submit
            $('#bulkDeleteBtn').on('click', function() {
                if (confirm('Are you sure you want to delete ' + $('.appointment-checkbox:checked').length + ' selected appointments?')) {
                    $('#bulkDeleteForm').submit();
                }
            });

            // Modal logic
            $(document).on('click', '.view-appointment-btn', function() {
                var id = $(this).data('id');
                $('#status_appointment_id').val(id);
                $('#modalAppointmentName').text($(this).data('name'));
                $('#modalService').text($(this).data('service'));
                $('#modalEmail').text($(this).data('email'));
                $('#modalPhone').text($(this).data('phone'));
                $('#modalStaff').text($(this).data('employee'));
                $('#modalStartTime').text($(this).data('start'));
                $('#modalAmount').text($(this).data('amount'));
                $('#modalNotes').text($(this).data('notes') || 'No notes available');
                $('#modalStatusSelect').val($(this).data('status'));

                var statusColors = {
                    'Pending payment': '#f39c12', 'Processing': '#3498db', 'Confirmed': '#2ecc71',
                    'Cancelled': '#ff0000', 'Completed': '#008000', 'On Hold': '#95a5a6',
                    'Rescheduled': '#f1c40f', 'No Show': '#e67e22',
                };
                var badgeColor = statusColors[$(this).data('status')] || '#7f8c8d';
                $('#modalStatusBadge').html(`<span class="badge" style="background-color: ${badgeColor}; color: white; padding: 8px 16px; border-radius: 20px;">${$(this).data('status')}</span>`);
            });

            // Handle Status Update via separate form to avoid nesting
            $('#submitStatusUpdate').on('click', function() {
                if(confirm('Update status?')) {
                    $('#status_value').val($('#modalStatusSelect').val());
                    $('#statusUpdateForm').submit();
                }
            });

            $(".alert").delay(6000).slideUp(300);
        });
    </script>
@endsection
