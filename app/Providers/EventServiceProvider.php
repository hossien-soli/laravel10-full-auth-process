<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\PasswordWasReset;
use App\Listeners\SendPasswordWasResetNotification;
use Illuminate\Auth\Events\Verified;
use App\Listeners\SendEmailVerifiedNotification;
use App\Listeners\SendRegisteredNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendRegisteredNotification::class,
        ],

        PasswordWasReset::class => [
            SendPasswordWasResetNotification::class,
        ],

        Verified::class => [
            SendEmailVerifiedNotification::class,
        ],
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
