<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        // ===== Monthly Filter =====
        // Default: current month (e.g. "2025-03")
        $selectedMonth = $request->input('month', now()->format('Y-m'));

        $dateFrom = Carbon::parse($selectedMonth . '-01')->startOfDay();
        $dateTo   = $dateFrom->copy()->endOfMonth()->endOfDay();

        // ===== Fetch completed, unpaid appointments in the selected month =====
        $appointments = Appointment::with(['employee.user', 'service.category'])
            ->where('status', 'completed')
            ->where('commission_paid', false)          // excludes already-reset ones
            ->whereBetween('updated_at', [$dateFrom, $dateTo])
            ->get();

        $commissions = [];

        foreach ($appointments as $appointment) {
            if (
                !$appointment->employee ||
                !$appointment->employee->user ||
                !$appointment->service
            ) {
                continue;
            }

            $employee = $appointment->employee;
            $user     = $employee->user;
            $service  = $appointment->service;
            $category = $service->category;

            $type = strtolower($category->slug ?? '');

            if (strpos($type, 'home') !== false) {
                $rate = 0.50;
            } elseif (strpos($type, 'site') !== false || strpos($type, 'on-site') !== false) {
                $rate = 0.30;
            } else {
                $rate = 0.40;
            }

            $commissionAmount = $service->sale_price && $service->sale_price > 0
                ? $service->sale_price * $rate
                : $service->price * $rate;

            if (!isset($commissions[$employee->id])) {
                $commissions[$employee->id] = [
                    'name'               => $user->name ?? 'Unnamed',
                    'photo'              => $user->image ?? null,
                    'total_commission'   => 0,
                    'total_appointments' => 0,
                    'services'           => [],
                ];
            }

            $commissions[$employee->id]['total_commission']   += $commissionAmount;
            $commissions[$employee->id]['total_appointments'] ++;
            $commissions[$employee->id]['services'][] = [
                'title'      => $service->title ?? 'Unknown Service',
                'type'       => isset($category->slug)
                    ? ucwords(str_replace('-', ' ', $category->slug))
                    : '—',
                'price'      => $service->sale_price && $service->sale_price > 0
                    ? $service->sale_price
                    : $service->price,
                'commission' => $commissionAmount,
                'rate'       => $rate * 100,
            ];
        }

        // ===== Global Stats (not filtered) =====
        $totalAppointments     = Appointment::count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $pendingAppointments   = Appointment::where('status', 'Pending payment')->count();
        $cancelledAppointments = Appointment::where('status', 'cancelled')->count();

        // ===== Monthly chart for the selected month's year =====
        $monthlyAppointments = Appointment::selectRaw('MONTH(updated_at) as month, COUNT(*) as count')
            ->where('status', 'completed')
            ->whereYear('updated_at', $dateFrom->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $item->month = date('F', mktime(0, 0, 0, $item->month, 1));
                return $item;
            });

        // Build month options for dropdown (e.g., last 6 months, current, next 6 months)
        $monthOptions = [];
        $startMonth = now()->subMonths(6); // Start from 6 months ago
        $endMonth = now()->addMonths(6);   // End 6 months from now

        for ($m = $startMonth->copy(); $m->lessThanOrEqualTo($endMonth); $m->addMonth()) {
            $monthOptions[$m->format('Y-m')] = $m->format('F Y');
        }

        return view('admin.commissions.index', compact(
            'commissions',
            'totalAppointments',
            'completedAppointments',
            'pendingAppointments',
            'cancelledAppointments',
            'monthlyAppointments',
            'dateFrom',
            'dateTo',
            'selectedMonth',
            'monthOptions'
        ));
    }

    /**
     * Reset: mark all completed appointments in the selected month
     * as commission_paid = true so they won't appear in future reports.
     * This simulates "paying out" commissions for that month.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m',
        ]);

        $dateFrom = Carbon::parse($request->month . '-01')->startOfDay();
        $dateTo   = $dateFrom->copy()->endOfMonth()->endOfDay();

        $count = Appointment::where('status', 'completed')
            ->where('commission_paid', false)
            ->whereBetween('updated_at', [$dateFrom, $dateTo])
            ->count();

        Appointment::where('status', 'completed')
            ->where('commission_paid', false)
            ->whereBetween('updated_at', [$dateFrom, $dateTo])
            ->update(['commission_paid' => true]);

        $monthLabel = $dateFrom->format('F Y');

        return redirect()
            ->route('admin.commissions.index', ['month' => $request->month])
            ->with('success', "✅ {$count} commission(s) for {$monthLabel} have been marked as paid and reset successfully.");
    }
}