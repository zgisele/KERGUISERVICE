<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class AccepteCandidature extends Notification
{
    use Queueable;
    
    
    public $nomCandidat;
    public $nomEmployeur;
    public $prenomEmployeur;
    public $emailEmployeur;
    public $telephoneEmployeur;
    

    /**
     * Create a new notification instance.
     */
    public function __construct($nomCandidat,$nomEmployeur,$prenomEmployeur,$emailEmployeur,$telephoneEmployeur)
    
    {
        // ($userMail->prenom,$employeur->nom,$employeur->prenom,$employeur->email,$employeur->telephone)
        
        $this->nomCandidat = $nomCandidat;
        $this->nomEmployeur = $nomEmployeur;
        $this->prenomEmployeur = $prenomEmployeur;
        $this->emailEmployeur = $emailEmployeur;
        $this->telephoneEmployeur = $telephoneEmployeur;
        // $this->dateEmbauche = $dateEmbauche;
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

        // Date d'embauche une semaine après la notification
        $dateEmbauche = Carbon::now()->addWeek()->format('Y-m-d');
       

        return (new MailMessage)
                    ->line('Bonjour ' . $this->nomCandidat . '!')
                    ->line('Nous sommes heureux de vous informer que votres candidature a ete valider.')
                    ->line('Vous devez donc passer a l\'etape suivante qui est l\'entretien .La date de l\'entretien  est prévue pour le ' .$dateEmbauche . '.')
                    ->line('Vous pouvez consulter les information de votre employeur ci-dessous.')
                    ->line('nom:'. $this->nomEmployeur . ',')
                    ->line('prenom:'.$this->prenomEmployeur. ',')
                    ->line('email:'.$this->emailEmployeur. ',')
                    ->line('telephone:'.$this->telephoneEmployeur. ',')
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
