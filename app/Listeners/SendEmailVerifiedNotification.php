<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Verified;
use App\Notifications\EmailVerifiedNotification;

class SendEmailVerifiedNotification
{
    public function __construct() {}

    public function handle(Verified $event): void
    {
        $event->user->notify(new EmailVerifiedNotification);
    }
}
