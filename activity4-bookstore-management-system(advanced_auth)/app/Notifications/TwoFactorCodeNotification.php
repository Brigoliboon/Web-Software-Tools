<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCodeNotification extends Notification
{
    use Queueable;

    protected string $code;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your PageTurner Verification Code')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Thank you for registering with PageTurner.')
            ->line('Your verification code is:')
            ->line('')
            ->line('**' . implode(' ', str_split($this->code)) . '**')
            ->line('')
            ->line('This code will expire in 5 minutes.')
            ->line('If you did not create an account, please ignore this email.')
            ->salutation('Best regards, PageTurner Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
