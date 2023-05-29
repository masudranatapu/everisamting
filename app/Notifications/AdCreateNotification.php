<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdCreateNotification extends Notification implements ShouldQueue
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
        $url = url('/ad/details/' . $this->ad->slug);

        return (new MailMessage)
            ->greeting("Hello " . $this->user->name . " !")
            ->subject('Ad Create')
            ->line("You're just created a ad")
            ->action('View Ad', $url)
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
        $url = url('/ad/details/' . $this->ad->slug);

        return [
            'msg' => "You're just created a ad",
            'type' => 'adcreate',
            'url' => $url,
        ];
    }
}
