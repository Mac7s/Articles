<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;

class FarazSmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFaraz($notifiable);

        // Send notification to the $notifiable instance...
    }
}
