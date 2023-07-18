<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PasswordWasReset;
use App\Notifications\PasswordWasResetNotification;

class SendPasswordWasResetNotification
{
    public function __construct() {}

    public function handle(PasswordWasReset $event): void
    {
        $event->user->notify(new PasswordWasResetNotification);
    }
}
