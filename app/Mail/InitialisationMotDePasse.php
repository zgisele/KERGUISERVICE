<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InitialisationMotDePasse extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $lien;
    
    /**
     * Create a new message instance.
     */
    public function __construct($user,$lien)
    {
        //
        $this->user = $user;
        $this->lien = $lien;
        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Initialisation Mot De Passe',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $user=$this->user;
        $lien=$this->lien;
        return (new Content())->view('modifierMotDePasse', compact('user', 'lien'));
        
        // return new Content(
        //     view: 'ModifierMotDePasse',
        // );
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
