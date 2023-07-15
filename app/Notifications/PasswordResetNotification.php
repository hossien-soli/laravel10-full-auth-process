<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('بازنشانی رمز عبور')
                    ->line('رمز عبور شما با موفقیت بازنشانی شد!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'importance' => 3, // 1,2,3,4
            'message' => 'رمز عبور شما با موفقیت بازنشانی شد!',
        ];
    }
}
