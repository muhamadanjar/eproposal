<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UsulanAdd extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\User $jedi)
    {
        $this->user = $jedi;
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
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage;
        
        $message->subject('Usulan di Sudah ditampung')
                    ->line('Hey '.$this->user->name.', Usulan Anda Sudah di ditampung')
                    ->action('Lihat Usulan', url('toggle',$this->user->id));
        $message->line('Usulan ditampung')->replyTo($this->user->email);
                     
                     
        return $message;
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
            'jedi_id' => $this->jedi->id,
            'jedi' => $this->jedi,
        ];
    }
}
