<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    /**
     * The order instance.
     */
    protected Order $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
        return (new MailMessage)
            ->subject('Order Confirmation - Order #' . $this->order->id)
            ->greeting('Thank you for your order, ' . $notifiable->name . '!')
            ->line('Your order has been successfully placed.')
            ->line('Order ID: #' . $this->order->id)
            ->line('Order Total: $' . number_format($this->order->total_amount, 2))
            ->line('Order Status: ' . ucfirst($this->order->status))
            ->line('Shipping Address:')
            ->line($this->order->shipping_address)
            ->line('')
            ->line('You can track your order status in your account dashboard.')
            ->action('View Order Details', route('orders.show', $this->order->id));
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Order Placed Successfully',
            'message' => 'Your order #' . $this->order->id . ' has been placed. Total: $' . number_format($this->order->total_amount, 2),
            'type' => 'order',
            'order_id' => $this->order->id,
            'status' => $this->order->status,
        ];
    }
}
