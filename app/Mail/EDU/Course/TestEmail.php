<?php

namespace App\Mail\EDU\Course;

use App\Models\EDU\Course\CoursePurchasePayment;
use App\Models\Settings\ThemeSettings;
use App\Traits\EDU\Course\CreatesCheckoutSessionForCourse;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tenantName;

    public function __construct(
        private readonly CoursePurchasePayment $payment
    ) {
        $this->tenantName = app(ThemeSettings::class)->getSiteName();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->tenantName . ' - '
            . trans('messages.register-for-course') . ' - '
            . $this->payment->purchase->course->name,
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
            markdown: 'mail.EDU.course.purchase.register-ro',
            with: [
                'url' => url("/student/register"),
                'payment' => $this->payment,
                'tenantName' => $this->tenantName,
            ]
        );
    }
}
