<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use Illuminate\Support\Facades\Mail;

class UserNotifyBookingCreated
{
    /**
     * Handle the event.
     */
    public function handle(BookingCreated $event): void
    {
        $appointment = $event->appointment;

        if (!empty($appointment->email)) {

            $serviceName = $appointment->service->title ?? 'N/A';
            $date = $appointment->booking_date ?? 'Not specified';
            $time = $appointment->booking_time ?? 'Not specified';
            $customerName = $appointment->name ?? 'Customer';

            $htmlMessage = "
            <div style='font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;'>
                <div style='max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 10px; padding: 30px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);'>
                    <div style='text-align: center; border-bottom: 3px solid #e83e8c; padding-bottom: 10px; margin-bottom: 20px;'>
                        <h2 style='color: #e83e8c; margin: 0;'>Ingrid Salon 💇‍♀️</h2>
                        <p style='color: #6c757d; margin: 5px 0;'>Appointment Confirmation</p>
                    </div>

                    <p style='font-size: 16px; color: #333;'>Hello <strong>{$customerName}</strong>,</p>

                    <p style='font-size: 15px; color: #333;'>Your booking has been successfully created!</p>

                    <div style='background: #f1f1f1; border-radius: 8px; padding: 15px; margin: 20px 0;'>
                        <p style='margin: 5px 0;'><strong>Service:</strong> {$serviceName}</p>
                        <p style='margin: 5px 0;'><strong>Date:</strong> {$date}</p>
                        <p style='margin: 5px 0;'><strong>Time:</strong> {$time}</p>
                    </div>

                    <p style='font-size: 15px; color: #333;'>Thank you for choosing <strong>Ingrid Salon</strong>. We look forward to pampering you soon!</p>

                    <div style='text-align: center; margin-top: 30px;'>
                        <a href='#' style='background: #e83e8c; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Thank You!</a>
                    </div>

                    <hr style='margin: 30px 0; border: none; border-top: 1px solid #ddd;'>

                    <p style='text-align: center; font-size: 13px; color: #999;'>© " . date('Y') . " Ingrid Salon. All rights reserved.</p>
                </div>
            </div>
            ";

            // ✅ Send HTML email properly
            Mail::send([], [], function ($message) use ($appointment, $htmlMessage) {
                $message->to($appointment->email)
                        ->subject('Booking Confirmation - Ingrid Salon')
                        ->html($htmlMessage);
            });
        }
    }
}
