@extends('adminlte::page')
@section('title', 'Commissions')

@section('content_header')
<div class="container py-5">

    <h2 class="mb-4 fw-bold text-center">✂️ Employee Commissions Dashboard</h2>

    {{-- ===== Flash Message ===== --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    {{-- ===== Month Filter Bar ===== --}}
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body py-3">
            <form method="GET" action="{{ route('admin.commissions.index') }}">
                <div class="d-flex align-items-center gap-2 flex-wrap">

                    {{-- Month label --}}
                    <span class="text-muted small fw-semibold me-1">
                        <i class="fas fa-calendar-alt me-1"></i> Month:
                    </span>

                    {{-- Month Dropdown --}}
                    <select name="month" class="form-select form-select-sm" style="width: auto; min-width: 160px;"
                            onchange="this.form.submit()">
                        @foreach($monthOptions as $value => $label)
                            <option value="{{ $value }}" {{ $selectedMonth === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Active period badge --}}
                    <span class="badge bg-light text-secondary border ms-1" style="font-size: 0.78rem; font-weight: 500;">
                        {{ $dateFrom->format('M d') }} – {{ $dateTo->format('M d, Y') }}
                    </span>

                    {{-- Spacer --}}
                    <div class="ms-auto d-flex gap-2 align-items-center">
                        {{-- Reset to current month --}}
                        <a href="{{ route('admin.commissions.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sync-alt me-1"></i> Current Month
                        </a>

                        {{-- Reset Commission Button --}}
                        <button type="button" class="btn btn-sm btn-outline-danger" id="openResetBtn">
                            <i class="fas fa-redo me-1"></i> Reset Month
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== Summary Cards ===== --}}
    <div class="row mb-5">
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Appointments</h6>
                            <h2 class="mb-0 fw-bold">{{ $totalAppointments ?? 0 }}</h2>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-calendar-check fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0 h-100" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Completed</h6>
                            <h2 class="mb-0 fw-bold">{{ $completedAppointments ?? 0 }}</h2>
                            @php
                                $completedPercent = $totalAppointments > 0 ? round(($completedAppointments / $totalAppointments) * 100, 1) : 0;
                            @endphp
                            <small class="text-white-50">{{ $completedPercent }}%</small>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-check-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0 h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Pending</h6>
                            <h2 class="mb-0 fw-bold">{{ $pendingAppointments ?? 0 }}</h2>
                            @php
                                $pendingPercent = $totalAppointments > 0 ? round(($pendingAppointments / $totalAppointments) * 100, 1) : 0;
                            @endphp
                            <small class="text-white-50">{{ $pendingPercent }}%</small>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-clock fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0 h-100" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Cancelled</h6>
                            <h2 class="mb-0 fw-bold">{{ $cancelledAppointments ?? 0 }}</h2>
                            @php
                                $cancelledPercent = $totalAppointments > 0 ? round(($cancelledAppointments / $totalAppointments) * 100, 1) : 0;
                            @endphp
                            <small class="text-white-50">{{ $cancelledPercent }}%</small>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-times-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Charts Section ===== --}}
    <div class="row mb-5 align-items-stretch">
        <div class="col-lg-8 mb-4 d-flex">
            <div class="card shadow-sm border-0 flex-fill">
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 fw-bold">📊 Monthly Performance</h4>
                            <p class="text-muted mb-0 small">Appointments and commission trends</p>
                        </div>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary active" onclick="switchChart('bar', event)">Bar</button>
                            <button type="button" class="btn btn-outline-primary" onclick="switchChart('line', event)">Line</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="140"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4 d-flex">
            <div class="card shadow-sm border-0 flex-fill">
                <div class="card-header bg-white border-0 pt-4">
                    <h4 class="mb-1 fw-bold">💰 Commission Share</h4>
                    <p class="text-muted mb-0 small">Top performer and distribution</p>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    @if(!empty($commissions) && count($commissions) > 0)
                        @php $topPerformer = collect($commissions)->sortByDesc('total_commission')->first(); @endphp
                        <div class="mb-4">
                            <img src="{{ !empty($topPerformer['photo']) ? asset('uploads/images/profile/' . $topPerformer['photo']) : asset('vendor/adminlte/dist/img/emplo.jpg') }}"
                                 class="rounded-circle border border-secondary mb-2" width="70" height="70">
                            <h5 class="fw-bold mb-0">{{ $topPerformer['name'] }}</h5>
                            <small class="text-muted d-block mb-2">Top Employee – {{ $dateFrom->format('F Y') }}</small>
                            <h6 class="fw-bold text-success mb-0">₱{{ number_format($topPerformer['total_commission'] ?? 0, 2) }}</h6>
                            <small class="text-muted">Total Commission</small>
                        </div>
                    @endif
                    <div class="flex-grow-1 d-flex align-items-center justify-content-center">
                        <canvas id="commissionPieChart" style="max-height: 240px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Commission Table ===== --}}
    <div class="card shadow-sm border-0 w-100">
        <div class="card-header bg-white border-0 pt-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1 fw-bold">👥 Employee Commission Report</h4>
                    <p class="text-muted mb-0 small">
                        {{ $dateFrom->format('F Y') }} &middot;
                        <span class="text-primary">{{ $dateFrom->format('M d') }} – {{ $dateTo->format('M d, Y') }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(!empty($commissions) && count($commissions) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Employee</th>
                                <th class="text-center">Appointments</th>
                                <th class="text-center">Avg Commission</th>
                                <th class="text-end">Total Commission</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commissions as $index => $employee)
                                @php
                                    $totalComm  = $employee['total_commission'] ?? 0;
                                    $totalAppts = $employee['total_appointments'] ?? 1;
                                    $avgComm    = $totalAppts > 0 ? $totalComm / $totalAppts : 0;
                                @endphp
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center">
                                            @if(!empty($employee['photo']))
                                                <img src="{{ asset('uploads/images/profile/' . $employee['photo']) }}"
                                                     class="rounded-circle border me-3" width="45" height="45">
                                            @else
                                                <img src="{{ asset('vendor/adminlte/dist/img/emplo.jpg') }}"
                                                     class="rounded-circle border me-3" width="45" height="45">
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ $employee['name'] }}</div>
                                                <small class="text-muted">ID: EMP-{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill">{{ $totalAppts }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-muted">₱{{ number_format($avgComm, 2) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-success fs-6">₱{{ number_format($totalComm, 2) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-info view-btn"
                                                data-name="{{ $employee['name'] }}"
                                                data-services='@json($employee["services"] ?? [])'
                                                data-total="{{ number_format($totalComm, 2) }}">
                                            <i class="fas fa-eye me-1"></i> View Details
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                @php
                                    $totalApptSum = array_sum(array_column($commissions, 'total_appointments'));
                                    $totalCommSum = array_sum(array_column($commissions, 'total_commission'));
                                @endphp
                                <th class="ps-3">Total</th>
                                <th class="text-center">{{ $totalApptSum }}</th>
                                <th></th>
                                <th class="text-end fw-bold text-success">₱{{ number_format($totalCommSum, 2) }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-1">No unpaid commissions for {{ $dateFrom->format('F Y') }}.</p>
                    <small class="text-muted">
                        This month may have already been reset, or no appointments were completed.
                    </small>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ===== Reset Confirmation Modal ===== --}}
<div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true" style="display:none; align-items:center; justify-content:center;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, #f5576c 0%, #fa709a 100%);">
                <h6 class="modal-title text-white fw-bold" id="resetModalLabel">
                    <i class="fas fa-redo me-2"></i> Reset Monthly Commissions
                </h6>
                <button type="button" id="closeResetModal" style="background:none;border:none;color:#fff;font-size:1.4rem;opacity:0.8;line-height:1;" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body p-4">

                {{-- What this does --}}
                <div class="mb-3 p-3 rounded" style="background: #fff8e1; border-left: 4px solid #f59e0b;">
                    <p class="mb-1 small fw-semibold text-warning-emphasis">
                        <i class="fas fa-info-circle me-1"></i> What does Reset do?
                    </p>
                    <p class="mb-0 small text-muted">
                        It marks all <strong>completed</strong> appointments for this month as <strong>commission paid</strong>.
                        They will no longer appear in the commission report — meaning you're confirming that employees
                        have been paid for this period and the slate is cleared for next month.
                    </p>
                </div>

                <p class="text-muted small mb-2">You are resetting commissions for:</p>
                <div class="text-center mb-3">
                    <span class="badge fs-6 px-3 py-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-calendar me-1"></i>
                        {{ $dateFrom->format('F Y') }}
                        &nbsp;·&nbsp;
                        {{ $dateFrom->format('M d') }} – {{ $dateTo->format('M d, Y') }}
                    </span>
                </div>

                <div class="alert alert-danger border-0 py-2 small mb-3">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    <strong>This cannot be undone.</strong> Appointments will be excluded from all future reports.
                </div>

                <form method="POST" action="{{ route('admin.commissions.reset') }}">
                    @csrf
                    <input type="hidden" name="month" value="{{ $selectedMonth }}">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary flex-fill" id="cancelResetModal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-sm btn-danger flex-fill">
                            <i class="fas fa-redo me-1"></i> Confirm Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ===== Slide Panel ===== --}}
