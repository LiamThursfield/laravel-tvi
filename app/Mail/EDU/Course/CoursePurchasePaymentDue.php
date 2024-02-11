<?php

namespace App\Mail\EDU\Course;

use App\Models\EDU\Course\CoursePurchasePayment;
use App\Traits\EDU\Course\CreatesCheckoutSessionForCourse;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CoursePurchasePaymentDue extends Mailable
{
    use Queueable, SerializesModels, CreatesCheckoutSessionForCourse;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly CoursePurchasePayment $payment
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Due for ' . $this->payment->purchase->course->name,
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
            markdown: 'mail.EDU.course.purchase.payment-due',
            with: [
                'url' => $this->payment->checkout_url,
                'payment' => $this->payment,
            ]
        );
    }
}
