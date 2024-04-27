<?php

namespace App\Mail\CRM\Form;

use App\Models\CRM\FormSubmission;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormSubmittedInternal extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly FormSubmission $formSubmission
    ) {
        $this->formSubmission->load(['form', 'contact', 'form.formFields']);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Form Submitted: ' . $this->formSubmission->form->name,
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
            markdown: 'mail.CRM.form.submission.internal',
            with: [
                'contact'       => $this->formSubmission->contact ?? null,
                'form'          => $this->formSubmission->form,
                'formFields'    => $this->formSubmission->form->formFields,
                'submission'    => $this->formSubmission,
            ]
        );
    }
}
