<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    
    public function register(): void
    {
        $this->app->singleton(PaymentMethodService::class, function ($app) {
            return new PaymentMethodService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    if ($this->app->environment('production')) {
        URL::forceScheme('https');
    }

    Gate::before(function ($user, $ability) {
    // user ID 1 OR any user with the admin role
    return ($user->id == 1 || $user->hasRole('admin')) ? true : null;
});
    // Add this gate for sidebar visibility
    Gate::define('is-admin', function ($user) {
        return $user->hasRole('admin');
    });
}
}