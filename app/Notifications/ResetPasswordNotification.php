<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct(public string $url) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('سلام!')
                    ->subject('بازنشانی رمز عبور حساب')
                    ->line('یک درخواست بازنشانی رمز عبور برای حساب کاربری شما به ما ارسال شده است. میتوانید با کلیک بر روی دکمه زیر نسبت به بازنشانی رمز عبور حساب خود اقدام کنید!')
                    ->action('بازنشانی رمز عبور',$this->url)
                    ->line('اگر اقدامی برای بازنشانی رمز عبور خود نکرده اید. میتوانید این ایمیل را نادیده بگیرید!');
    }
}
