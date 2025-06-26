<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikeNotification extends Notification
{
    use Queueable;

    protected $likeDetails;

    /**
     * Create a new notification instance.
     */
    public function __construct($likeDetails)
    {
        $this->likeDetails = $likeDetails;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        $type = class_basename($this->likeDetails);

        return [
            'message' => auth()->user()->name . " has liked your $type",
        ];
    }
}
