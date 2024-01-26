<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RejetteCandidature extends Notification
{
    use Queueable;
    public $prenomCandidat;
    public $nomCandidat;

    /**
     * Create a new notification instance.
     */
    public function __construct( $prenomCandidat,$nomCandidat)
    {
        //
        $this->prenomCandidat = $prenomCandidat;
        $this->nomCandidat = $nomCandidat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Bonjour '.$this->prenomCandidat.' '. $this->nomCandidat . '!')
                    ->line('Nous vous informons que votres candidature n\'a pas ete retenu.')
                    ->line('Nous vous encourageons a postuler d\'avantage .Nous sommes certain que vous touvez l\'emploi qui vous convient')
                    ->line('Cordialement, L\'equipe KER GUI SERVICE.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
