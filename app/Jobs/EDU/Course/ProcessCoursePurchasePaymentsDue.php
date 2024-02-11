<?php

namespace App\Jobs\EDU\Course;

use App\Interfaces\EDU\Course\CoursePurchaseInterface;
use App\Mail\EDU\Course\CoursePurchasePaymentDue;
use App\Models\EDU\Course\CoursePurchasePayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * IMPORTANT: This should be fired once per day
 * It handles all payments due on that day:
 *     - Fires an email
 *     - Marks the purchases as PENDING
 */
class ProcessCoursePurchasePaymentsDue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        // Grab IDs as chunking etc. can cause unexpected issues when making changes during the chunk
        $paymentIds = CoursePurchasePayment::where('status', CoursePurchaseInterface::PAYMENT_NOT_DUE)
            ->where('due_date', now()->format('Y-m-d'))
            ->pluck('id');

        Log::info('Job: ProcessCoursePurchasePayments', [
            'tenant' => tenant()->id,
            'payments' => count($paymentIds)
        ]);

        foreach ($paymentIds as $paymentId) {
            try {
                /** @var CoursePurchasePayment $payment */
                $payment = CoursePurchasePayment::findOrFail($paymentId);
                $payment->load(['purchase', 'purchase.course', 'purchase.user']);

                Mail::to(
                    $payment->purchase->notification_email,
                    $payment->purchase->notification_email
                )->send(
                    new CoursePurchasePaymentDue($payment)
                );

                $payment->status = CoursePurchaseInterface::PAYMENT_STATUS_PENDING;
                $payment->save();
            } catch (ModelNotFoundException $e) {
                Log::error($e);
            }
        }
    }
}
