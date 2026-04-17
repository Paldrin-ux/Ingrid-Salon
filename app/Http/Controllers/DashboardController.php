<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Setting;
use Carbon\Carbon;
use App\Events\StatusUpdated;

class DashboardController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrFail();
        $user = auth()->user();

        // Build filtered base query (no eager load yet — stats need a clean query)
        $baseQuery = Appointment::query();

        if (!$user->hasRole('admin')) {
            // Employee: only appointments assigned to them
            if ($user->employee) {
                $baseQuery->where('employee_id', $user->employee->id);
            } else {
                // Fallback: customer — show nothing on the dashboard
                $baseQuery->whereRaw('1 = 0');
            }
        }

        // ── Stats (run BEFORE get(), on fresh clones) ──────────────────────────
        $stats = $this->getAppointmentStats($baseQuery);

        // ── Appointments for the calendar (with relationships) ──────────────────
        $appointments = (clone $baseQuery)
            ->with(['employee.user', 'service', 'user'])
            ->get()
            ->map(function ($appointment) {
                try {
                    if (!str_contains($appointment->booking_time ?? '', '-')) {
                        throw new \Exception("Invalid time format");
                    }

                    $bookingDate = Carbon::parse($appointment->booking_date);
                    [$startTime, $endTime] = array_map('trim', explode('-', $appointment->booking_time));

                    $startDateTime = Carbon::createFromFormat('h:i A', $startTime)
                        ->setDate($bookingDate->year, $bookingDate->month, $bookingDate->day);

                    $endDateTime = Carbon::createFromFormat('h:i A', $endTime)
                        ->setDate($bookingDate->year, $bookingDate->month, $bookingDate->day);

                    if ($endDateTime->lt($startDateTime)) {
                        $endDateTime->addDay();
                    }

                    return [
                        'id'            => $appointment->id,
                        'title'         => sprintf('%s - %s',
                            $appointment->name,
                            $appointment->service->title ?? 'Service'
                        ),
                        'start'         => $startDateTime->toIso8601String(),
                        'end'           => $endDateTime->toIso8601String(),
                        'description'   => $appointment->notes,
                        'email'         => $appointment->email,
                        'phone'         => $appointment->phone,
                        'amount'        => $appointment->amount,
                        'status'        => $appointment->status,
                        'staff'         => $appointment->employee->user->name ?? 'Unassigned',
                        'color'         => $this->getStatusColor($appointment->status),
                        'service_title' => $appointment->service->title ?? 'Service',
                        'name'          => $appointment->name,
                        'notes'         => $appointment->notes,
                    ];
                } catch (\Exception $e) {
                    \Log::error("Format error for appointment {$appointment->id}: {$e->getMessage()}");
                    return null;
                }
            })->filter()->values();

        return view('backend.dashboard.index', compact('appointments', 'stats'));
    }

    private function getAppointmentStats($baseQuery): array
    {
        $today       = now()->format('Y-m-d');
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $endOfWeek   = now()->endOfWeek()->format('Y-m-d');

        return [
            // Today: appointments whose booking_date is today
            'today' => (clone $baseQuery)
                ->whereDate('booking_date', $today)
                ->count(),

            // Confirmed: exact case-sensitive match
            'confirmed' => (clone $baseQuery)
                ->where('status', 'Confirmed')
                ->count(),

            // Pending: match "Pending payment" (capital P)
            'pending' => (clone $baseQuery)
                ->where('status', 'Pending payment')
                ->count(),

            // This week: booking_date falls within the current week
            'weekly' => (clone $baseQuery)
                ->whereBetween('booking_date', [$startOfWeek, $endOfWeek])
                ->count(),
        ];
    }

    private function getStatusColor($status): string
    {
        return [
            'Pending payment' => '#f39c12',
            'Processing'      => '#3498db',
            'Confirmed'       => '#2ecc71',
            'Cancelled'       => '#ff0000',
            'Completed'       => '#008000',
            'On Hold'         => '#95a5a6',
            'Rescheduled'     => '#f1c40f',
            'No Show'         => '#e67e22',
        ][$status] ?? '#7f8c8d';
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:Pending payment,Processing,Confirmed,Cancelled,Completed,On Hold,No Show',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->status = $request->status;
        $appointment->save();

        event(new StatusUpdated($appointment));

        return back()->with('success', 'Status updated successfully');
    }
}