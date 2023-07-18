<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerifiedNotification extends Notification implements ShouldQueue
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
                    ->subject('آدرس ایمیل تایید شد!')
                    ->greeting('سلام!')
                    ->line('باتشکر از شما آدرس ایمیل شما با موفقیت در وبلاگ تایید شد!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'importance' => 2, // 1,2,3,4
            'message' => 'باتشکر از شما آدرس ایمیل شما با موفقیت در وبلاگ تایید شد!',
        ];
    }
}
