<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OtpMail;
use App\Models\User;
use App\Models\EmailOtp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OtpController extends Controller
{
    // ✅ Send OTP to user's email
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Generate 6-digit OTP
        $otp = random_int(100000, 999999);

        // Store or update OTP for the email
        EmailOtp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp_hash' => Hash::make($otp),
                'expires_at' => Carbon::now()->addMinutes(10),
            ]
        );

        // Send OTP to email
        Mail::to($request->email)->send(new OtpMail($otp));

        return response()->json(['message' => 'OTP has been sent to your email.']);
    }

    // ✅ Register user after OTP verification
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|confirmed|min:6',
            'otp' => 'required|digits:6',
        ]);

        $otpRecord = EmailOtp::where('email', $request->email)->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'No OTP found for this email.']);
        }

        if (Carbon::now()->gt($otpRecord->expires_at)) {
            $otpRecord->delete();
            return back()->withErrors(['otp' => 'OTP expired. Please request a new one.']);
        }

        if (!Hash::check($request->otp, $otpRecord->otp_hash)) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        // ✅ Extra safety check in case of race condition
        if (User::where('email', $request->email)->orWhere('phone', $request->phone)->exists()) {
            return back()->withErrors(['email' => 'Email or phone already registered.']);
        }

        // ✅ Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        // ✅ Assign "subscriber" role
        $user->assignRole('subscriber');

        // ✅ Cleanup OTP after successful verification
        $otpRecord->delete();

        // ✅ Automatically log in the user
        auth()->login($user);

        // ✅ Redirect to profile/home page
        return redirect()->route('profile')->with('success', 'Registration successful!');
    }
}
