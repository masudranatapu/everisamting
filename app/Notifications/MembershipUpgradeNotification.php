<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipUpgradeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $user, $plan_type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $plan_type)
    {
        $this->user = $user;
        $this->plan_type = $plan_type;
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
            ->subject('Plan Upgrade')
            ->line("Upgrade to " . $this->plan_type . " plan")
            ->action('View Ad', url('dashboard/plans-billing'))
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
            'msg' => "Upgrade to " . $this->plan_type . " plan",
            'type' => 'plan_upgrade',
        ];
    }
}
