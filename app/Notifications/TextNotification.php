<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;


class TextNotification extends Notification implements ShouldQueue
{
    use Queueable;
    private $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
        // return ['mail', 'database'];
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
                    ->line($this->message)
                    ->action('Ir para o site', url('https://www.sistemafaculdade.com.br/'));
                    
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
            'message' => $this->message,
            'user_id'    => $notifiable->id,
            'user_email' => $notifiable->email,

        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message'    => $this->message,
            'user_id'    => $notifiable->id,
            'user_email' => $notifiable->email,
        ];
    }

    public function toBroadCast($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->message,
            'user_id'    => $notifiable->id,
            'user_email' => $notifiable->email,
        ]);
    }
}
