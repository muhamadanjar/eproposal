<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UsulanDataKurang extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$usulan){
        $this->user = $user;
        $this->usulan = $usulan;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable){
        $message = new MailMessage;
        $message->subject('Usulan Data Kurang')
            ->line('Hey '.$this->user->name.', Usulan Anda ada yang kurang Silakan cek usulan anda.')
            ->action('Lihat Usulan', url('proposal/usulan',$this->usulan->id))
            ->replyTo($this->user->email);
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
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'notifiable_id' => $notifiable->id,
            'usulan_id' => $this->user->id,
            'usulan' => $this->usulan,
            'user' => $this->user
        ];
    }
}
