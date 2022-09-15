<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use App\Notifications\FarazSmsChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DeleteArticleNotification extends Notification
{
    use Queueable;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public string $article_title)
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return [FarazSmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('emails.delete-article',['title'=>$this->article_title]);
    }

    public function toFaraz($notifiable){
        $client = new \IPPanel\Client(config('services.sms.api_key'));
        $messageId = $client->send(
            config('services.sms.originator_number'),          // originator
            ["+989336024962"],    // recipients
            "این یک پیام لاراول است",// message
            'this is description'
        );
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
            //
        ];
    }
}
