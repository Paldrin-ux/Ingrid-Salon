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
        // Force HTTPS in production (required for Railway)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Gate::before(function ($user, $ability) {
            return $user->id == 1 ? true : null;
        });
    }
    
}