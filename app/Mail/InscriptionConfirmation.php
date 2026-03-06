<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $typeLabel,
        public string $nom,
        public string $detail,
        public string $recipientEmail,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation d\'inscription — ' . $this->typeLabel,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inscription-confirmation',
        );
    }
}
