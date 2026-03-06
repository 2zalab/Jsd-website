<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatutInscriptionUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public string $statusLabel;
    public string $statusMessage;
    public string $statusColor;

    public function __construct(
        public string $typeLabel,
        public string $nom,
        public string $status,
    ) {
        [$this->statusLabel, $this->statusMessage, $this->statusColor] = match($status) {
            'approved' => [
                'Approuvée ✓',
                "Félicitations ! Votre inscription au <strong>{$typeLabel}</strong> a été <strong>approuvée</strong>. Nous vous contacterons prochainement pour les étapes suivantes.",
                '#10b981',
            ],
            'rejected' => [
                'Non retenue',
                "Après examen de votre dossier, votre inscription au <strong>{$typeLabel}</strong> n'a pas pu être retenue. N'hésitez pas à nous contacter pour plus d'informations.",
                '#ef4444',
            ],
            default => [
                'Mise à jour',
                "Le statut de votre inscription au <strong>{$typeLabel}</strong> a été mis à jour.",
                '#6366f1',
            ],
        };
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mise à jour de votre inscription — ' . $this->typeLabel,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.statut-inscription',
        );
    }
}
