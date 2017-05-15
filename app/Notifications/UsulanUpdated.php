<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
class UsulanUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        if($this->user->is_lightsaber_on){
            $message->subject('Your Lightsaber is currently ON')
                    ->line('Hey '.$this->user->name.', your lightsaber is off so I guess that you are relaxing somewere. If you are in a fight and wish to turn on your lightsaber, click on the button below')
                    ->action('Turn On Ligthsaber', url('toggle',$this->user->id))
                    ->success();
        }else{
            $message->subject('Your Lightsaber is currently OFF')
                    ->line('Hey '.$this->user->name.', hope you are not in a fight because your lightsaber is currently off. If you wish to turn on your lightsaber, click on the button below')
                    ->action('Turn On Ligthsaber', url('toggle',$this->user->id))
                    ->error();
                     
        }
        $message->line('Remember the rules: If you are in an actual fight, please turn on your lightsaber. Otherwise, keep it turned off!')->replyTo($this->user->email);
                     
                     
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
}
