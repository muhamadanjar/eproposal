<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use App\Usulan;
class UsulanUpdated extends Notification
{
    use Queueable;

    public $usulan;
    public $user;
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
        //return $notifiable->prefers_sms ? ['nexmo'] : ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable){
        $message = new MailMessage;
        $message->subject('Usulan di Update')
                    ->line('Hey '.$this->user->name.', Usulan Anda Sudah di update')
                    ->action('Lihat Usulan', url('toggle',$this->user->id));
        $message->line('Update data')
        ->line($this->usulan->skpd_pengusul)
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
            'usulan_id' => $this->usulan->id,
            'usulan' => $this->usulan,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'usulan_id' => $this->usulan->id,
            'user' => $this->user,
            'usulan' => $this->usulan
        ];
    }
}
