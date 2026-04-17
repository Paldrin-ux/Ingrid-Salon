<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event → listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        \App\Events\BookingCreated::class => [
            \App\Listeners\UserNotifyBookingCreated::class,
            \App\Listeners\EmployeeNotifyBookingCreated::class,

        ],
        \App\Events\StatusUpdated::class => [
            \App\Listeners\UserNotifyStatusUpdated::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }
}
