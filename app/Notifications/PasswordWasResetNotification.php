<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordWasResetNotification extends Notification implements ShouldQueue
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
                    ->subject('رمز عبور شما بازنشانی شد.')
                    ->greeting('سلام!')
                    ->line('رمز عبور حساب کاربری شما در وبلاگ با موفقیت بازنشانی شد. اکنون میتوانید با رمز عبور جدید وارد حساب کاربری خود شوید!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'importance' => 3,
            'message' => 'رمز عبور حساب کاربری شما در وبلاگ با موفقیت بازنشانی شد. اکنون میتوانید با رمز عبور جدید وارد حساب کاربری خود شوید!',
        ];
    }
}
