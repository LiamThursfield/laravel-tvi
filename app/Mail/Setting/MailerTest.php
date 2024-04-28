<?php

namespace App\Mail\Setting;

use Exception;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class MailerTest extends Mailable
{
    public function __construct(
        private readonly array $mailerSettings
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Mailer Settings Test",
        );
    }

    /**
     * Get the message content definition.
     * @return Content
     * @throws Exception
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.setting.mailer-test',
            with: [
                'mailerSettings' => $this->mailerSettings
            ]
        );
    }
}
