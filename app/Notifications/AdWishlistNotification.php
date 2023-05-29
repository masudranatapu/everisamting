<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdWishlistNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $user, $type, $ad_slug;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $type, $ad_slug)
    {
        $this->user = $user;
        $this->type = $type;
        $this->ad_slug = $ad_slug;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($this->type === 'add') {
            return ['database', 'mail'];
        }
        return ['database', 'mail'];
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
            ->subject('Add to Wishlist')
            ->line("@{$this->user->username} user add your ad to their wishlist.")
            ->action('View Add', route('frontend.addetails', $this->ad_slug))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if ($this->type === 'add') {
            $msg = "Added a ad to favourite list";
        } else {
            $msg = "Removed a ad from favourite list";
        }

        $url = url('/ad/details/' . $this->ad_slug);

        return [
            'msg' => $msg,
            'type' => 'added_to_favourite',
            'url' => $url,
        ];
    }
}
