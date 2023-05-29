<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdPendingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $user, $ad;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $ad)
    {
        $this->user = $user;
        $this->ad = $ad;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting("Hello " . $this->user->name . " !")
            ->subject('Ad Pending')
            ->line("Your ad is pending. Please wait for admin approval.")
            ->line('Thank you for using our ' . config('app.name') . '!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'msg' => "Ad pending",
            'type' => 'adpending',
        ];
    }
}
