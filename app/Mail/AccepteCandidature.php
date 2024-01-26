<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccepteCandidature extends Mailable
{
    use Queueable, SerializesModels;
    public $candidat;
    public $employeur;
    public $dateEmbauche;

    /**
     * Create a new message instance.
     */
    public function __construct($candidat, $employeur, $dateEmbauche)
    {
        //
        $this->candidat = $candidat;
        $this->employeur = $employeur;
        $this->dateEmbauche = $dateEmbauche;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        
        return new Envelope(
            subject: 'Accepte Candidature',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content() 
    {
        $candidat=$this->candidat;
        $employeur= $this->employeur;
        $dateEmbauche =$this->dateEmbauche; 
        // return (new Content())->view('accepteCandidature', compact('dateEmbauche','candidat'));
        return (new Content())->view('accepteCandidature', compact('candidat', 'employeur', 'dateEmbauche'));
        
    }
    

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
