<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisteredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct() {}

    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('ثبت نام موفق آمیز بود!')
                    ->greeting('سلام!')
                    ->line('باتشکر از شما ثبت نام شما در وبلاگ موفقیت آمیز بود!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'importance' => 1,  // 1,2,3,4
            'message' => 'باتشکر از شما ثبت نام شما در وبلاگ موفقیت آمیز بود!',
        ];
    }
}
