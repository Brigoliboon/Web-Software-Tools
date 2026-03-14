<?php

namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewSubmittedNotification extends Notification
{
    use Queueable;

    /**
     * The review instance.
     */
    protected Review $review;

    /**
     * Create a new notification instance.
     */
    public function __construct(Review $review)
    {
        $this->review = $review;
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
        $bookTitle = $this->review->book->title ?? 'Unknown Book';
        $rating = $this->review->rating;

        return (new MailMessage)
            ->subject('New Review Posted - ' . $bookTitle)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('A new review has been posted for one of your books.')
            ->line('Book: ' . $bookTitle)
            ->line('Rating: ' . str_repeat('★', $rating) . str_repeat('☆', 5 - $rating))
            ->line('Review: ' . substr($this->review->comment ?? '', 0, 100) . (strlen($this->review->comment ?? '') > 100 ? '...' : ''))
            ->line('')
            ->action('View All Reviews', route('books.show', $this->review->book_id));
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Review Posted',
            'message' => 'A new review has been posted for "' . ($this->review->book->title ?? 'Unknown Book') . '"',
            'type' => 'review',
            'book_id' => $this->review->book_id,
            'rating' => $this->review->rating,
        ];
    }
}
