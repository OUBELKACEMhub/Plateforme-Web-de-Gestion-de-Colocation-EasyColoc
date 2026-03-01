<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

public function __construct($invitation)
{
    $this->invitation = $invitation;
}

public function envelope(): Envelope
{
    return new Envelope(
        subject: 'Invitation à rejoindre une colocation sur EasyColoc',
    );
}

public function content(): Content
{
    return new Content(
        view: 'emails.invitation',
    );
}
}
