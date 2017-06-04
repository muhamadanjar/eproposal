<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
class UsulanAdd extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($usulan)
    {
        
        $this->usulan = $usulan;
        $this->user = User::findOrFail($usulan->user_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            ->line('Halo '.$this->user->name.', Usulan Anda Sudah di ditampung')
            ->action('Lihat Usulan', url('proposal/usulan',$this->user->id));
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
            'notifiable_id' => $notifiable->id,
            'usulan_id' => $this->usulan->id,
            'user' => $this->user,
            'usulan' => $this->usulan
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'notifiable_id' => $notifiable->id,
            'usulan_id' => $this->usulan->id,
            'user' => $this->user,
            'usulan' => $this->usulan
        ];
    }
}
