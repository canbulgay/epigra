<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SyncTaskDoneNotification extends Notification
{
    use Queueable;

    public $capsulesFromSpaceX;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($capsulesFromSpaceX)
    {
        $this->capsulesFromSpaceX = $capsulesFromSpaceX;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)
            ->line('You have successfully synced the database with SpaceX API.')
            ->line('Count of capsules: ' . count($this->capsulesFromSpaceX));
    }
}