<div id="panelOverlay" class="panel-overlay"></div>
<div id="sidePanel" class="side-panel">
    <div class="side-panel-header d-flex justify-content-between align-items-center p-4"
         style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div>
            <h5 id="employeeName" class="m-0 fw-bold text-white"></h5>
            <small class="text-white-50">Commission Breakdown</small>
        </div>
        <button class="btn btn-light btn-sm rounded-circle" id="closePanel" style="width:35px;height:35px;">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="side-panel-body p-4">
        <div class="mb-4">
            <div class="card bg-light border-0">
                <div class="card-body text-center">
                    <small class="text-muted d-block mb-1">Total Earnings</small>
                    <h3 class="mb-0 fw-bold text-success">₱<span id="totalCommission"></span></h3>
                </div>
            </div>
        </div>
        <h6 class="fw-bold mb-3">Service Details</h6>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Service</th>
                        <th>Type</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Commission</th>
                    </tr>
                </thead>
                <tbody id="serviceList"></tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .stats-icon { opacity: 0.3; }
    .panel-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.4); backdrop-filter: blur(4px);
        opacity: 0; visibility: hidden; transition: all 0.3s ease; z-index: 1049;
    }
    .panel-overlay.show { opacity: 1; visibility: visible; }
    .side-panel {
        position: fixed; top: 0; right: -500px; width: 480px; height: 100vh;
        background: #fff; box-shadow: -8px 0 24px rgba(0,0,0,0.15);
        z-index: 1050; transition: right 0.4s cubic-bezier(0.4,0,0.2,1); overflow-y: auto;
    }
    .side-panel.show { right: 0; }
    .side-panel-body { animation: fadeInUp 0.4s ease; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .card { transition: transform 0.2s, box-shadow 0.2s; }
    .card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important; }
    .table tbody tr { transition: background-color 0.2s; }
    .table tbody tr:hover { background-color: rgba(0,0,0,0.02); }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const commissionsData = @json(array_values($commissions ?? []));
    const monthlyLabels   = @json($monthlyAppointments->pluck('month') ?? []);
    const monthlyData     = @json($monthlyAppointments->pluck('count') ?? []);
    const commissionData  = monthlyData.map(count => count * 50);

    // ===== Monthly Chart =====
    const ctx = document.getElementById('monthlyChart');
    let monthlyChart;
    let currentChartType = 'bar';

    function buildChart(type) {
        if (monthlyChart) monthlyChart.destroy();
        monthlyChart = new Chart(ctx.getContext('2d'), {
            type: type,
            data: {
                labels: monthlyLabels,
                datasets: [
                    {
                        label: 'Appointments',
                        data: monthlyData,
                        backgroundColor: type === 'line' ? 'rgba(102,126,234,0.1)' : 'rgba(102,126,234,0.8)',
                        borderColor: 'rgba(102,126,234,1)',
                        borderWidth: type === 'line' ? 3 : 2,
                        borderRadius: type === 'bar' ? 8 : 0,
                        fill: type === 'line', tension: 0.4, yAxisID: 'y',
                    },
                    {
                        label: 'Commission (₱)',
                        data: commissionData,
                        backgroundColor: type === 'line' ? 'rgba(56,239,125,0.1)' : 'rgba(56,239,125,0.8)',
                        borderColor: 'rgba(56,239,125,1)',
                        borderWidth: type === 'line' ? 3 : 2,
                        borderRadius: type === 'bar' ? 8 : 0,
                        fill: type === 'line', tension: 0.4, yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: true,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: true, position: 'top', labels: { usePointStyle: true, padding: 15, font: { size: 12, weight: '600' } } },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)', padding: 12,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label + ': ';
                                label += context.datasetIndex === 1
                                    ? '₱' + context.parsed.y.toLocaleString()
                                    : context.parsed.y;
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y:  { type: 'linear', position: 'left',  beginAtZero: true, ticks: { precision: 0 }, grid: { color: 'rgba(0,0,0,0.05)' } },
                    y1: { type: 'linear', position: 'right', beginAtZero: true, ticks: { callback: v => '₱' + v.toLocaleString() }, grid: { drawOnChartArea: false } },
                    x:  { grid: { display: false } }
                }
            }
        });
    }

    if (ctx) buildChart('bar');

    window.switchChart = function(type, event) {
        if (type === currentChartType) return;
        currentChartType = type;
        buildChart(type);
        document.querySelectorAll('.btn-group button').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
    };

    // ===== Pie Chart =====
    const pieCtx = document.getElementById('commissionPieChart');
    if (pieCtx && commissionsData.length > 0) {
        const top = commissionsData.slice(0, 5);
        new Chart(pieCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: top.map(e => e.name || 'Unknown'),
                datasets: [{
                    data: top.map(e => parseFloat(e.total_commission) || 0),
                    backgroundColor: [
                        'rgba(102,126,234,0.8)', 'rgba(56,239,125,0.8)',
                        'rgba(245,87,108,0.8)',  'rgba(250,112,154,0.8)',
                        'rgba(254,225,64,0.8)',
                    ],
                    borderWidth: 3, borderColor: '#fff'
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'bottom', labels: { padding: 12, font: { size: 11 }, usePointStyle: true } },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                const v = ctx.parsed || 0;
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = total > 0 ? ((v / total) * 100).toFixed(1) : 0;
                                return ctx.label + ': ₱' + v.toLocaleString() + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // ===== Reset Modal (pure JS — works with both Bootstrap 4 & 5) =====
    const resetModal     = document.getElementById('resetModal');
    const openResetBtn   = document.getElementById('openResetBtn');
    const closeResetModal  = document.getElementById('closeResetModal');
    const cancelResetModal = document.getElementById('cancelResetModal');

    function showResetModal() {
        resetModal.style.display = 'flex';
        resetModal.classList.add('show');
        document.body.classList.add('modal-open');

        // overlay backdrop
        let backdrop = document.getElementById('resetBackdrop');
        if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.id = 'resetBackdrop';
            backdrop.className = 'modal-backdrop fade show';
            document.body.appendChild(backdrop);
        }
    }

    function hideResetModal() {
        resetModal.style.display = 'none';
        resetModal.classList.remove('show');
        document.body.classList.remove('modal-open');
        const backdrop = document.getElementById('resetBackdrop');
        if (backdrop) backdrop.remove();
    }

    if (openResetBtn)    openResetBtn.addEventListener('click', showResetModal);
    if (closeResetModal) closeResetModal.addEventListener('click', hideResetModal);
    if (cancelResetModal) cancelResetModal.addEventListener('click', hideResetModal);

    // Close on backdrop click
    resetModal.addEventListener('click', function (e) {
        if (e.target === resetModal) hideResetModal();
    });

    // ===== Side Panel =====
    const sidePanel  = document.getElementById('sidePanel');
    const overlay    = document.getElementById('panelOverlay');
    const closePanel = document.getElementById('closePanel');

    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('employeeName').innerText    = this.dataset.name;
            document.getElementById('totalCommission').innerText = this.dataset.total;

            const services = JSON.parse(this.dataset.services);
            const list = document.getElementById('serviceList');
            list.innerHTML = '';

            if (!services || services.length === 0) {
                list.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-4">No services found.</td></tr>';
            } else {
                services.forEach(s => {
                    list.innerHTML += `
                        <tr>
                            <td class="fw-medium">${s.title ?? 'Unknown'}</td>
                            <td><span class="badge bg-light text-dark">${s.type ?? '—'}</span></td>
                            <td class="text-end">₱${parseFloat(s.price ?? 0).toFixed(2)}</td>
                            <td class="text-end text-success fw-bold">₱${parseFloat(s.commission ?? 0).toFixed(2)}</td>
                        </tr>`;
                });
            }

            sidePanel.classList.add('show');
            overlay.classList.add('show');
        });
    });

    closePanel.addEventListener('click', () => { sidePanel.classList.remove('show'); overlay.classList.remove('show'); });
    overlay.addEventListener('click',    () => { sidePanel.classList.remove('show'); overlay.classList.remove('show'); });
});
</script>
@endsection