<?php

namespace App\Http\Controllers\Website\EDU;

use App\Exceptions\EDU\Course\InvalidCoursePurchasePaymentException;
use App\Http\Controllers\Controller;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Course\CoursePurchasePayment;
use App\Traits\EDU\Course\CreatesCheckoutSessionForCourse;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class CoursePurchasePaymentCheckoutController extends Controller
{
    use CreatesCheckoutSessionForCourse;

    /**
     * This will create a Stripe session and return the URL when the user actually needs it
     * i.e. after they click the payment button on the email, instead of creating the session when the email is generated,
     * as it may expire etc.
     * @throws Exception
     */
    public function __invoke(Course $course, CoursePurchasePayment $payment, int $timestamp): RedirectResponse
    {
        $this->validatePayment($course, $payment, $timestamp);

        $session = $this->buildCourseCheckoutSessionForPayment($payment);

        return redirect($session->url);
    }

    /**
     * @throws InvalidCoursePurchasePaymentException
     */
    protected function validatePayment(Course $course, CoursePurchasePayment $payment, int $timestamp): void
    {
        $not_payable = !$payment->is_payable;
        $course_mismatch = $payment->purchase->course->slug !== $course->slug;
        $timestamp_mismatch = $payment->created_at->timestamp !== $timestamp;

        if ($not_payable || $course_mismatch || $timestamp_mismatch) {
            Log::info('Invalid payment attempted for payment: ' . $payment->id, [
                'not_payable' => $not_payable,
                'course_mismatch' => $course_mismatch,
                'timestamp_mismatch' => $timestamp_mismatch,
                'course' => $course,
                'payment' => $payment,
                'timestamp' => $timestamp,
            ]);

            throw new InvalidCoursePurchasePaymentException();
        }
    }
}
