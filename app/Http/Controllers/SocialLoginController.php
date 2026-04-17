<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialLoginController extends Controller
{
    /**
     * Redirect to provider
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle provider callback
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Check if user exists with this provider
            $user = User::where('provider_id', $socialUser->getId())
                        ->where('provider', $provider)
                        ->first();

            if (!$user) {
                // Check if user exists with same email
                $user = User::where('email', $socialUser->getEmail())->first();

                if ($user) {
                    // Update existing user with provider info
                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                    ]);
                } else {
                    // Create new user
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                        'email_verified_at' => now(),
                        'password' => null, // No password for social login
                    ]);
                }
            }

            // Log the user in
            Auth::login($user);

            return redirect()->route('profile'); // Change to your desired route

        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Unable to login with ' . ucfirst($provider) . '. Please try again.']);
        }
    }
}