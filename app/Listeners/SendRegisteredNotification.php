<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Registered;
use App\Notifications\RegisteredNotification;

class SendRegisteredNotification
{
    public function __construct() {}

    public function handle(Registered $event): void
    {
        $event->user->notify(new RegisteredNotification);
    }
}
