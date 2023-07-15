<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PasswordResetEvent;
use App\Notifications\PasswordResetNotification;

class SendPasswordResetNotificationListener
{
    public function __construct()
    {
        //
    }

    public function handle(PasswordResetEvent $event): void
    {
        $event->user->notify(new PasswordResetNotification);
    }
}
