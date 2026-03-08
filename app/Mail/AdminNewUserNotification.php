<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNewUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $adminName,
        public string $newUserName,
        public string $newUserEmail,
        public string $newUserPassword,
        public string $newUserRole,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[JSD Admin] Nouveau compte créé — ' . $this->newUserName,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-new-user',
        );
    }
}
