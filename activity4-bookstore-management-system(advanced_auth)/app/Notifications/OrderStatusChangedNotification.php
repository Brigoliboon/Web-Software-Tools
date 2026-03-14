<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusChangedNotification extends Notification
{
    use Queueable;

    /**
     * The order instance.
     */
    protected Order $order;

    /**
     * The old status.
     */
    protected string $oldStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, string $oldStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $subject = 'Order #' . $this->order->id . ' Status Updated';
        
        $mail = (new MailMessage)
            ->subject($subject)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your order status has been updated.')
            ->line('Order ID: #' . $this->order->id)
            ->line('Previous Status: ' . ucfirst($this->oldStatus))
            ->line('Current Status: ' . ucfirst($this->order->status));

        // Add specific message based on status
        switch ($this->order->status) {
            case 'processing':
                $mail->line('Your order is now being processed and will be shipped soon.');
                break;
            case 'shipped':
                $mail->line('Your order has been shipped! You should receive it soon.');
                $mail->line('Tracking information will be sent separately once available.');
                break;
            case 'delivered':
                $mail->line('Your order has been delivered. We hope you enjoy your purchase!');
                $mail->line('Please leave a review to share your experience.');
                break;
            case 'cancelled':
                $mail->line('Your order has been cancelled.');
                $mail->line('If you did not request this cancellation, please contact support.');
                break;
        }

        return $mail
            ->line('')
            ->action('View Order Details', route('orders.show', $this->order->id));
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Order Status Updated',
            'message' => 'Your order #' . $this->order->id . ' status changed from ' . $this->oldStatus . ' to ' . $this->order->status,
            'type' => 'order',
            'order_id' => $this->order->id,
            'old_status' => $this->oldStatus,
            'status' => $this->order->status,
        ];
    }
}
